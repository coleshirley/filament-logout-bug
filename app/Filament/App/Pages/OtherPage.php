<?php

namespace App\Filament\App\Pages;

use Filament\Pages\Page;

class OtherPage extends Page
{
    protected static ?int $navigationSort = -10;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.app.pages.other-page';
}
