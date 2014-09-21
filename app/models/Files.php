<?php

class Files extends Eloquent{
    
    /**
     * Parameters
     */
    protected $table = 'files';

    /**
     * Relation
     *
     * @var string
     */
    public function type() {
        return $this->hasOne('FileType');
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