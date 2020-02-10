<?php

use BeyCoder\HostAPI;

$API_KEY = "API_KEY";
$data = $_REQUEST;

$result = "[]";

if($data['api_key'] == $API_KEY)
{
    switch ($data['method'])
    {
        case "getAllAuthData":
            $result = HostAPI\Auth::getAllData();
            break;
    }
}
else
{
    $data["error"] = ["code" => 001, "error_message" => "Access denied! Key is invalid!"];
    $result = json_encode($data);
}

die($result);