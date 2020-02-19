<?php

namespace BeyCoder\HostAPI;

include_once "db.php";

use R;

class Prefix
{

    /**
     * @return array|false|string
     */
    public static function getAllData()
    {
        $users = R::findAll("users");

        $result = array();

        if($users){
            foreach ($users as $user){
                $data[$user->login] = ["prefix" => $user->prefix];
                $result["users"][] = $data;

                //echo $user->login . "</br>";
            }
        }else{
            $result["error"] = ["code" => 801, "error_message" => "No users!"];
        }

        $result = json_encode($result);
        return $result;
    }

    /**
     * @param $login
     * @param $prefix
     * @return false|string
     */
    public static function setPrefix($login, $prefix)
    {
        $user = R::findOne('users', "login = ?", array(trim(strtolower($login))));
        if($user)
        {
            $user->prefix = $prefix;
            R::store($user);
            $result["success"] = ["code" => 0, "success_message" => "Prefix is updated!"];
        }else{
            $result["error"] = ["code" => 702, "error_message" => "User is no registered"];
        }

        return json_encode($result);
    }
}