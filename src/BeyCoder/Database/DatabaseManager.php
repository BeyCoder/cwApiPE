<?php

namespace BeyCoder;

class DatabaseManager{

    /**
     * @var DatabaseAuth $databaseAuth
     */
    private $databaseAuth;

    /**
     * @var DatabaseLang $databaseLang
     */
    private $databaseLang;

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
     * DatabaseManager constructor.
     * @param string $host
     * @param string $api_path
     * @param string $api_key
     */
    public function __construct($host = "localhost", $api_path = "", $api_key = "API_KEY")
    {
        $this->setApiKey($api_key);
        $this->setApiPath($api_path);
        $this->setHost($host);

        $this->databaseAuth = new DatabaseAuth($this);
        $this->databaseLang = new DatabaseLang($this);
    }

    /**
     * @return DatabaseAuth
     */
    public function getDatabaseAuth(): DatabaseAuth
    {
        return $this->databaseAuth;
    }

    /**
     * @return DatabaseLang
     */
    public function getDatabaseLang(): DatabaseLang
    {
        return $this->databaseLang;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->api_key;
    }

    /**
     * @return string
     */
    public function getApiPath(): string
    {
        return $this->api_path;
    }

    /**
     * @param string $api_key
     */
    public function setApiKey(string $api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * @param string $api_path
     */
    public function setApiPath(string $api_path)
    {
        $api_path = ltrim($api_path, "/");

        $this->api_path = $api_path;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host)
    {
        $host = ltrim($host, ["http://", "https://"]);
        $host = rtrim($host, ["/", "&"]);
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getFullHost() : string
    {
        return "http://" . $this->getHost() . $this->getApiPath() . "?api_key=" . $this->getApiKey();
    }

}