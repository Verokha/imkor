<?php

namespace App\Http\Services;

use App\Models\CarItem;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarService
{
    public function listItems(int|string $page, int $perPage, string $path, string|array|null $query = null, ?string $filterType = null)
    {
        $carItems = $this->carItems($filterType);
        if ($page === 'all') {
            return $carItems;
        }

        $offset = $page * $perPage - $perPage;
        return new LengthAwarePaginator(
            array_slice($carItems, $offset, $perPage, true),
            count($carItems), 
            $perPage, 
            $page,
            ['path' => $path, 'query' => $query]
        );
    }

    protected function carItems(?string $filterType = null): array
    {
        $key = CarItem::class;
        if ($filterType !== 'all' && $filterType !== null) {
            $key = $key.$filterType;
        }
        return Cache::rememberForever($key, function () use($filterType)  {
            $carItems = DB::table('car_items', 'ci')
                ->selectRaw("
                    CONCAT(ci.`year`, ' год') as year,
                    CONCAT(attch.`path`,attch.name,'.',attch.extension) as img_src"
                )
                ->addSelect([
                    'ci.id',
                    'ci.title',
                    'ci.type'
                ])
                ->join('attachmentable as a', function(JoinClause $query) {
                    $query->on('a.attachmentable_id', '=', 'ci.id')
                        ->where('a.attachmentable_type', '=', CarItem::class);
                })
                ->join('attachments as attch', 'a.attachment_id', '=', 'attch.id')
                ->where('attch.group', '=', 'papper_photo');
            return $this->filtered($carItems, $filterType)
                ->get()
                ->filter(fn ($item) => $this->makeUrl($item))
                ->toArray();
        });
    }

    protected function makeUrl($item)
    {
        /** @var Filesystem|Cloud $disk */
        $disk = Storage::disk('public');
        $imgSrc = $item->img_src;
        $url = $imgSrc !== null && $disk->exists($imgSrc)
            ? $disk->url($imgSrc)
            : null;
        $item->imgSrc = $url;
        unset($item->img_src);
        return $item;
    }

    protected function filtered(\Illuminate\Database\Query\Builder $carItems, ?string $type = null)
    {
        if ($type === 'all' || $type === null) {
            return $carItems;
        }
        return $carItems->where('type', '=', $type);
    }
}
