<?php


namespace BeyCoder\Database;

use BeyCoder\Prefix\PrefixSaveSystem;

class DatabasePrefix
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
        $host = $this->getDatabaseManager()->getHost();
        $api_path = $this->getDatabaseManager()->getApiPath();
        $api_key = $this->getDatabaseManager()->getApiKey();

        $this->getDatabaseManager()->getManager()->getServer()->getScheduler()->scheduleAsyncTask(new AsyncURLTask($host, $api_path, $api_key, "method=getData", "saveAllPrefixData"));
    }

    public function setPrefix(PrefixSaveSystem $prefixData)
    {
        $host = $this->getDatabaseManager()->getHost();
        $api_path = $this->getDatabaseManager()->getApiPath();
        $api_key = $this->getDatabaseManager()->getApiKey();

        $this->getDatabaseManager()->getManager()->getServer()->getScheduler()->scheduleAsyncTask(new AsyncURLTask($host, $api_path, $api_key, "method=setPrefix&prefix=" . $prefixData->getPrefix(), "saveAllPrefixData"));
        $prefixData->save();
    }
}