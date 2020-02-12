<?php

namespace BeyCoder;

use pocketmine\Player;
use pocketmine\utils\Config;

class LangSaveSystem extends LangData implements ISaveable {

    /**
     * @var string $key
     */
    private $key;

    /**
     * @var string $value
     */
    private $value;


    /**
     * LangSaveSystem constructor.
     * @param string $lang
     * @param string $key
     * @param string $value
     */
    public function __construct(string $lang, string $key, string $value)
    {
        parent::__construct($lang);
        $this->key = $key;
        $this->value = $value;
    }

    /**
     *  Save auth data
     */
    public function save(){

        $config = new Config($this->getPath(), Config::JSON);

        $config->set($this->key, $this->value);
        $config->save();
    }
}