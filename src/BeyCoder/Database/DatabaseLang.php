<?php

namespace BeyCoder\Database;

use Exception;

class DatabaseLang
{

    /**
     * @var DatabaseManager $databaseManager
     */
    private $databaseManager;

    public function __construct(DatabaseManager $manager)
    {
        $this->setDatabaseManager($manager);
    }

    /**
     * @param DatabaseManager $databaseManager
     */
    public function setDatabaseManager(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * @return DatabaseManager
     */
    public function getDatabaseManager(): DatabaseManager
    {
        return $this->databaseManager;
    }

    public function getAllData()
    {
        $this->getDatabaseManager()->getManager()->getServer()->getScheduler()->scheduleAsyncTask(new AsyncURLTask($this->getDatabaseManager()->getHost(), $this->getDatabaseManager()->getApiPath(), $this->getDatabaseManager()->getApiKey(), "method=getAllLangData", "saveAllLangData"));
    }
}