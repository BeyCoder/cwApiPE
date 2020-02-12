<?php

namespace BeyCoder\Database;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use Exception;
use BeyCoder\ApiManager;

class AsyncURLTask extends AsyncTask {

    /**
     * @var string $host
     */
    private $host;

    /**
     * @var string $api_path
     */
    private $api_path;

    /**
     * @var string $api_key
     */
    private $api_key;

    /**
     * @var string $method
     */
    private $method;

    /**
     * @var string $resultMethod
     */
    private $resultMethod;

    public function __construct(string $host, string $api_path, string $api_key, string $method, string $resultMethod)
    {
        $this->host = $host;
        $this->api_path = $api_path;
        $this->api_key = $api_key;
        $this->method = $method;
        $this->resultMethod = $resultMethod;
    }

    public function getFullHost() : string
    {
        return "http://" . $this->host . $this->api_path . "?api_key=" . $this->api_key . "&" . $this->method;
    }

    public function onRun()
    {
        $result = @file_get_contents($this->getFullHost());
        $this->setResult($result);
    }

    public function onCompletion(Server $server)
    {
        parent::onCompletion($server);

        /**
         * @var ApiManager $plugin
         */
        $resultMethod = $this->resultMethod;
        $plugin = $server->getPluginManager()->getPlugin("cwApiPE");
        $plugin->$resultMethod($this->getResult());
    }
}