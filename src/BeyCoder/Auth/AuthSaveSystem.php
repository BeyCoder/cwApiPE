<?php

namespace BeyCoder;

use pocketmine\Player;
use pocketmine\utils\Config;

class AuthSaveSystem extends AuthData implements ISaveable {

    /**
     * AuthSystem constructor.
     * @param Player $player
     * @param string $password
     */
    public function __construct(Player $player, string $password)
    {
        parent::__construct($player, $password);
    }

    /**
     *  Save auth data
     */
    public function save(){

        $config = new Config($this->getPath(), Config::JSON);

        $config->set("password", $this->getPassword());
        $config->save();
    }
}