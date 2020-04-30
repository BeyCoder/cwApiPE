<?php

namespace BeyCoder\HostAPI;

include_once "db.php";

use R;

class Groups
{

    /**
     * @param int $server
     * @return array|false|string
     */
    public static function getAllData($server)
    {
        $users = R::findAll("users");

        $result = array();

        if($users){
            foreach ($users as $user) {
                if ($server == 0) {
                    $data[$user->login] = ["groupName" => $user->groupName_server_1];
                    $result["users"][] = $data;
                }
                else if ($server == 1)
                {
                    $data[$user->login] = ["groupName" => $user->groupName_server_2];
                    $result["users"][] = $data;
                }else
                {
                    $result["error"] = ["code" => 802, "error_message" => "No server!"];
                }
                unset($data);
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
    public static function setGroup($login, $groupName, $server)
    {
        $user = R::findOne('users', "login = ?", array(trim(strtolower($login))));
        if($user)
        {
            if ($server == 0) {
                $user->groupName_server_1 = $groupName;
                R::store($user);
                $result["success"] = ["code" => 0, "success_message" => "Group is updated!"];
            }
            else if ($server == 1)
            {
                $user->groupName_server_2 = $groupName;
                R::store($user);
                $result["success"] = ["code" => 0, "success_message" => "Group is updated!"];
            }else
            {
                $result["error"] = ["code" => 802, "error_message" => "No server!"];
            }
        }else{
            $result["error"] = ["code" => 702, "error_message" => "User is no registered"];
        }

        return json_encode($result);
    }
}