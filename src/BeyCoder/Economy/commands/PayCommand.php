<?php


namespace BeyCoder\Economy\commands;

use BeyCoder\ApiManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class PayCommand
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
        $eco = $this->manager->getEconomyManager($this->getSender()->getPlayer());

        if (isset($this->args[0])) {
            $player = $this->manager->getServer()->getPlayer($this->args[0]);
            if ($player != null) {
                if ($player != $this->getSender()) {
                    if (isset($this->args[1])) {
                        if (is_numeric($this->args[1])) {
                            if ($this->args[1] >= 0) {
                                if ($this->args[1] <= $eco->getMoney()) {
                                    $eco->reduceMoney($this->args[1]);
                                    $this->manager->getEconomyManager($player)->addMoney($this->args[1]);
                                    $this->getSender()->sendMessage(" §c>< §fВы§a выплатили§f игроку §a§o" . $player->getName() . "§r§c: §e§l" . $this->args[1] . " §bКодкоинсов§r§c!");
                                    $player->sendMessage(" §c>< §fИгрок §a§o" . $this->getSender()->getName() . " §r§fвыплатил §aВам§c: §e§l" . $this->args[1] . " §bКодкоинсов§c!");
                                } else {
                                    $this->getSender()->sendMessage(" §c>< §fУ§a Вас §c§lнету§r §fстолько денег§c!");
                                }

                            } else {
                                $this->getSender()->sendMessage(" §c>< §fЧисло §aдолжно §fбыть §aположительным§c!");
                            }
                        } else {
                            $this->getSender()->sendMessage(" §c>< §fСумма §aдолжна §fиметь §cчисловой§f формат§c!");
                        }
                    } else {
                        $this->getSender()->sendMessage(" §c>< §fВы §cне ввели §fсумму§c, §fкоторую хотите §aперевести§c!");
                    }

                } else {
                    $this->getSender()->sendMessage(" §c>< §cНельзя §fвыплачивать деньги §aсебе§c!");
                }
            } else {
                $this->getSender()->sendMessage(" §c>< §fИгрок §a§o" . $this->args[0] . "§r §cне найден!");
            }

        } else {
            $this->getSender()->sendMessage(" §c>< §fВы §cне ввели §fигрока§c, §fкоторый §aполучит §fваши деньги§c!");
        }
    }
}