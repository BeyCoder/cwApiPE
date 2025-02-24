<?php

namespace BeyCoder\Auth;

use BeyCoder\ApiManager;
use Exception;
use pocketmine\IPlayer;
use pocketmine\Player;

class AuthManager {

    /**
     * @var ApiManager $manager
     */
    private $manager;

    /**
     * @var IPlayer $player
     */
    private $player;

    /**
     * @var bool $logged
     */
    private $logged;

    /**
     * AuthManager constructor.
     * @param ApiManager $manager
     * @param IPlayer $player
     * @param bool $logged
     */
    public function __construct(ApiManager $manager, IPlayer $player, bool $logged = false)
    {
        $this->player = $player;
        
        $this->logged = $logged;

        $this->manager = $manager;
    }


    /**
     * @return IPlayer
     */
    public function getPlayer(): IPlayer
    {
        return $this->player;
    }

    /**
     * Проверка дирректории
     */
    public static function initializePath()
    {
        if(!file_exists("authData")) @mkdir("authData");
    }

    /**
     * @param bool $logged
     */
    public function setLogged(bool $logged)
    {
        $this->logged = $logged;
    }

    /**
     * @return bool
     */
    public function isLogged(): bool
    {
        return $this->logged;
    }

    /**
     * Выход из аккаунта
     */
    public function logout(){
        $this->setLogged(false);
    }

    /**
     * @param $password
     * @return bool
     *
     * @throws Exception
     */
    public function login($password){
        $authData = new AuthData($this->getPlayer(), -1, $password, $this->getPlayer()->getClientId());

        if($authData->exists()) {
            if ($authData->auth()) {
                $this->setLogged(true);
                return true;
            }
        }else{
            throw new Exception("User is not registred", 404);
        }

        return false;
    }
}