<?php


namespace BeyCoder\Security;


use BeyCoder\ISaveable;
use pocketmine\IPlayer;
use pocketmine\utils\Config;

class SecuritySaveSystem extends SecurityData implements ISaveable
{

    /**
     * @var string $prefix
     */
    private $ban;

    public function __construct(IPlayer $player, string $ban)
    {
        parent::__construct($player);
        $this->ban = $ban;
    }

    /**
     * @return string
     */
    /*public function getPrefix(): string
    {
        return $this->prefix;
    }*/

    public function save()
    {
        //$config = new Config($this->getPath(), Config::JSON);

        //$config->set("prefix", $this->getPrefix());
        //$config->save();
    }
}