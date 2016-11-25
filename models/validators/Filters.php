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
}