<?php

class Note extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

    public function type() {
        return $this->belongsTo('NoteType');
    }

    public function stock() {
        return $this->belongsTo('Stock');
    }

    public function market() {
        return $this->belongsTo('Market');
    }

}
