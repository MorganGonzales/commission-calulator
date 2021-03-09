<?php

function main ($argv)
{
    if ($argv[1] ?? false) {
        $csv = array_map('str_getcsv', file($argv[1]));
        print_r($csv);
    }
}

main($argv);
