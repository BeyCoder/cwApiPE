<?php


namespace BeyCoder\Economy\commands;

use BeyCoder\ApiManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class MyMoneyCommand
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
        $money = $this->manager->getEconomyManager($this->getSender()->getPlayer())->getMoney();
        $rub = $this->manager->getEconomyManager($this->getSender()->getPlayer())->getRub();
        $this->getSender()->sendMessage(" §c>< §fВаш баланс§c: §b§l" . $money . " §eКодкоинсов§r§c, §b§l" . $rub . " §aРуб.§r");
    }
}