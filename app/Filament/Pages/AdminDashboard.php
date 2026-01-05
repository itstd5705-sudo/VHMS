<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AdminDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.admin-dashboard';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Admin Dashboard';
}
