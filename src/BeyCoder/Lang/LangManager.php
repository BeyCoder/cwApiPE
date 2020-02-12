<?php

namespace BeyCoder;

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
        if(@dir("langData")) @mkdir("langData");
    }

    /**
     * @param string $key
     *
     * @return string|bool
     */
    public function get(string $key)
    {
        $data = new LangData($this->getLang());
        if($data->exists())
        {
             $config = new Config($data->getPath(), Config::JSON);
             if($config->exists($key)) {
                 $value = $config->get($key);
                 return $value;
             }else{
                 return false;
             }
        }
        return false;
    }
}