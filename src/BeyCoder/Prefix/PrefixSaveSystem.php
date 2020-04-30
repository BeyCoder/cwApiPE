<?php


namespace BeyCoder\Prefix;


use BeyCoder\ISaveable;
use pocketmine\IPlayer;
use pocketmine\utils\Config;

class PrefixSaveSystem extends PrefixData implements ISaveable
{

    /**
     * @var string $prefix
     */
    private $prefix;

    /**
     * @var string $suffix
     */
    private $suffix;

    /**
     * @var string $hideLogin
     */
    private $hideLogin;

    /**
     * PrefixSaveSystem constructor.
     * @param IPlayer $player
     * @param string $prefix
     * @param string $suffix
     * @param string $hideLogin
     */
    public function __construct(IPlayer $player, $prefix, $suffix, $hideLogin)
    {
        parent::__construct($player);
        $this->prefix = $prefix;
        $this->suffix = $suffix;
        $this->hideLogin = $hideLogin;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @return string
     */
    public function getSuffix(): string
    {
        return $this->suffix;
    }

    /**
     * @return string
     */
    public function getHideLogin(): string
    {
        return $this->hideLogin;
    }

    public function save()
    {
        $config = new Config($this->getPath(), Config::JSON);

        if($this->prefix != "") {
            $config->set("prefix", $this->getPrefix());
        }

        if($this->suffix != "") {
            $config->set("suffix", $this->getSuffix());
        }

        if($this->hideLogin != "") {
            $config->set("hideLogin", $this->getHideLogin());
        }
        $config->save();
    }
}