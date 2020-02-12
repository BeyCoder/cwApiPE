<?php

use BeyCoder\HostAPI;

$API_KEY = "API_KEY";
$data = $_REQUEST;

$result = array();

if($data['api_key'] == $API_KEY)
{
    switch ($data['method'])
    {
        case "getAllAuthData":
            $result = HostAPI\Auth::getAllData();
            break;

        case "getAllLangData":
            $result = HostAPI\Lang::getAllData();
            break;
    }
}
else
{
    $resultData["error"] = ["code" => 001, "error_message" => "Access denied! Key is invalid!"];
    $result = json_encode($resultData);
}

die($result);