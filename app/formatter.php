<?php

function dollarFormatter($number)
{
    if ($number > 0)
    {
        return '$'.number_format($number, 2, '.', ',');
    }
    else
        return '-$'.number_format(abs($number), 2, '.', ',');
}

function dateFormatter($date)
{
    $date = date_create($date);
    return date_format($date, 'M d, Y');
}