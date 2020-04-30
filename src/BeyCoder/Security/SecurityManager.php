<?php

namespace BeyCoder\Security;

use BeyCoder\ApiManager;
use pocketmine\IPlayer;
use pocketmine\utils\Config;

class SecurityManager
{

    /**
     * @var ApiManager $manager
     */
    private $manager;

    /**
     * @var IPlayer $player
     */
    private $player;

    /**
     * PrefixManager constructor.
     * @param ApiManager $manager
     * @param IPlayer $player
     */
    public function __construct(ApiManager $manager, IPlayer $player)
    {
        $this->manager = $manager;
        $this->player = $player;
    }

    public static function initializePath()
    {
        if(!file_exists("securityData")) @mkdir("securityData");
    }

    /**
     * @return IPlayer
     */
    public function getPlayer(): IPlayer
    {
        return $this->player;
    }

    /**
     * @return ApiManager
     */
    public function getManager(): ApiManager
    {
        return $this->manager;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix)
    {
        //$this->getManager()->getDatabaseManager()->getDatabasePrefix()->setPrefix(new PrefixSaveSystem($this->getPlayer(), $prefix));
        //$this->getManager()->getServer()->getPluginManager()->callEvent(new PlayerPrefixChangeEvent($this->getPlayer(), $prefix));
    }

    /**
     * @return bool|mixed
     */
    public function getPrefix()
    {
        //$data = new PrefixData($this->getPlayer());

        //$config = new Config($data->getPath(), Config::JSON);
        //return "§r" . $config->get("prefix") . "§r";
    }
}