<?php

namespace BeyCoder\Lang;

use BeyCoder\HostAPI\Lang;
use pocketmine\utils\Config;

class LangManager
{

    /**
     * @var string $lang
     */
    private $lang;

    /**
     * LangManager constructor.
     * @param string $lang
     */
    public function __construct($lang = "ru")
    {
        $this->lang = $lang;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * Проверка дирректории
     */
    public static function initializePath()
    {
        if(!file_exists("langData")) @mkdir("langData");
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function get(string $key)
    {
        $error = new Config(LangData::$defaultPath . "NO_DATA.json", Config::JSON);
        $data = new LangData($this->getLang());
        if($data->exists())
        {
             $config = new Config($data->getPath(), Config::JSON);
             if($config->exists($key)) {
                 $value = $config->get($key);

                 if($error->exists($key . "_" . $this->getLang()))
                 {
                     $error->remove($key . "_" . $this->getLang());
                     $error->save();
                 }
                 return $value;
             }else{
                 $error->set($key . "_" . $this->getLang(), "required!");
                 $error->save();
                 return $key;
             }
        }

        $error->set($key . "_" . $this->getLang(), "required!");
        $error->save();
        return $key . "_" . $this->getLang();
    }
}