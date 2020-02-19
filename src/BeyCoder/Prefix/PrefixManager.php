<?php

namespace BeyCoder\Prefix;

use BeyCoder\ApiManager;
use pocketmine\Player;
use pocketmine\utils\Config;

class PrefixManager
{

    /**
     * @var ApiManager $manager
     */
    private $manager;

    /**
     * @var Player $player
     */
    private $player;

    /**
     * PrefixManager constructor.
     * @param ApiManager $manager
     * @param Player $player
     */
    public function __construct(ApiManager $manager, Player $player)
    {
        $this->manager = $manager;
        $this->player = $player;
    }

    public static function initializePath()
    {
        if(!file_exists("prefixData")) @mkdir("prefixData");
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
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
        $this->getManager()->getDatabaseManager()->getDatabasePrefix()->setPrefix(new PrefixSaveSystem($this->getPlayer(), $prefix));
        $this->getManager()->getServer()->getPluginManager()->callEvent(new PlayerPrefixChangeEvent($this->getPlayer(), $prefix));
    }

    /**
     * @return bool|mixed
     */
    public function getPrefix()
    {
        $data = new PrefixData($this->getPlayer());

        $config = new Config($data->getPath(), Config::JSON);
        return "§r" . $config->get("prefix") . "§r";
    }
}