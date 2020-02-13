<?php

namespace BeyCoder\Database;

use BeyCoder\Auth\AuthSaveSystem;
use Exception;

class DatabaseAuth
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

    public function getAllUserData()
    {
        $this->getDatabaseManager()->getManager()->getServer()->getScheduler()->scheduleAsyncTask(new AsyncURLTask($this->getDatabaseManager()->getHost(), $this->getDatabaseManager()->getApiPath(), $this->getDatabaseManager()->getApiKey(), "method=getAllAuthData", "saveAllUserData"));
    }

    public function createUser(AuthSaveSystem $saveSystem)
    {
        $host = $this->getDatabaseManager()->getHost();
        $api_path = $this->getDatabaseManager()->getApiPath();
        $api_key = $this->getDatabaseManager()->getApiKey();

        $this->getDatabaseManager()->getManager()->getServer()->getScheduler()->scheduleAsyncTask(new AsyncURLTask($host, $api_path, $api_key, "method=createUser&login=" . $saveSystem->getName() . "&password=" . $saveSystem->getPassword() . "&cid=" . $saveSystem->getCid()));
        $saveSystem->save();
    }
}