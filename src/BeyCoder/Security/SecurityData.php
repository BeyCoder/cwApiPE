<?php


namespace BeyCoder\Security;


use pocketmine\IPlayer;

class SecurityData
{

    public static $defaultPath = "securityData/";

    /**
     * @var IPlayer $player
     */
    private $player;

    /**
     * @var string $path
     */
    private $path;


    /**
     * PrefixData constructor.
     * @param IPlayer $player
     */
    public function __construct(IPlayer $player)
    {
        $this->player = $player;
        $this->path = SecurityData::$defaultPath . $this->getName() . ".json";
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
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->getPath());
    }
}