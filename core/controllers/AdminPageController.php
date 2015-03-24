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

		// get the post
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

		// get the post
		$data['page'] = Page::find($id);

		if(empty($data['page'])){
			return Redirect::back()->with('error', 'Cette page est introuvable !');
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
		foreach( Config::get('validator.page-edit') as $ruleKey => $ruleValue ) {
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
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$page = Page::find($id);

		if(empty($page)){
			return Redirect::to('admin/page')->with('error','Cette page est introuvable !');
		}

		// Validate the inputs
		$validator = null;
		if(!$page->deletable){
        	$validator = Validator::make(Input::all(), Config::get('validator.page-no-deletable'));
		}else{			
        	$validator = Validator::make(Input::all(), Config::get('validator.page-deletable'));
		}
		
        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the page data
            $page->title            = Input::get('title');
            // If is not index
            if($page->url != '/'){
            	$url = Str::slug(Input::get('url'));
            	$page->url          = '/'.$url;
        	}
            $page->content          = Input::get('content');

            $page->meta_title       = Input::get('meta_title');
            $page->meta_description = Input::get('meta_description');

            $page->updated_at    	= new DateTime();

            // Was the blog post created?
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