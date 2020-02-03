<?php

namespace BeyCoder;

use pocketmine\Player;

class AuthManager {

    /**
     * @var Player $player
     */
    private $player;

    /**
     * @var bool $logged
     */
    private $logged;

    public function __construct(Player $player, bool $logged = false)
    {
        $this->player = $player;

        $this->logged = $logged;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @param bool $logged
     */
    public function setLogged(bool $logged)
    {
        $this->logged = $logged;
    }

    /**
     * @return bool
     */
    public function isLogged(): bool
    {
        return $this->logged;
    }

    
}