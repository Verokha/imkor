<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            // Menu::make('Get Started')
            //     ->icon('bs.book')
            //     ->title('Navigation')
            //     ->route(config('platform.index')),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            // Menu::make(__('Roles'))
            //     ->icon('bs.shield')
            //     ->route('platform.systems.roles')
            //     ->permission('platform.systems.roles')
            //     ->divider(),
            Menu::make('Каталог автомобилей')
                 ->route('platform.catItem.list'),
            Menu::make('Кейсы')
                 ->route('platform.caseItem.list'),
            Menu::make('Ключевые вопросы')
                 ->route('platform.faqItem.list'),
            Menu::make('Главная страница')
                 ->route('platform.home_settings.list'),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                //->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
