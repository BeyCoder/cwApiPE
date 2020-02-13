<?php

namespace BeyCoder\Auth;

use pocketmine\OfflinePlayer;
use pocketmine\Player;
use pocketmine\utils\Config;
use BeyCoder\ISaveable;

class AuthSaveSystem extends AuthData implements ISaveable {

    /**
     * AuthSystem constructor.
     * @param Player|OfflinePlayer $player
     * @param int $id
     * @param string $password
     * @param string $cid
     */
    public function __construct($player, int $id, string $password, string $cid = "NO_CID")
    {
        parent::__construct($player, $id, $password, $cid);
    }

    /**
     *  Save auth data
     */
    public function save(){

        $config = new Config($this->getPath(), Config::JSON);

        $config->set("id", $this->getId());
        $config->set("password", $this->getPassword());
        $config->set("cid", $this->getCid());
        $config->save();
    }
}