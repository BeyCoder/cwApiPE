<?php


namespace BeyCoder\Prefix;


use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class PlayerPrefixChangeEvent extends PlayerEvent
{
    public static $handlerList = null;

    /**
     * @var string $prefix
     */
    private $prefix;

    public function __construct(Player $player, string $prefix)
    {
        $this->player = $player;
        $this->prefix = $prefix;
    }

    /**
     * @param Player $player
     */
    public function setPlayer(Player $player)
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