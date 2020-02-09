<?php

namespace BeyCoder;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class AuthDataBaseSync extends AsyncTask {

    /**
     * @var ApiManager $apiManager
     */
    private $apiManager;

    //TODO: DB SYSTEM

    public function __construct(ApiManager $apiManager)
    {
        $this->apiManager = $apiManager;
    }

    public function onRun()
    {
        // TODO: Implement onRun() method
    }

    public function onCompletion(Server $server)
    {
        parent::onCompletion($server);
    }
}