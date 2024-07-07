<?php

namespace App\Orchid\Layouts\FaqItem;

use App\Models\FaqItem;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FaqItemListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'faqItem';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Title')
                ->render(function (FaqItem $faqItem) {
                    return Link::make($faqItem->question)
                        ->route('platform.faqItem.edit', $faqItem->id);
                }),
        ];
    }
}
