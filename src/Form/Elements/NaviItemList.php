<?php

namespace App\Form\Elements;


class NaviItemList
{

    private static $list = [];

    /**
     * @param array $list = ['name'=>'href',...]
     * @return NaviItem[]
     */
    public static function setList(array $list): array
    {
        foreach ($list as $name => $herf){
            self::$list[] = new NaviItem($name,$herf);
        }

        return self::$list;
    }


}