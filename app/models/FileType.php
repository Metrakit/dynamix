<?php

class FileType extends Eloquent{
    
    /**
     * Parameters
     */
    protected $table = 'file_types';

    /**
     * Relation
     *
     * @var string
     */
    public function files() {
        return $this->hasMany('File');
    }

    /**
     * Polymorphic Relation
     *
     * @var string
     */


    /**
     * Additional Method
     *
     * @var string
     */ 
}