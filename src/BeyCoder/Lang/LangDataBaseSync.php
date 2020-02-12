<?php

namespace BeyCoder\Lang;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use Exception;
use BeyCoder\ApiManager;

class LangDataBaseSync extends AsyncTask {
    /**
     * @var ApiManager $apiManager
     */
    private $apiManager;

    public function __construct(ApiManager $apiManager)
    {
        $this->apiManager = $apiManager;
    }

    public function onRun()
    {
        try {
            $data = $this->apiManager->getDatabaseManager()->getDatabaseLang()->getAllData();

            foreach ($data["lang"] as $name => $value){
                foreach ($value as $lang => $item){
                    //$name это ключ
                    //$lang это язык
                    //$item это значение

                    $langData = new LangSaveSystem($lang, $name, $item);
                    $langData->save();
                }
            }

        }catch (Exception $exception){
            $this->apiManager->getLogger()->critical("Произошла ошибка во время синхронизации базы данных языковой системы!");
            $this->apiManager->getLogger()->critical("Ошибка: " . $exception->getMessage());
        }
    }

    public function onCompletion(Server $server)
    {
        parent::onCompletion($server);
    }
}