<?php


namespace BeyCoder\Prefix;


use BeyCoder\ISaveable;
use pocketmine\IPlayer;
use pocketmine\utils\Config;

class PrefixSaveSystem extends PrefixData implements ISaveable
{

    /**
     * @var string $prefix
     */
    private $prefix;

    /**
     * PrefixSaveSystem constructor.
     * @param IPlayer $player
     * @param string $prefix
     */
    public function __construct(IPlayer $player, string $prefix)
    {
        parent::__construct($player);
        $this->prefix = $prefix;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function save()
    {
        $config = new Config($this->getPath(), Config::JSON);

        $config->set("prefix", $this->getPrefix());
        $config->save();
    }
}