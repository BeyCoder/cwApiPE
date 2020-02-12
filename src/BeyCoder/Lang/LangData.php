<?php

namespace BeyCoder\Lang;

use pocketmine\Player;
use pocketmine\utils\Config;

class LangData {

    public static $defaultPath = "langData/";

    /**
     * @var string $path
     */
    private $path;

    /**
     * @var string $lang
     */
    private $lang;

    /**
     * LangData constructor.
     * @param string $lang
     */
    public function __construct(string $lang)
    {
        $this->lang = $lang;
        $this->path = LangData::$defaultPath . $this->getLang() . ".json";
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->getPath());
    }
}