<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminSliderController extends BaseController {

	public function __construct(User $user, Slider $slider)
    {
        $this->user = $user;
        $this->slider = $slider;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $sliders = Slider::orderBy('order','ASC')->get();

		return View::make('admin.slider.index', compact('sliders'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		list($slider) = $this->slider;

		$maxOrder = Slider::max('order');

		return View::make('admin.slider.create', compact('slider' , 'maxOrder'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // Validate the inputs
        $validator = Validator::make(Input::all(), Config::get('validator.slider'));
        
        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new blog sliderrrr
            $user = Auth::user();
            if(empty($user)){
            	return Redirect::to('user/login')->with('error','Vous devez êtres connecté !');
            }

            //Image storing
            $file = Input::file('image');
            if(!empty($file)){        
	            $destinationPath	= 'img/uploads/'.Str::random(5);
				$fileName 			= md5( Input::get('title') );
	            $uploadSuccess = $file->move($destinationPath, $fileName);

	            if( empty($uploadSuccess) ){
	            	return Redirect::to('admin/slider/create')->with('error','L\'image n\' pas pu être téléchargée...');
	            }
            	$this->slider->img          	= $destinationPath.'/'.$fileName;
			}
            // Update the blog slider data
            $this->slider->title            	= Input::get('title');
            $this->slider->description      	= Input::get('description');
            $this->slider->href       		= Input::get('href');
            $this->slider->img_alt 			= Input::get('img_alt');
            $this->slider->created_at    	= new DateTime();

            // Was the blog slider created?
            if($this->slider->save())
            {
                // Redirect to the new blog page page
                return Redirect::to('admin/slider')->with('success', 'Le slide à bien été créé !');
            }

            // Redirect to the blog slider create slider
            return Redirect::to('admin/slider/create')->with('error', 'Le slide n\'a pas pu être enregistré...');
        }

        // Form validation failed
        return Redirect::to('admin/slider/create')->withInput()->withErrors($validator);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$slider = Slider::find($id);
		if(empty($slider) || !isset($slider)){
			return Redirect::to('admin/slider')->with('error','Ce slide est introuvable !');
		}

		return View::make('admin.slider.show', compact('slider'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the post
		$slider = Slider::find($id);

		if(empty($slider) || !isset($slider)){
			//Session::flash('error', 'Ce slider est introuvable !');
			return Redirect::back()->with('error', 'Ce slide est introuvable !');
		}

		// show the edit form and pass the slider
		return View::make('admin.slider.edit', compact('slider') );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// Validate the inputs
        $validator = Validator::make(Input::all(), Config::get('validator.slider-edit'));
		
        // Check if the form validates with success
        if ($validator->passes())
        {
            $slider = Slider::find($id);
            if(empty($slider) || !isset($slider)){
				return Redirect::to('admin/slider')->with('error','Ce slide est introuvable !');
			}

             //Image storing
            $file = Input::file('image');
            if(!empty($file)){        
	            $destinationPath	= 'img/uploads/'.Str::random(5);
				$fileName 			= md5( Input::get('title') );
	            $uploadSuccess = $file->move($destinationPath, $fileName);

	            if( empty($uploadSuccess) ){
	            	return Redirect::to('admin/slider/create')->with('error','L\'image n\' pas pu être téléchargée...');
	            }

				$slider->img          	= $destinationPath.'/'.$fileName;
			}


            // Update the blog post data
            $slider->title            	= Input::get('title');
            $slider->description      	= Input::get('description');
            $slider->href       		= Input::get('href');
            $slider->img_alt 			= Input::get('img_alt');
            $slider->order 				= Input::get('order');
            $slider->updated_at    		= new DateTime();

            // Was the blog post created?
            if($slider->save())
            {
                // Redirect to the new blog post slider
                return Redirect::to('admin/slider')->with('success', 'Le slide à bien été mis à jour !');
            }

            // Redirect to the blog post create slider
            return Redirect::to('admin/slider/' . $id . '/edit')->with('error', 'Le slide n\'a pas pu être enregistré...');
        }

        // Form validation failed
        return Redirect::to('admin/slider/' . $id . '/edit')->withInput()->withErrors($validator);;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		$slider = Slider::find($id);
		if(empty($slider)){
			Session::flash('error', 'Ce slide est introuvable !');
			return Redirect::back();
		}
		$slider->delete();

		// redirect
		Session::flash('success', 'Le slide a bien été supprimé !');
		return Redirect::back();
	}
}