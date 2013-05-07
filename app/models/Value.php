<?php

class Value extends Eloquent {
	
	public $timestamps = false;

	protected $guarded = array();

	public static function toInt($double)
	{
		return (int) ($double * 100);
	}

	public static function toDouble($integer)
	{
		return substr($integer, 0, -2) . '.' . substr($integer, -2);
	}
}