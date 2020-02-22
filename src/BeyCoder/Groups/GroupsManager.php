<?php

namespace BeyCoder\Groups;

use _64FF00\PurePerms\PPGroup;
use BeyCoder\ApiManager;
use BeyCoder\Prefix\PlayerGroupChangeEvent;
use BeyCoder\Prefix\PrefixData;
use pocketmine\IPlayer;
use pocketmine\utils\Config;

class GroupsManager{

    /**
     * @var ApiManager $manager
     */
    private $manager;

    /**
     * @var IPlayer $player
     */
    private $player;

    /**
     * PrefixManager constructor.
     * @param ApiManager $manager
     * @param IPlayer $player
     */
    public function __construct(ApiManager $manager, IPlayer $player)
    {
        $this->manager = $manager;
        $this->player = $player;
    }

    public static function initializePath()
    {
        if(!file_exists("groupsData")) @mkdir("groupsData");
    }

    /**
     * @return IPlayer
     */
    public function getPlayer(): IPlayer
    {
        return $this->player;
    }

    /**
     * @return ApiManager
     */
    public function getManager(): ApiManager
    {
        return $this->manager;
    }

    /**
     * @param string $groupName
     */
    public function setGroup(string $groupName)
    {
        $this->getManager()->getDatabaseManager()->getDatabaseGroups()->setGroup(new GroupsSaveSystem($this->getPlayer(), $groupName));
        $this->getManager()->getServer()->getPluginManager()->callEvent(new PlayerGroupChangeEvent($this->getPlayer(), $groupName));

        $group = $this->getManager()->getPurePerms()->getGroup($groupName);
        $this->getManager()->getPurePerms()->setGroup($this->getPlayer(), $group);
    }

    /**
     * @return bool|mixed
     */
    public function getGroupName()
    {
        $data = new PrefixData($this->getPlayer());

        $config = new Config($data->getPath(), Config::JSON);
        return $config->get("groupName");
    }

    /**
     * @return PPGroup|null
     */
    public function getGroup()
    {
        return $this->getManager()->getPurePerms()->getGroup($this->getGroupName());
    }

}