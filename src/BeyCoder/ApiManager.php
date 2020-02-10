<?php

namespace BeyCoder;

use pocketmine\plugin\PluginBase;

class ApiManager extends PluginBase{

    /**
     * @var DatabaseManager $databaseManager
     */
    private $databaseManager;

    public function onEnable()
    {
        $this->getLogger()->info("CoderWorld API система функционирует!");

        AuthManager::initializePath();
        LangManager::initializePath();

        $this->databaseManager = new DatabaseManager();

        $this->startSync();
    }

    /**
     * @return DatabaseManager
     */
    public function getDatabaseManager() : DatabaseManager
    {
        return $this->databaseManager;
    }

    private function startSync()
    {
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new SyncTask($this), 20 * 60 * 60);
    }
}
