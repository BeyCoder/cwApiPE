<?php


namespace BeyCoder\Database;

use BeyCoder\Groups\GroupsSaveSystem;

class DatabaseGroups
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

        $this->getDatabaseManager()->getManager()->getServer()->getScheduler()->scheduleAsyncTask(new AsyncURLTask($host, $api_path, $api_key, "method=getAllGroupsData", "saveAllGroupsData"));
    }

    public function setGroup(GroupsSaveSystem $groupsSaveSystem)
    {
        $host = $this->getDatabaseManager()->getHost();
        $api_path = $this->getDatabaseManager()->getApiPath();
        $api_key = $this->getDatabaseManager()->getApiKey();

        $this->getDatabaseManager()->getManager()->getServer()->getScheduler()->scheduleAsyncTask(new AsyncURLTask($host, $api_path, $api_key, "method=setGroup&login=" . $groupsSaveSystem->getName() . "&groupName=" . $groupsSaveSystem->getGroupName() . "&server=" . $this->getDatabaseManager()->getServer()));
        $groupsSaveSystem->save();
    }
}