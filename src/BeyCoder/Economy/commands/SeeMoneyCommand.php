<?php


namespace BeyCoder\Economy\commands;

use BeyCoder\ApiManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class SeeMoneyCommand
{
    /**
     * @var CommandSender $commandSender
     */
    private $commandSender;

    /**
     * @var Command $command
     */
    private $command;

    /**
     * @var $label
     */
    private $label;

    /**
     * @var array $args
     */
    private $args;

    /**
     * @var ApiManager
     */
    private $manager;

    /**
     * MyMoneyCommand constructor.
     * @param ApiManager $manager
     * @param CommandSender $commandSender
     * @param Command $command
     * @param $label
     * @param array $args
     */
    public function __construct(ApiManager $manager, CommandSender $commandSender, Command $command, $label, array $args)
    {
        $this->manager = $manager;
        $this->commandSender = $commandSender;
        $this->command = $command;
        $this->label = $label;
        $this->args = $args;
    }

    /**
     * @return CommandSender
     */
    public function getSender(): CommandSender
    {
        return $this->commandSender;
    }

    public function execute()
    {
        if(isset($this->args[0])){
            $player = $this->manager->getServer()->getPlayer($this->args[0]);
            if($player != null){
                $eco = $this->manager->getEconomyManager($player);
                $money = $eco->getMoney();
                $rub = $eco->getRub();
                $this->getSender()->sendMessage(" §c>< §fБаланс игрока §b§l§o" . $player->getName() . "§c: §b§l" . $money . " §eКодкоинсов§r§c, §b§l" . $rub . " §aРуб.§r");
            }else{
                $this->getSender()->sendMessage(" §c>< §fИгрок §a§o" . $this->args[0] . "§r §cне найден!");
            }
        }else{
            $this->getSender()->sendMessage("§c >< §fВы §cне ввели §fигрока§c,§f у которого §aхотите §fпосмотреть баланс§c!");
        }
    }
}