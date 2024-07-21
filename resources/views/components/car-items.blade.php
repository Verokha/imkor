<div class="products">
    @foreach ($carItems as $carItem)
        <div class="card" type="{{ $carItem->type }}" data-id="{{ $carItem->id }}">
            <img loading="lazy" src="{{ $carItem->imgSrc }}" />
            <p class="car-title">{{ $carItem->title }}</p>
            <p class="car-year">{{ $carItem->year }}</p>
            <a class="button-more" data-id="{{ $carItem->id }}">
                <span class="text">Подробнее</span>
                <span class="aggregate">
                    <svg width="68" height="17" viewBox="0 0 68 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 8.22222H67M67 8.22222L53.0563 1M67 8.22222L53.0563 16" stroke="white"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </a>
        </div>
    @endforeach
</div>
@if($carItems instanceof \Illuminate\Pagination\LengthAwarePaginator )
    <div class="pagination">{{ $carItems->onEachSide(1)->links() }}</div>
@endif

