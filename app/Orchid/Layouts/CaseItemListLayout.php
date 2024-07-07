<?php

namespace App\Orchid\Layouts;

use App\Models\CaseItem;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CaseItemListLayout extends Table
{
    public $target = 'caseItem';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('title', 'Заголовок')
                ->render(function (CaseItem $caseItem) {
                    return Link::make($caseItem->title)
                        ->route('platform.caseItem.edit', $caseItem->id);
                }),

            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
