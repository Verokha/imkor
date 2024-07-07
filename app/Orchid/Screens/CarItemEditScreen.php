<?php

namespace App\Orchid\Screens;

use App\Models\CarItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CarItemEditScreen extends Screen
{

    /**
     * @var CarItem
     */
    public $carItem;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(CarItem $carItem): iterable
    {
        return [
            'carItem' => $carItem
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->carItem->exists ? 'Изменить карточку' : 'Создать карточку';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Создать')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->carItem->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->carItem->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->carItem->exists),
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
            Layout::rows([
                Select::make('carItem.type')
                    ->required()
                    ->options([
                        'own'   => 'Для себя',
                        'family' => 'Для семьи',
                        'business' => 'Для бизнеса',
                    ]),
                Input::make('carItem.title')
                    ->title('Марка-модель')
                    ->maxlength(255)
                    ->required(),
                Input::make('carItem.year')
                    ->type('number')
                    ->title('Год выпуска')
                    ->maxlength(255),
                Input::make('carItem.milleage')
                    ->type('number')
                    ->title('Пробег')
                    ->maxlength(510),
                Input::make('carItem.engine')
                    ->title('Двигатель')
                    ->maxlength(510),
                Input::make('carItem.transmission')
                    ->title('Трансмиссия')
                    ->maxlength(510),
                Input::make('carItem.drive_unit')
                    ->title('Привод')
                    ->maxlength(510),
                Input::make('carItem.url')
                    ->title('Ссылка на auto.ru')
                    ->maxlength(8192),
                Upload::make('carItem.attachment')
                    ->required()
                    ->groups('papper_photo')
                    ->maxFiles(1)
                    ->title('Фото обложки'),
                Upload::make('carItem.attachment')
                    ->required()
                    ->groups('list_photo')
                    ->maxFiles(4)
                    ->title('Фото галлерея')
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->carItem->fill($request->get('carItem'))->save();
        $this->carItem->attachment()->syncWithoutDetaching(
            $request->input('carItem.attachment', [])
        );

        Alert::info('Измнения сохранены');
        foreach(CarItem::CATEGORIES as $categoty) {
            $key = CarItem::class.$categoty['type'];
            Cache::forget($key);
        }

        return redirect()->route('platform.catItem.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        $this->carItem->delete();

        Alert::info('Измнения сохранены');
        foreach(CarItem::CATEGORIES as $categoty) {
            $key = CarItem::class.$categoty['type'];
            Cache::forget($key);
        }

        return redirect()->route('platform.catItem.list');
    }
}
