<?php


namespace BeyCoder\Groups;


use BeyCoder\ISaveable;
use pocketmine\IPlayer;
use pocketmine\utils\Config;

class GroupsSaveSystem extends GroupsData implements ISaveable
{

    /**
     * @var string $prefix
     */
    private $groupName;

    /**
     * @return string
     */
    public function getGroupName(): string
    {
        return $this->groupName;
    }

    /**
     * PrefixSaveSystem constructor.
     * @param IPlayer $player
     * @param string $groupName
     */
    public function __construct(IPlayer $player, string $groupName)
    {
        parent::__construct($player);
        $this->groupName = $groupName;
    }

    public function save()
    {
        $config = new Config($this->getPath(), Config::JSON);

        $config->set("groupName", $this->getGroupName());
        $config->save();
    }
}