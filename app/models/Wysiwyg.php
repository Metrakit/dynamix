<?php
//not eloquent
class Wysiwyg {
	
	/**
	 * Parameters
	 */

	
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
}