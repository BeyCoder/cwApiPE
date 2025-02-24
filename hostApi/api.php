<?php

namespace BeyCoder;

include_once "Auth.php";
include_once "Lang.php";
include_once "Prefix.php";
include_once "Economy.php";
include_once "Groups.php";

use BeyCoder\HostAPI\Auth;
use BeyCoder\HostAPI\Lang;
use BeyCoder\HostAPI\Prefix;
use BeyCoder\HostAPI\Economy;
use BeyCoder\HostAPI\Groups;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$API_KEY = "API_KEY";
$data = $_REQUEST;

if($data['api_key'] == $API_KEY)
{
    switch ($data['method'])
    {
        case "getAllAuthData":
            $result = Auth::getAllData();
            break;

        case "getAllEconomyData":
            $result = Economy::getAllData();
            break;

        case "getAllGroupsData":
            $result = Groups::getAllData($data['server']);
            break;

        case "getAllLangData":
            $result = Lang::getAllData();
            break;

        case "createUser":
            $result = Auth::createUser((string)$data["login"], (string)$data["password"], (string)$data["cid"], (string)$data["ip"]);
            break;

        case "updateCID":
            $result = Auth::updateCID((string)$data["login"], (string)$data["password"], (string)$data["cid"], (string)$data["ip"]);
            break;

        case "getAllPrefixData":
            $result = Prefix::getAllData($data['server']);
            break;

        case "setPrefix":
            $result = Prefix::setPrefix((string)$data["login"], (string)$data["prefix"]);
            break;

        case "setGroup":
            $result = Groups::setGroup((string)$data["login"], (string)$data["groupName"], $data['server']);
            break;

        case "setMoney":
            $result = Economy::setMoney((string)$data["login"], (string)$data["money"]);
            break;

        case "setRub":
            $result = Economy::setRub((string)$data["login"], (string)$data["rub"]);
            break;

        default:
            $resultData["error"] = ["code" => 002, "error_message" => "Undefined method!"];
            $result = json_encode($resultData);
            break;
    }
}
else
{
    $resultData["error"] = ["code" => 001, "error_message" => "Access denied! Key is invalid!"];
    $result = json_encode($resultData);
}

die($result);