<?php

namespace BeyCoder\HostAPI;

include_once "db.php";

use R;

class Economy
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
/*                $user->money = 2000;
                R::store($user);*/
                $data[$user->login] = ["rub" => $user->rub, "money" => $user->money];
                $result["users"][] = $data;
                unset($data);
            }
        }else{
            $result["error"] = ["code" => 801, "error_message" => "No users!"];
        }

        $result = json_encode($result);
        return $result;
    }

    public static function setMoney($login, $money)
    {
        $user = R::findOne('users', "login = ?", array(trim(strtolower($login))));
        if($user) {
            $user->money = $money;
            R::store($user);

            $result["success"] = ["code" => 0, "success_message" => "Money is updated!"];
        }else{
            $result["error"] = ["code" => 702, "error_message" => "User is no registered"];
        }

        return json_encode($result);
    }

    public static function setRub($login, $rub)
    {
        $user = R::findOne('users', "login = ?", array(trim(strtolower($login))));
        if($user) {
            $user->rub = $rub;
            R::store($user);

            $result["success"] = ["code" => 0, "success_message" => "Rub is updated!"];
        }else{
            $result["error"] = ["code" => 702, "error_message" => "User is no registered"];
        }

        return json_encode($result);
    }
}