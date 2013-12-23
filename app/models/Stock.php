<?php

class Stock extends Eloquent {
    
    public $timestamps = false;

    protected $guarded = array();
    
    public function values()
    {
        return $this->hasMany('Value');
    }
}