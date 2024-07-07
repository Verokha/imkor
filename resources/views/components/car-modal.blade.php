@vite(['resources/scss/modal.scss'])
<script></script>

<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <div class="modal-close " data-micromodal-close>
                <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg"
                    data-micromodal-close>
                    <path d="M2 2L27 27M27 2L2 27" stroke="#0056E8" stroke-width="3" stroke-linecap="round"
                        data-micromodal-close />
                </svg>
            </div>
            <div class="modal_data">
                <div class="car_photo">
                    @isset($car['images'][0])
                        <div class="big-photo" id="lightgallery">
                            @foreach ($car['images'] as $key => $image)
                                <a href="{{ $image }}">
                                    <img loading="lazy" src="{{ $image }}" data-key="{{ $key }}"
                                        class="@if ($key === 0) active @endif" />
                                </a>
                            @endforeach
                        </div>
                        <div class="small-photo">
                            @foreach ($car['images'] as $key => $image)
                                <img loading="lazy" src="{{ $image }}" data-key="{{ $key }}" />
                            @endforeach
                        </div>
                    @endisset
                </div>
                <div class="car_info">
                    <p class="title">{{ $car['title'] }}</p>
                    @if ($car['year'])
                        <div class="item">
                            <p class="label-item">Год выпуска</p>
                            <p class="value-item">{{ $car['year'] }}</p>
                        </div>
                    @endif
                    @if ($car['milleage'])
                        <div class="item">
                            <p class="label-item">Пробег</p>
                            <p class="value-item">{{ $car['milleage'] }}</p>
                        </div>
                    @endif
                    @if ($car['engine'])
                        <div class="item">
                            <p class="label-item">Двигатель</p>
                            <p class="value-item">{{ $car['engine'] }}</p>
                        </div>
                    @endif
                    @if ($car['transmission'])
                        <div class="item">
                            <p class="label-item">Трансмиссия</p>
                            <p class="value-item">{{ $car['transmission'] }}</p>
                        </div>
                    @endif
                    @if ($car['drive_unit'])
                        <div class="item">
                            <p class="label-item">Привод</p>
                            <p class="value-item">{{ $car['drive_unit'] }}</p>
                        </div>
                    @endif
                    <div class="contacts">
                        @if ($car['url'])
                            <a class="tagline" href="{{ $car['url'] }}" target="_blank">Узнать <span
                                    class="blue">подробнее</span>
                                об
                                этом автомобиле</a>
                        @endif
                        <a class="button-contact to_contact">
                            <span class="text">Связаться</span>
                            <span class="aggregate">
                                <svg width="68" height="17" viewBox="0 0 68 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 8.22222H67M67 8.22222L53.0563 1M67 8.22222L53.0563 16" stroke="white"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
