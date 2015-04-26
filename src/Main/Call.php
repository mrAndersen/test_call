<?php
/**
 * Created by PhpStorm.
 * User: mrAndersen
 * Date: 26.04.2015
 * Time: 21:41
 */

namespace Main;


class Call {

    private static $apiKey  = '675ec9369297b0e30bd0de214cb4a071';
    private static $url1    = 'https://vmestosms.ru/call.php';
    private static $url2    = 'https://api.wowcall.ru/call_xml.php';

    /**
     * @param $password
     * @param $phone
     * @return bool
     */
    public static function call($password, $phone)
    {
        $query = http_build_query(['apiKey' => self::$apiKey, 'phone' => $phone, 'password' => $password]);
        $url = self::$url1.'?'.$query;

        $json = json_decode(file_get_contents($url),true);
        if($json['status'] == 'ok' && $json['callStatus'] == 'answer'){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    /**
     * @param $phone
     * @param $xmlURL
     */
    public static function call2($phone, $xmlURL)
    {
        $query = http_build_query(['apiKey' => self::$apiKey, 'phone' => $phone, 'xmlUrl' => $xmlURL]);

    }

}