<?php

namespace Dynamix\Models;

class Task extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tasks';
    public $timestamps = false;
    protected $fillable = ['id', 'label', 'description', 'date'];

    /**
     * return relationship with labels
     * @return [type]
     */
    public function labels()
    {
        return $this->belongsToMany('Dynamix\Models\TasksLabels', 'label_task', 'tasks_id', 'labels_id');
    }
    

    /**
     * return relationship with auths
     * @return [type]
     */
    public function auths()
    {
        return $this->belongsToMany('Dynamix\Models\AuthUser', 'auth_task', 'tasks_id', 'auth_id');
    }
    
    public function getPriority()
    {
        $now = new \DateTime();
        if($this->date < $now->sub(new \DateInterval('P1D'))->format('Y-m-d H:i:s')){
            $priority = 'high';
        }else{
            $priority = 'medium';
        }
        return $priority;
    }

    public function getDate($format){
        //return Carbon::createFromFormat('Y-m-d H:i:s', $this->date)->formatLocalized($format);
        return $this->date; 
    }




}