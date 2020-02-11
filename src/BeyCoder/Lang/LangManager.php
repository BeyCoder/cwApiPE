<?php

namespace BeyCoder;

class LangManager
{
    /**
     * Проверка дирректории
     */
    public static function initializePath()
    {
        if(@dir("langData")) @mkdir("langData");
    }

    /**
     * @param string $key
     *
     * @return string|bool
     */
    public static function get(string $key)
    {
        //TODO: Lang database sync
        return false;
    }
}