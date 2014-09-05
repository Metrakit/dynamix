<?php

class Form extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'forms';

	
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
    	$data['data'] = $this->translate( $this->i18n_content );
        return Response::view('public.blockcontent.blockcontent', $data )->getOriginalContent();
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