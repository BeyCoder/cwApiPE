<?php

namespace BeyCoder;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use Exception;

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
        try {
            $data = $this->apiManager->getDatabaseManager()->getDatabaseAuth()->getAllUserData();

            foreach ($data["users"] as $name => $user){
                $player = $this->apiManager->getServer()->getOfflinePlayer($data);
                $authData = new AuthSaveSystem($player, $user["password"], $user["cid"]);

                $authData->save();
            }

        }catch (Exception $exception){
            $this->apiManager->getLogger()->critical("Произошла ошибка во время синхронизации базы данных авторизации!");
            $this->apiManager->getLogger()->critical("Ошибка: " . $exception->getMessage());
        }
    }

    public function onCompletion(Server $server)
    {
        parent::onCompletion($server);
    }
}