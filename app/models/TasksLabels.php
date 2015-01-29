<?php

class TasksLabels extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'labels';
    public $timestamps = false;
    protected $fillable = ['id', 'label','color'];

    /**
     * return relationship with labels
     * @return [type]
     */
    public function tasks(){
        return $this->belongsToMany('Task', 'label_task', 'labels_id', 'tasks_id');
    }
}