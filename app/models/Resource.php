<?php

class Resource extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'resources';
    public $timestamps = false;
    protected $fillable = ['name', 'icon', 'model', 'in_admin_ui', 'navigable', 'group'];

	/**
     * A Resource is on many Permission
     *
     * @return mixed
     */
	public function permissions() {
        return $this->hasMany('Permission');
    }

    /**
     * A Role is on many Permission
     *
     * @return mixed
     */
    public function trackings() {
        return $this->hasMany('Tracking');
    }
}