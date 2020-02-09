<?php

namespace BeyCoder;

use pocketmine\Player;

class AuthManager {

    /**
     * @var ApiManager $manager
     */
    private $manager;

    /**
     * @var Player $player
     */
    private $player;

    /**
     * @var bool $logged
     */
    private $logged;

    /**
     * AuthManager constructor.
     * @param ApiManager $manager
     * @param Player $player
     * @param bool $logged
     */
    public function __construct(ApiManager $manager, Player $player, bool $logged = false)
    {
        $this->player = $player;
        
        $this->logged = $logged;

        $this->manager = $manager;
    }


    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * Проверка дирректории
     */
    public static function initializePath()
    {
        if(@dir("authData")) @mkdir("authData");
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
     * @return AuthData
     */
    public function login($password){
        $authData = new AuthData($this->getPlayer(), $password, $this->getPlayer()->getClientId());

        if($authData->auth()){
            $this->setLogged(true);
        }

        return $authData;
        //TODO: подумать над этой строчкой. Она не совсем корректна (Я работал в 2 часа ночи, не ругай меня бл)
    }
}