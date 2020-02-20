<?php

namespace BeyCoder\Economy;

use BeyCoder\ApiManager;
use pocketmine\IPlayer;

class EconomyManager
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
        if(!file_exists("economyData")) @mkdir("economyData");
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
}