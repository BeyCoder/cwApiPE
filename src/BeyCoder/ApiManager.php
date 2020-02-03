<?php

namespace BeyCoder;

use pocketmine\plugin\PluginBase;

class ApiManager extends PluginBase{

    public function onEnable()
    {
        $this->getLogger()->info("CoderWorld API система функционирует!");

        AuthManager::initializePath();
    }
}
