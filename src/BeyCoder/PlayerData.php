<?php


namespace BeyCoder;


use pocketmine\IPlayer;
use pocketmine\Player;

class PlayerData implements IPlayer
{

    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isOnline()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isBanned()
    {
        return false;
    }

    /**
     * @param bool $banned
     */
    public function setBanned($banned)
    {
        // TODO: Implement setBanned() method.
    }

    /**
     * @return bool
     */
    public function isWhitelisted()
    {
        // TODO: Implement isWhitelisted() method.
    }

    /**
     * @param bool $value
     */
    public function setWhitelisted($value)
    {
        // TODO: Implement setWhitelisted() method.
    }

    /**
     * @return Player|null
     */
    public function getPlayer()
    {
        return null;
    }

    /**
     * @return int|double
     */
    public function getFirstPlayed()
    {
        return 0;
    }

    /**
     * @return int|double
     */
    public function getLastPlayed()
    {
        return 0;
    }

    /**
     * @return mixed
     */
    public function hasPlayedBefore()
    {
        // TODO: Implement hasPlayedBefore() method.
    }

    /**
     * Checks if the current object has operator permissions
     *
     * @return bool
     */
    public function isOp()
    {
        return false;
    }

    /**
     * Sets the operator permission for the current object
     *
     * @param bool $value
     *
     * @return void
     */
    public function setOp($value)
    {
        // TODO: Implement setOp() method.
    }
}