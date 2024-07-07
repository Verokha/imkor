<?php

namespace App\Orchid\Screens\Faqitem;

use App\Models\FaqItem;
use App\Orchid\Layouts\FaqItem\FaqItemListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class FaqItemListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'faqItem' => FaqItem::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Ключевые вопросы';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Добавить')
                ->icon('pencil')
                ->route('platform.faqItem.edit')
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
            FaqItemListLayout::class
        ];
    }
}
