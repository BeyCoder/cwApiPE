<?php

namespace BeyCoder\Prefix;

use BeyCoder\ApiManager;
use pocketmine\IPlayer;
use pocketmine\utils\Config;

class PrefixManager
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
        if(!file_exists("prefixData")) @mkdir("prefixData");
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
        $this->getManager()->getDatabaseManager()->getDatabasePrefix()->setPrefix(new PrefixSaveSystem($this->getPlayer(), $prefix, "", ""));
        $this->getManager()->getServer()->getPluginManager()->callEvent(new PlayerPrefixChangeEvent($this->getPlayer(), $prefix));
    }

    /**
     * @return bool|mixed
     */
    public function getPrefix()
    {
        $data = new PrefixData($this->getPlayer());

        $config = new Config($data->getPath(), Config::JSON);
        return "§r§f" . $config->get("prefix") . "§r";
    }

    /**
     * @return bool|mixed
     */
    public function getSuffix()
    {
        $data = new PrefixData($this->getPlayer());

        $config = new Config($data->getPath(), Config::JSON);
        return "§r" . $config->get("suffix");
    }

    /**
     * @return bool|mixed
     */
    public function getLogin()
    {
        $data = new PrefixData($this->getPlayer());
        $config = new Config($data->getPath(), Config::JSON);

        $originalName = $this->getPlayer()->getName();
        $hideName = $config->get("hideLogin");

        if(empty($hideName))
        {
           $hideName = $originalName;
        }

        return $hideName;
    }
}