<?php


namespace BeyCoder\Groups;


use pocketmine\event\player\PlayerEvent;
use pocketmine\IPlayer;
use pocketmine\Player;

class PlayerGroupChangeEvent extends PlayerEvent
{
    public static $handlerList = null;

    /**
     * @var string $prefix
     */
    private $groupName;

    public function __construct(IPlayer $player, string $groupName)
    {
        $this->player = $player;
        $this->groupName = $groupName;
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
    public function getGroupName(): string
    {
        return $this->groupName;
    }
}