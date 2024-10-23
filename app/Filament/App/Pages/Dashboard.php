<?php

namespace App\Filament\App\Pages;

use Filament\Pages\Dashboard as PagesDashboard;
use Filament\Pages\Page;

class Dashboard extends PagesDashboard
{

    public static function canAccess(): bool
    {
        return auth()->user()->can('canAccessThing');
    }
}
