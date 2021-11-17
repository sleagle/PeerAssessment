<?php


namespace App\Utility;


class CSVToArray
{

    public static function readCSVToArray($file)
    {
        $csv = array_map('str_getcsv', file($file));
        array_walk($csv, function (&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv);

        return $csv;
    }
}