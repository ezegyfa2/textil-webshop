<?php

namespace App\Enums;

enum Gender: int
{
    case MAN = 0;
    case WOMAN = 1;
    case UNISEX = 2;

    public const translations = [
        self::MAN->value => 'Bărbați',
        self::WOMAN->value => 'Femei',
        self::UNISEX->value => 'Unisex',
    ];
}
