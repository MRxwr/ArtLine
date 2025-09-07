<?php

return [
    'id' => 'superadmin',
    'path' => '/superadmin',
    'login' => \Filament\Pages\Auth\Login::class,
    'registration' => null,
    'passwordReset' => \Filament\Pages\Auth\PasswordReset::class,
    'emailVerification' => null,
    'profile' => null,
    'resources' => [
        //
    ],
    'pages' => [
        //
    ],
    'widgets' => [
        //
    ],
    'middleware' => [
        'web',
        'auth',
        'superadmin',
    ],
    'authMiddleware' => [
        //
    ],
    'tenantMiddleware' => [
        //
    ],
    'authGuard' => 'web',
    'plugins' => [
        //
    ],
    'brandName' => 'ArtLine SuperAdmin',
    'brandLogo' => null,
    'brandLogoHeight' => null,
    'favicon' => null,
    'colors' => [
        'primary' => '#dc2626',
    ],
    'darkMode' => true,
    'maxContentWidth' => 'full',
    'sidebarCollapsibleOnDesktop' => false,
    'sidebarFullyCollapsibleOnDesktop' => false,
    'navigationGroups' => [
        'Store Management',
        'User Management',
        'System',
    ],
    'databaseNotifications' => [
        'enabled' => true,
    ],
    'spa' => false,
    'unsavedChangesAlerts' => true,
    'defaultAvatarProvider' => \Filament\AvatarProviders\UiAvatarsProvider::class,
    'viteTheme' => null,
];
