<?php

namespace app\models\validators;

class Filters
{
	public static function normalizeString($value)
	{
		$value = strtoupper($value);
        $value = preg_replace('/[^A-Z0-9 ]/','',$value);
        $value = trim($value);
        $value = preg_replace('/\\s{2,}/',' ',$value);
        return $value;
	}

	public static function datePt2Unix($date){
        return \DateTime::createFromFormat('d/m/Y',$date)->format('Y-m-d');
    }
}