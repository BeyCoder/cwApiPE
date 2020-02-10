<?php

namespace BeyCoder;

class LangManager
{
    /**
     * Проверка дирректории
     */
    public static function initializePath(){
        if(@dir("langData")) @mkdir("langData");
    }
}