<?php

namespace App\Orchid\Screens\FaqItem;

use App\Models\FaqItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class FaqItemEditScreen extends Screen
{
    /**
     * @var FaqItem
     */
    public $faqItem;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(FaqItem $faqItem): iterable
    {
        $faqItem->answer = str_replace("<br/>", "\r\n", $faqItem->answer);
        return [
            'faqItem' => $faqItem
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->faqItem->exists ? 'Изменить карточку' : 'Создать карточку';
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
                ->canSee(!$this->faqItem->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->faqItem->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->faqItem->exists),
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
                Input::make('faqItem.question')
                    ->title('Вопрос')
                    ->required()
                    ->maxlength(510),
                TextArea::make('faqItem.answer')
                    ->rows(10)
                    ->title('Ответ')
                    ->required(),
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $faqItemData = $request->get('faqItem');
        $faqItemData['answer'] = str_replace("\r\n", "<br/>", $faqItemData['answer']);
        $this->faqItem->fill($faqItemData)->save();
        Alert::info('Измнения сохранены');
        Cache::forget(FaqItem::class);

        return redirect()->route('platform.faqItem.list');
    }

    public function remove()
    {
        $this->faqItem->delete();
        Alert::info('Измнения сохранены');
        Cache::forget(FaqItem::class);

        return redirect()->route('platform.faqItem.list');
    }
}
