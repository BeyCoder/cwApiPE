<?php

namespace BeyCoder\Auth;

use pocketmine\IPlayer;
use pocketmine\OfflinePlayer;
use pocketmine\Player;
use pocketmine\utils\Config;

class AuthData {

    public static $defaultPath = "authData/";

    /**
     * @var IPlayer $player
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
     * @var int $id
     */
    private $id;

    /**
     * @var string $path
     */
    private $path;

    /**
     * AuthData constructor.
     * @param IPlayer $player
     * @param int $id
     * @param string $password
     * @param string $cid
     */
    public function __construct(IPlayer $player, int $id, string $password, string $cid)
    {
        $this->player = $player;
        $this->password = $password;
        $this->cid = $cid;
        $this->id = $id;

        $this->path = AuthData::$defaultPath . $this->getName() . ".json";
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return IPlayer
     */
    public function getPlayer(): IPlayer
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

    /**
     * @return bool
     */
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