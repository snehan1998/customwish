<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public static function pushchecklocation($location)
    {
      //  dd($location);
        $orderdetail = new Location();
        $orderdetai['source'] = 572107;
        $orderdetai['destination'] =$location;
        $orderdetai['paymentType'] = "ppd";
        $orderdetai=json_encode($orderdetai);

        $c = curl_init();
        $url = "https://v1thirdpartyapi.shpgodev.xyz/authToken";
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS,"username=SGMU2103081068&password=ShippigoStaging@746");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $server_output = curl_exec($c);
        curl_close($c);
        $server_output = json_decode($server_output,true);
        //print_r($server_output);
        $url = "https://v1thirdpartyapi.shpgodev.xyz/serviceAndRates";
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS,$orderdetai);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($c, CURLOPT_HTTPHEADER,array('Content-Type:application/json','Authorization: Bearer'.$server_output['token'].''));
        $result = curl_exec($c);
        curl_close($c);
        $result = json_decode($result,true);
        //print_r($result);
            $status = $result['status'];
            $message = $result['message'];
           // print_r($message);
         return (['status'=>$result['status'],'message'=>$result['message']]);
    }

}
