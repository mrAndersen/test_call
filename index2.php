<?php
require_once "vendor/autoload.php";
Twig_Autoloader::register();

if(empty($_GET)){
    $twig = new Twig_Environment(new Twig_Loader_Filesystem('src/Resources'));

    echo $twig->render('index2.html.twig');
}elseif(isset($_GET['request_xml_call'])){
    $phone          = $_POST['phone'];
    $redirect_phone = $_POST['redirect_phone'];
    //Опять таки валидация...
    if(\Main\Call::genXML($redirect_phone)){
        header('Content-Type: application/json');
        echo json_encode(\Main\Call::call2($phone,$redirect_phone));
    }
}



