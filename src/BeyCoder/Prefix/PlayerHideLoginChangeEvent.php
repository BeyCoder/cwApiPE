<?php


namespace BeyCoder\Prefix;


use pocketmine\event\player\PlayerEvent;
use pocketmine\IPlayer;
use pocketmine\Player;

class PlayerHideLoginChangeEvent extends PlayerEvent
{
    public static $handlerList = null;

    /**
     * @var string $hideLogin
     */
    private $hideLogin;

    public function __construct(IPlayer $player, string $hideLogin)
    {
        $this->player = $player;
        $this->hideLogin = $hideLogin;
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
    public function getHideLogin(): string
    {
        return $this->hideLogin;
    }
}