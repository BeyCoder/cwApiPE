<?php

namespace BeyCoder;

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

    /**
     * @return DatabaseResult
     *
     * @throws Exception
     */
    public function getAllUserData() : DatabaseResult
    {
        $result = file_get_contents($this->databaseManager->getFullHost() . "&method=getAllAuthData");

        $parser = new DatabaseResult($result);
        return $parser;
    }
}