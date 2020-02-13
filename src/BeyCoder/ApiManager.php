<?php

namespace BeyCoder;

use BeyCoder\Auth\AuthSaveSystem;
use BeyCoder\Database\AsyncURLTask;
use BeyCoder\Database\DatabaseResult;
use BeyCoder\Lang\LangSaveSystem;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use BeyCoder\Auth\AuthManager;
use BeyCoder\Lang\LangManager;
use BeyCoder\Database\DatabaseManager;
use Exception;

class ApiManager extends PluginBase {

    /**
     * @var DatabaseManager $databaseManager
     */
    private $databaseManager;

    public function onEnable()
    {
        $this->getLogger()->info("CoderWorld API система функционирует!");

        AuthManager::initializePath();
        LangManager::initializePath();

        $this->databaseManager = new DatabaseManager($this, "localhost", "api.php", "API_KEY");

        $this->startSync();
    }

    /**
     * @return DatabaseManager
     */
    public function getDatabaseManager() : DatabaseManager
    {
        return $this->databaseManager;
    }

    private function startSync()
    {
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new SyncTask($this), 20 * 60);
    }

    public function saveAllUserData($result)
    {
        try {
            $data = new DatabaseResult($result);

            foreach ($data->getData()["users"] as $new){
                foreach ($new as $name => $user) {
                    $player = $this->getServer()->getOfflinePlayer($name);
                    $authData = new AuthSaveSystem($player, $user["id"], $user["password"], $user["cid"]);

                    $authData->save();
                }
            }

            $this->getLogger()->info("Синхронизация системы авторизации прошла успешно!");

        }catch (Exception $exception){
            $this->getLogger()->critical("Произошла ошибка во время синхронизации базы данных авторизации!");
            $this->getLogger()->critical("Ошибка: " . $exception->getMessage());
        }
    }

    public function saveAllLangData($result)
    {
        try {
            $data = new DatabaseResult($result);

            foreach ($data->getData()["lang"] as $value){
                $key = $value["key"];

                foreach ($value as $name => $info)
                {
                    if(strpos($name, "_data"))
                    {
                        $lang = rtrim($name, "_data");
                        $item = $value[$lang . "_data"];

                        $langData = new LangSaveSystem($lang, $key, $item);
                        $langData->save();
                    }
                }

            }
            $this->getLogger()->info("Синхронизация языковой системы прошла успешно!");
        }catch (Exception $exception){
            $this->getLogger()->critical("Произошла ошибка во время синхронизации базы данных языковой системы!");
            $this->getLogger()->critical("Ошибка: " . $exception->getMessage());
        }

    }
}
