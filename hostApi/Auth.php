<?php

namespace BeyCoder\HostAPI;

include_once "db.php";

use R;

class Auth
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
                $data[$user->login] = ["id" => $user->id,"password" => $user->password, "cid" => $user->cid];
                $result["users"][] = $data;
            }
        }else{
            $result["error"] = ["code" => 801, "error_message" => "No users!"];
        }

        $result = json_encode($result);
        return $result;
    }

    public static function createUser(string $login, string $password, string $cid)
    {
        $user = R::findOne('users', "login = ?", array(trim(strtolower($login))));
        if(!$user) {
            $user = R::dispense("users");
            $user->login = $login;
            $user->password = $password;
            $user->cid = $cid;
            $user->ip = $_SERVER['REMOTE_ADDR'];
            $user->reg_time = time();
            $user->rub = 0;
            $user->maxrub = 0;
            R::store($user);
            $result["success"] = ["code" => 0, "success_message" => "User is registered!"];
        }else{
            $result["error"] = ["code" => 701, "error_message" => "User is already registered"];
        }
    }
}