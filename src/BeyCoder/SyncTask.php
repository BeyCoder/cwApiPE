<?php


namespace BeyCoder;


use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;

class SyncTask extends PluginTask
{

    /**
     * @var ApiManager $manager
     */
    private $manager;

    /**
     * SyncTask constructor.
     * @param ApiManager $owner
     */
    public function __construct(ApiManager $owner)
    {
        parent::__construct($owner);
        $this->manager = $owner;
    }

    public function onRun($currentTick)
    {
        $this->syncWithDB();
    }

    private function syncWithDB()
    {
        $this->manager->getServer()->getScheduler()->scheduleAsyncTask(new AuthDataBaseSync($this->manager));
    }
}