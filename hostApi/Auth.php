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
        /*$user = R::dispense("users");
        $user->login = "beycoder";
        $user->password = "lol";
        $user->cid = "no_cid";
        R::store($user);*/

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
}