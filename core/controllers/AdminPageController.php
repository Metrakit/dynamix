<?php

//use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminPageController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//User
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;
        $data['pages'] 			= Page::all();

        if (Request::ajax()) {
			return Response::json(View::make('theme::' . 'admin.page.index', $data )->renderSections());
		} else {
			return View::make('theme::' .'admin.page.index', $data);
		}
	}

	/**
	 * Show the form for create a resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//User
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;

		if (Input::has('template')) {
			$template = Input::get('template');
			return View::make('theme::' .'admin.page.template.' . $template, $data);
		}

		return View::make('theme::' .'admin.page.create', $data);
	}

	/**
	 * Store the new resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//only use in js
		$page = new Page();

		//Make empty data
		$page->i18n_name = I18n::add(array('fr' => '', 'en' => ''), 'name');
        
        // Was the blog post created?
        if($page->save())
        {
        	 //Structure of mosaic
        	$dataI18nEmpty = array('fr'=>'', 'en'=>'');
            $structure = new Structure();
            $structure->i18n_title = I18n::add($dataI18nEmpty,'title');
            $structure->i18n_url = I18n::add($dataI18nEmpty,'url');
            $structure->i18n_meta_title = I18n::add($dataI18nEmpty,'meta_title');
            $structure->i18n_meta_description = I18n::add($dataI18nEmpty,'meta_description');
            $structure->structurable_id = $page->id;
            $structure->structurable_type = 'Page';
            $structure->save();

            // Redirect to the new blog post page
            return Response::json(['page_id' => $page->id]);
        }

        // Redirect to the blog post create page
       return Response::json(['page_id' => 'error']);
	}

	
	/**
	 * return the responsive datas, trigger, width
	 *
	 * @return Response
	 */
	public function getResponsiveDatas () {
		//sort with trigger
		$data = array();
		$countTriggerID = strlen('_trigger_');
		foreach (Input::all() as $inputKey => $inputValue) {
			//_trigger_md = value
			if (strpos($inputKey, '_trigger_') !== false) {
				$data[mb_substr($inputKey, $countTriggerID, strlen($inputKey) - $countTriggerID)] = $inputValue;
			}
		}
		return $data;
	}


	/**
	 * Store the new resource in storage.
	 *
	 * @return Response
	 */
	public function store_block()
	{
		//only use in js
		// exctract blockable_data
		$blockable_datas = explode("|", Input::get('blockable_data'));
		//1 type_id
		//2 blockable_id or consigne (new)
		//3 blockable_type

		$modelId = $blockable_datas[1];
		$model = $blockable_datas[2];
		$typeId = $blockable_datas[0];

		//Create block
		if ($modelId == 'new') {
			$modelId = $model::newObject();
			$model = $model::$modelBlockableType;
		}
		
		$pageId = Input::get('page_id');
		$order = Input::get('order');
		$class = (Input::has('class')?Input::get('class'):'');
		$block = Block::add($modelId, $model, $typeId, $pageId, $order, $class);
		//Data responsive
		$dataResponsive = $this->getResponsiveDatas();

		//Make data for insertion
		$dataInsert = array();
		foreach ( $dataResponsive as $dataKey => $dataValue ) {
			$dataInsert[] = array(
				'block_id'      => $block->id,
                'responsive_width_id'       => $dataValue,
                'responsive_trigger_id'       => Rtrigger::where('value', $dataKey)->first()->id
				);
		}
		//block responsive prorieties
		DB::table('block_responsive')->insert($dataInsert);

        // Redirect to the blog post create page
       	return Response::json(['status' => 'success']);
	}


	/**
	 * Show the resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//User
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;

		// get the page
		$data['page'] = Page::find($id);

		if(empty($data['page'])){
			return Redirect::back()->with('error', 'Cette page est introuvable !');
		}

		return View::make('theme::' .'admin.page.show', $data );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//User
		$data['user'] 			= Auth::user();

		// get the page
		$data['page'] = Page::find($id);

		if(empty($data['page'])){
			return Redirect::back()->with('error', 'Cette page est introuvable !');
		}

		//get his $background, if exist
		if ($data['page']->isOnePagePart()) {
			$data['onepage_part'] = $data['page']->getOnePagePart();



		}

		return View::make('theme::' .'admin.page.edit', $data );
	}

	/**
	 * Make $rules for i18n_field
	 *
	 * @return Array
	 */
	public function makingAdaptativeRules() {
		$rules = array();
		foreach( Config::get('validator.admin.page-edit') as $ruleKey => $ruleValue ) {
			if (strpos($ruleKey, 'i18n') !== false) {
				foreach( Cachr::getCache('DB_LocaleFrontEnable') as $locale ) {
					$rules[$ruleKey.'_'.$locale] = $ruleValue;
				}
			} else {
				$rules[$ruleKey] = $ruleValue;
			}
		}
		return $rules;
	}

	/**
	 * Form Input::all(), make i18n data skeleton 
	 *
	 * @return Array
	 */
	public function buildI18nData() {
		$dataI18n = array();
        foreach (Input::all() as $inputKey => $inputValue) {
        	if (strpos($inputKey, 'i18n') !== false) {
        		$position = strripos($inputKey, '_');
        		if($position !== false) {            			
            		$keyI18n = mb_substr($inputKey, 0, $position);
            		$locale = mb_substr($inputKey, $position+1, strlen($inputKey)-($position+1));

            		$dataI18n[$keyI18n][$locale] = ($keyI18n=='i18n_url'?'/':'').$inputValue;
        		}
        	}
        }
        return $dataI18n;
	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Get page model
		$page = Page::find($id);
		if(empty($page)) return Redirect::to('admin/page')->with('error','Cette page est introuvable !');

		//Making adaptative rules
		$rules = $this->makingAdaptativeRules();

        $validator = Validator::make(Input::all(), $rules);

        //return var_dump(Input::all());
        //return var_dump($validator->messages()->all());
		// Validate
		if ($validator->passes()) {
            //Build data i18n
            $dataI18n = $this->buildI18nData();
            //return var_dump($dataI18n);

            //Page background
            $background = null;
            if (!empty($page->background_id) && is_integer($page->background_id)) {
            	$background = Background::find($page->background_id);
            } else {
            	$background = new Background;
            }
        	$background->background_type_id = (!empty(Input::get('background_type'))?Input::get('background_type'):null);
        	$background->background_position_id = (!empty(Input::get('background_position'))?Input::get('background_position'):null);
        	$background->background_color = Input::get('background_color');
        	$background->url = Input::get('background_url');
        	if (!$background->save()) return Redirect::to('admin/page/' . $page->id . '/edit')->with('error','La sauvegarde du background a échoué...');
			
			//Page direct datas
            I18n::change($page->i18n_name, $dataI18n['i18n_name']);
            
            //Page parameters
            if (Input::has('is_commentable'))  {
            	$page->is_commentable = true;
            } else {
            	$page->is_commentable = false;
            }
        	if (Input::has('is_published'))  {
        		$page->is_published = true;
        	} else {
        		$page->is_published = false;
        	}

        	//Structure of page
        	$structure = $page->structure()->first();
            I18n::change($structure->i18n_title, $dataI18n['i18n_title']);
            I18n::change($structure->i18n_url, $dataI18n['i18n_url']);
            I18n::change($structure->i18n_meta_title, $dataI18n['i18n_meta_title']);
            I18n::change($structure->i18n_meta_description, $dataI18n['i18n_meta_description']);

            //Page Block - find and update
            // On va identifier les ids des blocks que l'on a dans les inputs passés
            // On va ensuite chercher le block utiliser sa clé i18n et mettre à jour le contenu
            $blockIdentifier = 'i18n_content_';
            $blockIdentifierLength = strlen($blockIdentifier);
            foreach (Input::all() as $inputKey => $inputValue) {
            	//If input key has the identifier
            	if (strpos($inputKey, 'i18n_content_') !== false) {
            		$blockId = substr($inputKey,$blockIdentifierLength,strlen($inputKey)-$blockIdentifierLength-3);
            		//echo $blockId . '<br>';
            		//return var_dump($blockIdentifier . $blockId);
            		if (!empty($blockId) && is_integer(intval($blockId))) {
            			$blockContent = BlockContent::find($blockId);
            			///return var_dump($blockContent->i18n_content);
            			I18n::change($blockContent->i18n_content, (isset($dataI18n[$blockIdentifier . $blockId])?$dataI18n[$blockIdentifier . $blockId]:array()));
            		}
            	}
            }
        
            if($page->save())
            {
            	Cache::forget('DB_Urls');
                // Redirect to the new blog post page
                return Redirect::to('admin/page')->with('success','La page à bien été mise à jour !');
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/page/' . $id . '/edit')->with('error', 'La page n\'a pas pu être enregistrée...');
        }

        // Form validation failed
        return Redirect::to('admin/page/' . $id . '/edit')->withInput()->withErrors($validator);
	}

	/**
	 * Return the template of blocks
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getBlockTemplate($template)
	{
		if (in_array($template, Config::get('display.page-template'))) {
			return Response::json(View::make('theme::' .'admin.page.block-template.' . $template)->render());
		}

		return Response::json('caca');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$success = 'La page a bien été supprimée !';
		// delete
		$page = Page::find($id);
		if(empty($page)){
			return Redirect::to('admin/page')->with('error', 'Cette page est introuvable !');
		}

		//Protect index
		if(!$page->is_deletable){
			return Redirect::to('admin/page')->with('notice', 'Cette page ne peut être supprimée !');
		}

		//Used in menu?
		$id = Menu::where('resource_id','=',Resource::where('name','=','page')->first()->id)->where('element_id','=',$page->id)->first();
		if(!empty($id)){
			$success = 'La page ainsi que le menu associé ont été supprimé avec succès !';
			App::make('AdminMenuController')->destroy($id->id);
		}

		Cache::forget('DB_Urls');
		
		
		$page->delete();

		// redirect
		return Redirect::to('admin/page')->with('success', $success);
	}
}