<?php

namespace App\Helpers\Envato;
use Illuminate\Support\Facades\DB;

class Currencyhelper
{
	
public static function calculateCurrency($fromCurrency, $toCurrency, $amount) {
    $amount = urlencode($amount);
    $fromCurrency = urlencode($fromCurrency);
    $toCurrency = urlencode($toCurrency);
    $rawdata = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$fromCurrency&to=$toCurrency");
    $data = explode('bld>', $rawdata);
    //$data = explode($toCurrency, $data[1]);
    return round($data[0], 2);
}

}
?>