<?php

namespace BeyCoder\Database;

use BeyCoder\Auth\AuthSaveSystem;
use BeyCoder\Economy\EconomySaveSystem;
use Exception;

class DatabaseEconomy
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
        $this->getDatabaseManager()->getManager()->getServer()->getScheduler()->scheduleAsyncTask(new AsyncURLTask($this->getDatabaseManager()->getHost(), $this->getDatabaseManager()->getApiPath(), $this->getDatabaseManager()->getApiKey(), "method=getAllEconomyData", "saveAllEconomyData"));
    }

    public function setMoney(EconomySaveSystem $saveSystem)
    {
        $host = $this->getDatabaseManager()->getHost();
        $api_path = $this->getDatabaseManager()->getApiPath();
        $api_key = $this->getDatabaseManager()->getApiKey();

        $this->getDatabaseManager()->getManager()->getServer()->getScheduler()->scheduleAsyncTask(new AsyncURLTask($host, $api_path, $api_key, "method=setMoney&login=" . $saveSystem->getName() . "&money=" . $saveSystem->getMoney()));
        $saveSystem->save();
    }
}