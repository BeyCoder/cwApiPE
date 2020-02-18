<?php


namespace BeyCoder;


use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;
use Exception;

class SyncTask extends PluginTask
{

    /**
     * @var ApiManager $manager
     */
    private $manager;

    /**
     * SyncTask constructor.
     * @param ApiManager $manager
     */
    public function __construct(ApiManager $manager)
    {
        parent::__construct($manager);
        $this->manager = $manager;
    }


    public function onRun($currentTick)
    {
        $this->syncWithDB();
    }

    private function syncWithDB()
    {
        $this->manager->getDatabaseManager()->getDatabaseAuth()->getAllData();
        $this->manager->getDatabaseManager()->getDatabaseLang()->getAllData();
        $this->manager->getDatabaseManager()->getDatabasePrefix()->getAllData();

        $this->manager->getLogger()->alert("Идёт синхронизация с базами данных!");
    }
}