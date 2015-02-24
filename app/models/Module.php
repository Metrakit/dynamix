<?php

/*
Use to manage simple module for rendering in Block
*/

class Module extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'modules';
    public $timestamps = false;

    /**
     * #Pager method
     *
     * @return mixed
     */
    public function renderResource()
    {
        // TODO
        //$data['data'] = $this->translate( $this->i18n_content );
        
        //return Response::view('public.blockcontent.blockcontent', $data )->getOriginalContent();
    }
}