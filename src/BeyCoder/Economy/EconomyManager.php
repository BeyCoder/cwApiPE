<?php

namespace BeyCoder\Economy;

use BeyCoder\ApiManager;
use pocketmine\IPlayer;
use pocketmine\utils\Config;

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

    /**
     * @return int
     */
    public function getMoney()
    {
        $data = new EconomyData($this->getPlayer(), 0, 0);

        $config = new Config($data->getPath(), Config::JSON);

        $money = $config->get("money");
        if($money == null) $money = 2000;
        return $money;
    }

    /**
     * @return int
     */
    public function getRub()
    {
        $data = new EconomyData($this->getPlayer(), 0, 0);

        $config = new Config($data->getPath(), Config::JSON);
        return $config->get("rub");
    }

    /**
     * @param $money
     */
    public function addMoney(int $money)
    {
        $this->setMoney($this->getMoney() + $money);
    }

    /**
     * @param int $money
     */
    public function reduceMoney(int $money)
    {
        $this->setMoney($this->getMoney() - $money);
    }

    /**
     * @param int $money
     */
    public function setMoney(int $money)
    {
        $this->manager->getDatabaseManager()->getDatabaseEconomy()->setMoney(new EconomySaveSystem($this->getPlayer(), $money, $this->getRub()));
    }

    /**
     * @param int $rub
     */
    public function setRub(int $rub)
    {
        $this->manager->getDatabaseManager()->getDatabaseEconomy()->setMoney(new EconomySaveSystem($this->getPlayer(), $this->getMoney(), $rub));
    }

    /**
     * @param int $money
     */
    public function addRub(int $money)
    {
        $this->setRub($this->getRub() + $money);
    }

    /**
     * @param int $rub
     */
    public function reduceRub(int $rub)
    {
        $this->setRub($this->getRub() - $rub);
    }
}