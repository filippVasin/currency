<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public static function get_currencies()
    {

        $response = file_get_contents($_ENV['API_URL']);

        $data = json_decode($response, true);

        $currencies = array();
        foreach ($data['stock'] as $key=>$item) {
            $currencies[$key]['name'] = $item['name'];
            $currencies[$key]['amount'] = round((float)$item['price']['amount']);
            $currencies[$key]['volume'] = number_format((float)$item['volume'], 2, '.', '');
        }

        return  $currencies;
    }
}
