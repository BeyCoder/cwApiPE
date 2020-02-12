<?php

namespace BeyCoder\Database;

use Exception;

class DatabaseResult{

    /**
     * @var string $data;
     */
    private $data;

    /**
     * @var array $deserializeData
     */
    private $deserializeData;

    /**
     * DatabaseResult constructor.
     * @param string $jsonData
     *
     * @throws Exception
     */
    public function __construct(string $jsonData)
    {
        $this->setData($jsonData);
    }



    /**
     * @param string $data
     *
     * @throws Exception
     */
    public function setData(string $data)
    {
        $result = json_decode($data, true);

        if($result == null || $result == false)
        {
            throw new Exception(json_last_error_msg());
        }

        $this->deserializeData = $result;

        if($this->haveError())
        {
            throw new Exception("[" . $this->deserializeData["error"]["code"] . "] " . $this->deserializeData["error"]["error_message"]);
        }

        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->deserializeData;
    }

    /**
     * @return bool
     */
    public function haveError() : bool
    {
        return !empty($this->deserializeData["error"]);
    }
}