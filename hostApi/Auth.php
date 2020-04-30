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

                $data[$user->login] = ["id" => $user->id, "password" => $user->password, "cid" => $user->cid];
                $result["users"][] = $data;
                unset($data);
            }
        }else{
            $result["error"] = ["code" => 801, "error_message" => "No users!"];
        }

        $result = json_encode($result);
        file_put_contents("cache_auth.json", $result);
        return $result;
    }

    public static function createUser($login, $password, $cid, $ip)
    {
        $user = R::findOne('users', "login = ?", array(trim(strtolower($login))));
        if(!$user) {
            $newUser = R::dispense("users");
            $newUser->login = (string)$login;
            $newUser->password = (string)$password;
            $newUser->cid = (string)$cid;
            $newUser->ip = (string)$ip;
            $newUser->reg_time = time();
            $newUser->rub = 0;
            $newUser->maxrub = 0;
            R::store($newUser);
            $result["success"] = ["code" => 0, "success_message" => "User is registered!"];
        }else{
            $result["error"] = ["code" => 701, "error_message" => "User is already registered"];
        }

        return json_encode($result);
    }

    public static function updateCID($login, $password, $cid, $ip)
    {
        $user = R::findOne('users', "login = ?", array(trim(strtolower($login))));
        if($user) {
            if($password == $user->password) {
                $user->cid = (string)$cid;
                $user->ip = $ip;
                R::store($user);
                $result["success"] = ["code" => 0, "success_message" => "CID is updated!"];
            }
            else
            {
                $result["error"] = ["code" => 700, "error_message" => "Incorrect password!"];

            }
        }else{
            $result["error"] = ["code" => 702, "error_message" => "User is no registered"];
        }

        return json_encode($result);
    }
}