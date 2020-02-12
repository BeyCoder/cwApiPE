<?php

namespace BeyCoder;

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

    /**
     * @return DatabaseResult
     *
     * @throws Exception
     */
    public function getAllData() : DatabaseResult
    {
        $result = file_get_contents($this->databaseManager->getFullHost() . "&method=getAllLangData");

        $parser = new DatabaseResult($result);
        return $parser;
    }
}