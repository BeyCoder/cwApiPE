<?php

namespace BeyCoder\HostAPI;

include_once "db.php";

use R;

class Lang
{

    /**
     * @return array|false|string
     */
    public static function getAllData()
    {
        $lang = R::findAll("lang");

        $result = array();

        if($lang){
            foreach ($lang as $data){
                $data[$data->key] = ["ru" => $data->ru_data];
                $result["lang"][] = $data;
                unset($data);
            }
        }else{
            $result["error"] = ["code" => 801, "error_message" => "No lang keys!"];
        }

        $result = json_encode($result);
        return $result;
    }
}