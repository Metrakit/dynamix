<?php

class BlockContent extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'block_contents';

	
	/**
	 * Relations
	 *
	 * @var string
	 */


	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function block()
    {
        return $this->morphMany('Block', 'blockable');
    }


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