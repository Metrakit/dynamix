<?php

class Formr extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'forms';
	public $timestamps = false;
	protected $fillable = ['finish_on', 'i18n_title', 'i18n_description', 'type'];

	
	/**
	 * Relations
	 *
	 * @var string
	 */


    /**
     * Attributes
     *
     * @return mixed
     */

       
    /**
     * #Pager method
     *
     * @return mixed
     */
    public function renderResource()
    {
    	$data['form'] = $this;
    	$data['inputs'] = Former::render($data['form']);
        return Response::view('public.form.form', $data )->getOriginalContent();
    }


	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public function translate( $i18n_id )
	{
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
	}


	/**
	 * Model relation
	 * @return Query
	 */
	public function model()
	{
		return $this->hasMany('ModelForm', 'form_id');
	}


	/**
	 * Get the model to a form
	 * @return Object	 
	*/
	public function getModel()
	{
		return $this->model()->first();
	}

}