<?php

namespace App\Enums;

enum Location: string {
    case Home = 'home';
    case Away = 'away';
    case Total = 'total';
}