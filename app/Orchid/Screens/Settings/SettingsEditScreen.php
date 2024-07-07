<?php

namespace App\Orchid\Screens\Settings;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class SettingsEditScreen extends Screen
{
    /**
     * @var Settings
     */
    public $settings;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $settings = Settings::all();
        $return = [];
        foreach ($settings as $item) {
            $return[$item->tech_name] = $item->data;
        }
        return $return;
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Настройка главной страницы';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::tabs([
                'Настройки страницы' => [
                    Layout::rows([
                        Input::make('home_settings.address')
                            ->title('Адрес'),
                        Input::make('home_settings.phone_number')
                            ->mask('+7-999-999-9999')
                            ->title('Номер телефона'),
                        Input::make('home_settings.vk_url')
                            ->title('Ссылка на VK'),
                        Input::make('home_settings.telegram_url')
                            ->title('Ссылка на Telegram'),
                        Input::make('home_settings.email_notify')
                            ->type('email')
                            ->title('Почта для уведомлений'),
                    ])
                ],
                'SEO' => [
                    Layout::rows([
                        Input::make('seo.title')
                            ->title('Title'),
                        TextArea::make('seo.description')
                            ->title('Description')
                            ->rows(5),
                        TextArea::make('seo.keywords')
                            ->title('Keywords')
                            ->rows(5),
                        TextArea::make('seo.headers_code')
                            ->title('HTML код для вставки внутрь HEAD')
                            ->rows(5),
                        TextArea::make('seo.footer_code')
                            ->title('HTML код для вставки внутрь FOOTER')
                            ->rows(5),
                    ])
                ],
                'Политика конфиденциальности' => [
                    Layout::rows([
                        Quill::make('advantages.policy')
                            ->toolbar([])
                    ])
                ]
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $requestData = $request->all();
        foreach(Settings::CURRENT_SETTINGS as $item) {
            if (isset($requestData[$item])) {
                Settings::where('tech_name', $item)->update(['data' => $requestData[$item]]);
            }
            $key = Settings::class.'_'.$item.'_';
            Cache::forget($key);
        }
        Alert::info('Измнения сохранены');

        return redirect()->route('platform.home_settings.list');
    }

}
