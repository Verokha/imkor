<?php

namespace App\Orchid\Screens;

use App\Models\CaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CaseItemEditScreen extends Screen
{
    /**
     * @var CaseItem
     */
    public $caseItem;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(CaseItem $caseItem): iterable
    {
        return [
            'caseItem' => $caseItem
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->caseItem->exists ? 'Изменить карточку' : 'Создать карточку';
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
                ->canSee(!$this->caseItem->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->caseItem->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->caseItem->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('caseItem.title')
                    ->maxlength(255)
                    ->required()
                    ->title('Заголовок'),

                TextArea::make('caseItem.description')
                    ->title('Описание')
                    ->rows(3)
                    ->required(),
                Upload::make('caseItem.attachment')
                    ->groups('case_photo')
                    ->maxFiles(1)
                    ->title('Фото'),
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->caseItem->fill($request->get('caseItem'))->save();
        $this->caseItem->attachment()->syncWithoutDetaching(
            $request->input('caseItem.attachment', [])
        );

        Alert::info('Измнения сохранены');
        Cache::forget(CaseItem::class);

        return redirect()->route('platform.caseItem.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        $this->caseItem->delete();

        Alert::info('Измнения сохранены');
        Cache::forget(CaseItem::class);

        return redirect()->route('platform.caseItem.list');
    }
}
