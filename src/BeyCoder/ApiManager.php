<?php

namespace BeyCoder;

use _64FF00\PurePerms\PurePerms;
use BeyCoder\Auth\AuthSaveSystem;
use BeyCoder\Database\DatabaseResult;
use BeyCoder\Economy\commands\MyMoneyCommand;
use BeyCoder\Economy\commands\PayCommand;
use BeyCoder\Economy\commands\SeeMoneyCommand;
use BeyCoder\Economy\EconomyManager;
use BeyCoder\Economy\EconomySaveSystem;
use BeyCoder\Groups\GroupsManager;
use BeyCoder\Groups\GroupsSaveSystem;
use BeyCoder\Lang\LangSaveSystem;
use BeyCoder\Prefix\PlayerPrefixChangeEvent;
use BeyCoder\Prefix\PrefixManager;
use BeyCoder\Prefix\PrefixSaveSystem;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\IPlayer;
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

    /**
     * @var PurePerms $pureperms
     */
    private $pureperms;

    public function onEnable()
    {
        $this->getLogger()->info("CoderWorld API система функционирует!");

        AuthManager::initializePath();
        LangManager::initializePath();
        PrefixManager::initializePath();
        EconomyManager::initializePath();
        GroupsManager::initializePath();

        $this->databaseManager = new DatabaseManager($this, "localhost", "api.php", "API_KEY");

        $this->startSync();

        $this->pureperms = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
    }

    /**
     * @return DatabaseManager
     */
    public function getDatabaseManager() : DatabaseManager
    {
        return $this->databaseManager;
    }

    /**
     * @return PurePerms
     */
    public function getPurePerms(): PurePerms
    {
        return $this->pureperms;
    }

    /**
     * @param string $lang
     * @return LangManager
     */
    public function getLangManager(string $lang)
    {
        return new LangManager($lang);
    }

    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     */
    public function onCommand(CommandSender $sender, Command $command, $label, array $args)
    {
        switch ($command->getName())
        {
            case "balance":
            case "bal":
            case "mymoney":
                $cmd = new MyMoneyCommand($this, $sender, $command, $label, $args);
                $cmd->execute();
                break;

            case "pay":
                $cmd = new PayCommand($this, $sender, $command, $label, $args);
                $cmd->execute();
                break;

            case "seemoney":
                $cmd = new SeeMoneyCommand($this, $sender, $command, $label, $args);
                $cmd->execute();
                break;
        }
    }

    /**
     * @param IPlayer $player
     * @return PrefixManager
     */
    public function getPrefixManager(IPlayer $player)
    {
        return new PrefixManager($this, $player);
    }

    /**
     * @param IPlayer $player
     * @return EconomyManager
     */
    public function getEconomyManager(IPlayer $player)
    {
        return new EconomyManager($this, $player);
    }

    /**
     * @param IPlayer $player
     * @return GroupsManager
     */
    public function getGroupsManager(IPlayer $player)
    {
        return new GroupsManager($this, $player);
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
                    $player = new PlayerData($name);
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

    public function saveAllEconomyData($result)
    {
        try {
            $data = new DatabaseResult($result);

            foreach ($data->getData()["users"] as $new){
                foreach ($new as $name => $user) {
                    $player = new PlayerData($name);
                    $authData = new EconomySaveSystem($player, (int)$user["money"], (int)$user["rub"]);

                    $authData->save();
                }
            }

            $this->getLogger()->info("Синхронизация системы экономики прошла успешно!");

        }catch (Exception $exception){
            $this->getLogger()->critical("Произошла ошибка во время синхронизации базы данных экономики!");
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

    public function saveAllGroupsData($result)
    {
        try {
            $data = new DatabaseResult($result);

            foreach ($data->getData()["users"] as $new){
                foreach ($new as $name => $user) {
                    $player = new PlayerData($name);

                    foreach ($this->getServer()->getOnlinePlayers() as $onlinePlayer)
                    {
                        if($this->getGroupsManager($onlinePlayer)->getGroupName() != $user["groupName"] && strtolower($onlinePlayer->getName()) == $name){
                            $this->getGroupsManager($onlinePlayer)->setGroup($user["groupName"]);
                        }
                    }

                    $authData = new GroupsSaveSystem($player, $user["groupName"]);
                    $authData->save();
                }
            }

           $this->getLogger()->info("Синхронизация системы привилегий прошла успешно!");
        }catch (Exception $exception){
            $this->getLogger()->critical("Произошла ошибка во время синхронизации базы данных системы привилегий!");
            $this->getLogger()->critical("Ошибка: " . $exception->getMessage());
        }
    }

    public function saveAllPrefixData($result)
    {
        try {
            $data = new DatabaseResult($result);

            foreach ($data->getData()["users"] as $new){
                foreach ($new as $name => $user) {
                    $player = new PlayerData($name);

                    foreach ($this->getServer()->getOnlinePlayers() as $onlinePlayer)
                    {
                        if($this->getPrefixManager($onlinePlayer)->getPrefix() != $user["prefix"] && strtolower($onlinePlayer->getName()) == $name){
                            $this->getServer()->getPluginManager()->callEvent(new PlayerPrefixChangeEvent($onlinePlayer, $user["prefix"]));
                        }
                    }

                    $authData = new PrefixSaveSystem($player, $user["prefix"]);
                    $authData->save();
                }
            }

            $this->getLogger()->info("Синхронизация системы префиксов прошла успешно!");
        }catch (Exception $exception){
            $this->getLogger()->critical("Произошла ошибка во время синхронизации базы данных системы префиксов!");
            $this->getLogger()->critical("Ошибка: " . $exception->getMessage());
        }
    }
}
