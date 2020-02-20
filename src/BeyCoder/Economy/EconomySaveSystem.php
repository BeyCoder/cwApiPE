<?php


namespace BeyCoder\Economy;

use BeyCoder\ISaveable;
use pocketmine\IPlayer;
use pocketmine\utils\Config;

class EconomySaveSystem extends EconomyData implements ISaveable
{

    /**
     * EconomySaveSystem constructor.
     * @param IPlayer $player
     * @param int $money
     * @param int $rub
     */
    public function __construct(IPlayer $player, int $money, int $rub)
    {
        parent::__construct($player, $money, $rub);
    }

    public function save()
    {
        $config = new Config($this->getPath(), Config::JSON);

        $config->set("money", $this->getMoney());
        $config->set("rub", $this->getRub());
        $config->save();
    }
}