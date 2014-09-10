<?php

class InputView extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'inputs';
    public $timestamps = false;
    protected $fillable = ['view_id', 'i18n_placeholder', 'i18n_helper', 'type_id'];


    /**
     * View relation
     * @return Query
     */
    public function getView()
    {
    	return $this->belongsTo('Viewr', 'view_id')->first();
    }


    /**
     * Input type relation
     * @return Query
     */
    public function getType()
    {
    	return $this->belongsTo('InputType', 'type_id')->first();
    }


    /**
     * Select Options relation
     * @return Query
     */
    public function getOptions()
    {
        return $this->hasMany('SelectOption', 'input_id')->get();
    }




	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public function translate( $i18n_id )
	{
		return Translation::where('i18n_id', '=', $i18n_id)->where('locale_id', '=', App::getLocale())->first()->text;
	}

}