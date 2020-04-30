<?php

namespace BeyCoder\HostAPI;

include_once "db.php";

use R;

class Prefix
{

    /**
     * @return array|false|string
     */
    public static function getAllData($server)
    {
        $users = R::findAll("users");

        $result = array();

        if($users){
            foreach ($users as $user){
                if($server == 0)
                {
                    $data[$user->login] = ["prefix" => $user->prefix_server_1, "suffix" => $user->suffix_server_1, "hideLogin" => $user->hide_login];
                }
                else if($server == 1)
                {
                    $data[$user->login] = ["prefix" => $user->prefix_server_2, "suffix" => $user->suffix_server_2, "hideLogin" => $user->hide_login];
                }
                $result["users"][] = $data;
                unset($data);

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