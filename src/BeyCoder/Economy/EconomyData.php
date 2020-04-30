<?php


namespace BeyCoder\Economy;

use pocketmine\IPlayer;

class EconomyData
{

    public static $defaultPath = "economyData/";

    /**
     * @var IPlayer $player
     */
    private $player;

    /**
     * @var string $path
     */
    private $path;

    /**
     * @var int $money
     */
    private $money;

    /**
     * @var int $rub
     */
    private $rub;

    /**
     * EconomyData constructor.
     * @param IPlayer $player
     * @param int $money
     * @param int $rub
     */
    public function __construct(IPlayer $player, int $money = 2000, int $rub = 0)
    {
        $this->player = $player;
        $this->path = EconomyData::$defaultPath . $this->getName() . ".json";
        $this->setMoney($money);
        $this->setRub($rub);
    }

    /**
     * @return IPlayer
     */
    public function getPlayer(): IPlayer
    {
        return $this->player;
    }

    /**
     * @param int $money
     */
    public function setMoney(int $money)
    {
        $this->money = $money;
    }

    /**
     * @param int $rub
     */
    public function setRub(int $rub)
    {
        $this->rub = $rub;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return strtolower($this->getPlayer()->getName());
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @return int
     */
    public function getRub()
    {
        return $this->rub;
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->getPath());
    }
}