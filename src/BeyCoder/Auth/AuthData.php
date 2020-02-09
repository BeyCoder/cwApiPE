<?php

namespace BeyCoder;

use pocketmine\Player;
use pocketmine\utils\Config;

class AuthData {

    public static $defaultPath = "authData/";

    /**
     * @var Player $player
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

    public function __construct(Player $player, string $password, string $cid)
    {
        $this->player = $player;
        $this->password = $password;
        $this->cid = $cid;

        $this->path =  AuthData::$defaultPath . $this->getName() . ".json";
    }

    /**
     * @return Player
     */
    public function getPlayer() : Player
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

            return $password == $this->getPassword();
        }

        return false;
    }

    /**
     * @return bool
     */
    public function exists()
    {
        //$config = new Config($this->getPath(), Config::JSON);

        return file_exists($this->getPath());
    }
}