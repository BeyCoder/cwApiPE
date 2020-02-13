<?php

namespace BeyCoder\Auth;

use pocketmine\OfflinePlayer;
use pocketmine\Player;
use pocketmine\utils\Config;

class AuthData {

    public static $defaultPath = "authData/";

    /**
     * @var OfflinePlayer|Player
     */
    private $player;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $cid
     */
    private $cid;

    /**
     * @var string $path
     */
    private $path;

    /**
     * AuthData constructor.
     * @param Player|OfflinePlayer $player
     * @param string $password
     * @param string $cid
     */
    public function __construct($player, string $password, string $cid)
    {
        $this->player = $player;
        $this->password = $password;
        $this->cid = $cid;

        $this->path = AuthData::$defaultPath . $this->getName() . ".json";
    }

    /**
     * @return Player|OfflinePlayer
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return strtolower($this->getPlayer()->getName());
    }

    /**
     * @return string
     */
    public function getCid(): string
    {
        return $this->cid;
    }

    /**
     * @return string
     */
    public function getFullName() : string
    {
        return $this->getPlayer()->getName();
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function auth()
    {
        if($this->exists()){
            $config = new Config($this->getPath(), Config::JSON);
            $password = $config->get("password");
            $cid = $config->get("cid");

            return $password == $this->getPassword() || $this->getPlayer()->getClientId() == $cid;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->getPath());
    }
}