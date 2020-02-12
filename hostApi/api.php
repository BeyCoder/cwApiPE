<?php

namespace BeyCoder;

include_once "Auth.php";
include_once "Lang.php";

use BeyCoder\HostAPI\Auth;
use BeyCoder\HostAPI\Lang;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$API_KEY = "API_KEY";
$data = $_REQUEST;

$result = array();

if($data['api_key'] == $API_KEY)
{
    switch ($data['method'])
    {
        case "getAllAuthData":
            $result = Auth::getAllData();
            break;

        case "getAllLangData":
            $result = Lang::getAllData();
            break;

        default:
            $resultData["error"] = ["code" => 002, "error_message" => "Undefined method!"];
            break;
    }
}
else
{
    $resultData["error"] = ["code" => 001, "error_message" => "Access denied! Key is invalid!"];
    $result = json_encode($resultData);
}

die($result);