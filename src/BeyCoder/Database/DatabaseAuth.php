<?php


namespace BeyCoder;


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

    /**
     * @return DatabaseResult
     */
    public function getAllUserData()
    {
        $result = file_get_contents($this->databaseManager->getFullHost() . "&method=getAllAuthData");

        return $result;
    }
}