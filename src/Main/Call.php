<?php
/**
 * Created by PhpStorm.
 * User: mrAndersen
 * Date: 26.04.2015
 * Time: 21:41
 */

namespace Main;

use Twig_Environment;
use Twig_Loader_Filesystem;

class Call {

    private static $apiKey  = '675ec9369297b0e30bd0de214cb4a071';
    private static $apiKey2 = 'ae81e97afceff224e462ba53be63ecf5';

    private static $url1    = 'https://vmestosms.ru/call.php';
    private static $url2    = 'https://api.wowcall.ru/call_xml.php';

    private static $host    = '46.182.30.136';

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

    public static function genXML($redirectPhone)
    {
        $twig = new Twig_Environment(new Twig_Loader_Filesystem('src/Resources'));
        $xml = $twig->render('callSchema.xml.twig',[
            'redirect_phone' => $redirectPhone
        ]);
        return file_put_contents('schema.xml',$xml);
    }

    public static function call2($phone, $redirectPhone)
    {
        $xmlURL = "http://".self::$host."/schema.xml";
        $query = http_build_query(['apiKey' => self::$apiKey2, 'phone' => $phone, 'xmlUrl' => $xmlURL]);
        $url = self::$url2.'?'.$query;

        echo "Calling ".$url;
        $json = json_decode(file_get_contents($url),true);
        return $json;
    }

}