<?php

namespace BeyCoder\HostAPI;

include_once "db.php";

use R;

class Groups
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

                $user->groupName_server_1 = "Guest";
                R::store($user);

                $data[$user->login] = ["groupName" => $user->groupName_server_1];
                $result["users"][] = $data;
            }
        }else{
            $result["error"] = ["code" => 801, "error_message" => "No users!"];
        }

        $result = json_encode($result);
        return $result;
    }

    /**
     * @param $login
     * @param $groupName
     * @return false|string
     */
    public static function setGroup($login, $groupName)
    {
        $user = R::findOne('users', "login = ?", array(trim(strtolower($login))));
        if($user)
        {
            $user->groupName_server_1 = $groupName;
            R::store($user);
            $result["success"] = ["code" => 0, "success_message" => "Group is updated!"];
        }else{
            $result["error"] = ["code" => 702, "error_message" => "User is no registered"];
        }

        return json_encode($result);
    }
}