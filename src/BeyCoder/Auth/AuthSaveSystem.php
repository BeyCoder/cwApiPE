<?php

namespace BeyCoder;

use pocketmine\Player;
use pocketmine\utils\Config;

class AuthSaveSystem extends AuthData implements ISaveable {

    /**
     * AuthSystem constructor.
     * @param Player $player
     * @param string $password
     * @param string $cid
     */
    public function __construct(Player $player, string $password, string $cid = "NO_CID")
    {
        parent::__construct($player, $password, $cid);
    }

    /**
     *  Save auth data
     */
    public function save(){

        $config = new Config($this->getPath(), Config::JSON);

        $config->set("password", $this->getPassword());
        $config->set("cid", $this->getCid());
        $config->save();
    }
}