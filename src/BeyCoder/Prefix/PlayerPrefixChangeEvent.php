<?php


namespace BeyCoder\Prefix;


use pocketmine\event\player\PlayerEvent;
use pocketmine\IPlayer;
use pocketmine\Player;

class PlayerPrefixChangeEvent extends PlayerEvent
{
    public static $handlerList = null;

    /**
     * @var string $prefix
     */
    private $prefix;

    public function __construct(IPlayer $player, string $prefix)
    {
        $this->player = $player;
        $this->prefix = $prefix;
    }

    /**
     * @param IPlayer $player
     */
    public function setPlayer(IPlayer $player)
    {
        $this->player = $player;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }
}