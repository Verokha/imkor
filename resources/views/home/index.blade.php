@extends('base')
@section('title')
    @isset($seoItems['title'])
        <title>{{ $seoItems['title'] }}</title>
    @endisset
@endsection
@section('description')
    @isset($seoItems['description'])
        <meta name="description" content="{{ $seoItems['description'] }}">
    @endisset
@endsection
@section('keywords')
    @isset($seoItems['keywords'])
        <meta name="keywords" content="{{ $seoItems['keywords'] }}">
    @endisset
@endsection
@section('content')
    <style>
        .swiper {
            width: 100%;
        }
    </style>
    <div class="wrapper">
        <div class="section main-section">
            <div class="header">
                <a class="item js-start" href="#about">О компании</a>
                <a class="item js-start" href="#faq">Вопросы</a>
                <a class="item js-start" href="#order">Заказ автомобиля</a>
                <img loading="lazy" class="item logo" src="{{ Vite::asset('resources/images/base/imkor.png') }}" />
                <a class="item js-end" href="#cases">Примеры работ</a>
                <a class="item js-end" href="#calculator">Калькулятор</a>
                <a class="item js-end" href="#contacts">Контакты</a>
                <div class="ico"></div>
            </div>
            <ul class="menu__m">
                <li><a class="item" data-href="#about">О компании</a></li>
                <li><a class="item" data-href="#faq">Вопросы</a></li>
                <li><a class="item" data-href="#order">Заказ автомобиля</a></li>
                <li><a class="item" data-href="#cases">Примеры работ</a></li>
                <li><a class="item" data-href="#calculator">Калькулятор</a></li>
                <li><a class="item" data-href="#contacts">Контакты</a></li>
                <div class="social-icon">
                    <a href="@isset($settings['vk_url']){{ $settings['vk_url'] }}@else#@endisset">
                        <img loading="lazy" class="tagline-image"
                            src="{{ Vite::asset('resources/images/base/vk.webp') }}" />
                    </a>
                    <a href="@isset($settings['telegram_url']){{ $settings['telegram_url'] }}@else#@endisset">
                        <img loading="lazy" class="tagline-image"
                            src="{{ Vite::asset('resources/images/base/telegram.webp') }}" />
                    </a>
                </div>
            </ul>
            <div class="main">
                <div class="text-bar">
                    <div class="left-bar">
                        <article class="presenter">
                            <p class="title">Превосходные автомобили на заказ из</p>
                            <p class="sub-title">Южной Кореи</p>
                        </article>
                        <a class="button-catalog" href="#order">
                            Каталог
                            <span>
                                <svg width="68" height="17" viewBox="0 0 68 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 8.22222H67M67 8.22222L53.0563 1M67 8.22222L53.0563 16" stroke="white"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="right-bar">
                        <article class="about">
                            <p>Профессиональная диагностика</p>
                            <p>Полное сопровождение</p>
                            <p>Оформление всех документов</p>
                        </article>
                        <div class="player player__p">
                            <div id="gallery-videos-demo">
                                <a
                                    data-video='{"source": [{"src":"{{ Vite::asset('resources/images/base/compress1.webm') }}?mute=1", "type":"video/webm"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'>
                                    <img loading="lazy" width="300" height="100" class="img-responsive"
                                        src="{{ Vite::asset('resources/images/base/preview.png') }}" />
                                </a>
                            </div>
                            <div class="icon-play">
                                <svg width="108" height="108" viewBox="0 0 108 108" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_b_63_156)">
                                        <circle cx="53.7725" cy="54.1872" r="53.6499" fill="#D9D9D9"
                                            fill-opacity="0.4" />
                                    </g>
                                    <path d="M79.48 54.1873L40.9191 76.4504L40.9191 31.9242L79.48 54.1873Z" fill="white"
                                        fill-opacity="0.6" />
                                    <defs>
                                        <filter id="filter0_b_63_156" x="-4.27744" y="-3.86271" width="116.1"
                                            height="116.1" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feGaussianBlur in="BackgroundImageFix" stdDeviation="2.2" />
                                            <feComposite in2="SourceAlpha" operator="in"
                                                result="effect1_backgroundBlur_63_156" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_63_156"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <img loading="lazy" width="300" height="100" class="img-ajy_1__p" src="{{ Vite::asset('resources/images/base/ajy_1.webp') }}" /> --}}
            {{-- <img loading="lazy" width="300" height="100" class="img-ajy_1__m" src="{{ Vite::asset('resources/images/base/car_item_m.webp') }}" /> --}}
            <svg class="main-arrow-down" width="70" height="70" viewBox="0 0 70 70" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#filter0_b_75_124)">
                    <circle cx="35" cy="35" r="35" fill="white" fill-opacity="0.2" />
                </g>
                <path d="M35.1852 17.5L35.1852 51.25M35.1852 51.25L40 42.5352M35.1852 51.25L30 42.5352" stroke="white"
                    stroke-linecap="round" stroke-linejoin="round" />
                <defs>
                    <filter id="filter0_b_75_124" x="-4" y="-4" width="78" height="78"
                        filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feGaussianBlur in="BackgroundImageFix" stdDeviation="2" />
                        <feComposite in2="SourceAlpha" operator="in" result="effect1_backgroundBlur_75_124" />
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_75_124" result="shape" />
                    </filter>
                </defs>
            </svg>
        </div>
        <div class="section sticky-header">
            <div class="border">
                <p class="select-tagline-mobile __m">Категории авто</p>
                <p class="select-tagline __p">Выберете категорию автомобиля</p>
                <div class="filter-icon __m">
                    <svg width="39" height="35" viewBox="0 0 39 35" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M38 4.5L1 4.5" stroke="black" stroke-linecap="round" />
                        <circle cx="19" cy="4.5" r="3.5" transform="rotate(90 19 4.5)" fill="white"
                            stroke="black" />
                        <path d="M38 17.5L1 17.5" stroke="black" stroke-linecap="round" />
                        <circle cx="35" cy="17.5" r="3.5" transform="rotate(90 35 17.5)" fill="white"
                            stroke="black" />
                        <path d="M38 30.5L1 30.5" stroke="black" stroke-linecap="round" />
                        <circle cx="4" cy="30.5" r="3.5" transform="rotate(90 4 30.5)" fill="white"
                            stroke="black" />
                    </svg>
                </div>
                <div class="category-items">
                    <p class="category-item-sticky" id="all" type="all">Все</p>
                    <p class="category-item-sticky" id="self" type="own">Для себя</p>
                    <p class="category-item-sticky" id="family" type="family">Для семьи</p>
                    <p class="category-item-sticky" id="business" type="business">Для бизнеса</p>
                </div>
            </div>
        </div>
        <div id="about" class="section section-about">
            <div class="chapter">
                <p class="number">001</p>
                <p class="text">О компании</p>
            </div>
            <div class="scroll_arrow_up__m">
                <svg width="47" height="47" viewBox="0 0 47 47" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="23.5" cy="23.5" rx="23.5" ry="23.5"
                        transform="rotate(-90 23.5 23.5)" fill="#0056E8" />
                    <path d="M23.3704 37L23.3704 11M23.3704 11L20 16.493M23.3704 11L27 16.493" stroke="white"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="about-group">
                <div class="block-sub-text__m">
                    <p>Найдем идеальный для Вас автомобиль и привезем его к вашему дому</p>
                </div>
                <div class="player player__m">
                    <div id="gallery-videos-demo__m">
                        <a
                            data-video='{"source": [{"src":"{{ Vite::asset('resources/images/base/compress1.webm') }}?mute=1", "type":"video/webm"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'>
                            <img loading="lazy" width="300" height="100" class="img-responsive"
                                src="{{ Vite::asset('resources/images/base/preview.png') }}" />
                        </a>
                    </div>
                    <div class="icon-play__m">
                        <svg width="108" height="108" viewBox="0 0 108 108" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_b_63_156)">
                                <circle cx="53.7725" cy="54.1872" r="53.6499" fill="#D9D9D9" fill-opacity="0.4" />
                            </g>
                            <path d="M79.48 54.1873L40.9191 76.4504L40.9191 31.9242L79.48 54.1873Z" fill="white"
                                fill-opacity="0.6" />
                            <defs>
                                <filter id="filter0_b_63_156" x="-4.27744" y="-3.86271" width="116.1" height="116.1"
                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                    <feGaussianBlur in="BackgroundImageFix" stdDeviation="2.2" />
                                    <feComposite in2="SourceAlpha" operator="in"
                                        result="effect1_backgroundBlur_63_156" />
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_63_156"
                                        result="shape" />
                                </filter>
                            </defs>
                        </svg>
                    </div>
                </div>
                <div class="block-image"></div>
                <div class="block-text">
                    <span class="bold">IMKOR</span> - это высококвалифицированная команда, аттестованная в сфере
                    внешнеэкономической деятельности с многолетним опытом импорта автомобилей из Южной Кореи.
                    <br />
                    <br />
                    Мы проводим профессиональные проверки автомобилей с диллерским диагностическим оборудованием и оформляем
                    все необходимые документы.
                </div>
            </div>
            <div class="about-cards">
                <div class="card-item">
                    <p class="title">Профессиональная диагностика</p>
                    <p class="text">Мы&#160;<span class="blue">проверяем</span>&#160;все&#160;автомобили перед их
                        выкупом,
                        используя
                        в
                        работе качественное дилерское оборудование, и <span class="blue">предоставляем Вам отчеты</span>
                        о
                        проведенных проверках в фото и видео формате <span class="blue">с рекомендациями по
                            обслуживанию</span> автомобиля.</p>
                </div>
                <div class="card-item">
                    <p class="title">Полное сопровождение</p>
                    <p class="text">Вам не придется заниматься поиском транспортных компаний и брокеров, тк <span
                            class="blue">мы это уже сдали за Вас</span>. Вам останется только принять автомобиль и
                        получить номера.</p>
                </div>
                <div class="card-item">
                    <p class="title">Оформление всех документов</p>
                    <p class="text"><span class="blue">Мы профессионалы</span> не только в подборе автомобилей, <span
                            class="blue">но еще и в сфере внешнеэкономической деятельности.</span> Мы не допустим
                        неправомерных действий и ошибок в оформлении коммерческих, транспортных и таможенных документов, тк
                        разбираемся в валютном и таможенном законодательствах. Все документы по сделке оформляются на
                        будущего собственника автомобиля без указания каких-либо посредников.</p>
                </div>
            </div>
        </div>
        <div id="faq" class="section section-faq">
            <div class="chapter">
                <p class="number">002</p>
                <p class="text">Вопросы</p>
            </div>
            <h2 class="h2 section-title">Ключевые вопросы</h2>
            <div class="faqs">
                @foreach ($faqItems as $faq)
                    <h3 class="accordion">{{ $faq->question }}</h3>
                    <div class="accordion-content">
                        <p>{!! $faq->answer !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="order" class="section section-order">
            <div class="chapter">
                <p class="number">003</p>
                <p class="text">Заказ автомобиля</p>
            </div>
            <h2 class="h2 section-title">Выберите свой автомобиль</h2>
            <div class="products-block">
                <div class="border-order-select">
                    <p class="select-tagline__m">Категории авто</p>
                    <div class="filter-icon__m">
                        <svg width="39" height="35" viewBox="0 0 39 35" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M38 4.5L1 4.5" stroke="black" stroke-linecap="round" />
                            <circle cx="19" cy="4.5" r="3.5" transform="rotate(90 19 4.5)" fill="white"
                                stroke="black" />
                            <path d="M38 17.5L1 17.5" stroke="black" stroke-linecap="round" />
                            <circle cx="35" cy="17.5" r="3.5" transform="rotate(90 35 17.5)" fill="white"
                                stroke="black" />
                            <path d="M38 30.5L1 30.5" stroke="black" stroke-linecap="round" />
                            <circle cx="4" cy="30.5" r="3.5" transform="rotate(90 4 30.5)" fill="white"
                                stroke="black" />
                        </svg>
                    </div>
                    <div class="categories">
                        @foreach ($categories as $category)
                            <div class="category-item @if ($category['type'] === $filterType) current @endif "
                                type="{{ $category['type'] }}">{{ $category['label'] }}</div>
                        @endforeach
                    </div>
                </div>
                <div id="carItems">
                    @include('components.car-items')
                </div>
            </div>
        </div>
        <div class="section section-advertising">
            <p class="tagline">Подберем лучший автомобиль для Вас</p>
            <a class="button-contact">
                <span class="text">Связаться</span>
                <span class="aggregate">
                    <svg width="68" height="17" viewBox="0 0 68 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 8.22222H67M67 8.22222L53.0563 1M67 8.22222L53.0563 16" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </a>
            <img loading="lazy" class="tagline-image"
                src="{{ Vite::asset('resources/images/base/taglineImage.webp') }}" />
        </div>
        <div id="cases" class="section section-cases">
            <div class="chapter">
                <p class="number">004</p>
                <p class="text">Примеры работ</p>
            </div>
            <div class="outer-wrapper">

                <div class="wrapper-case-papper">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($caseItems as $key => $case)
                                <div class="swiper-slide" data-key={{ $key }}>
                                    <img loading="lazy" src="{{ $case['img'] }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="case-pagination">
                        <div class="to-prev">
                            <svg class="arrow" width="25" height="7" viewBox="0 0 25 7" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M24 3.59259L0.999999 3.59259M0.999999 3.59259L5.85915 6M0.999999 3.59259L5.85915 0.999999"
                                    stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        @foreach ($caseItems as $key => $case)
                            <div class="case-about" data-key={{ $key }}>
                                <p class="title">{{ $case['title'] }}</p>
                                <p class="description">{{ $case['description'] }}</p>
                            </div>
                        @endforeach
                        <div class="to-nex">
                            <svg class="arrow" width="25" height="7" viewBox="0 0 25 7" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 3.40741H24M24 3.40741L19.1408 1M24 3.40741L19.1408 6" stroke="white"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="background"></div>
            </div>
        </div>
        <div id="contacts" class="section section-contact">
            <div class="chapter">
                <p class="number">005</p>
                <p class="text">Контакты</p>
            </div>
            <div class="contact-wrapper">
                <p class="tagline tagline__m">Напишите нам</p>
                <div class="social">
                    <p class="tagline tagline__p">Напишите нам</p>
                    <div class="social-icon">
                        <a href="@isset($settings['vk_url']){{ $settings['vk_url'] }}@else#@endisset">
                            <img loading="lazy" class="tagline-image"
                                src="{{ Vite::asset('resources/images/base/vk.webp') }}" />
                        </a>
                        <a href="@isset($settings['telegram_url']){{ $settings['telegram_url'] }}@else#@endisset">
                            <img loading="lazy" class="tagline-image"
                                src="{{ Vite::asset('resources/images/base/telegram.webp') }}" />
                        </a>
                    </div>
                    <div class="contact-phone">
                        @isset($settings['phone_number'])
                            <a
                                href="tel:+{{ preg_replace('/\D/', '', $settings['phone_number']) }}">{{ $settings['phone_number'] }}</a>
                        @endisset
                    </div>
                    <div class="contact-address">
                        @isset($settings['address'])
                            <p>{{ $settings['address'] }}</p>
                        @endisset
                    </div>
                </div>
                <div class="form">
                    <form id="contact-form" action="#" method="post">
                        <div id="loader-wrapper" class="">
                            <div class=""></div>
                        </div>
                        <input autocomplete="on" placeholder="Ваше имя" type="text" name="name" id="name">
                        <input type="tel" autocomplete="on" placeholder="Ваш номер телефона*" name="phone"
                            id="phone">
                        <span id="phoneError" class="error">Данное поле обязательно для заполнения</span>
                        <textarea name="message" id="message" placeholder="Комментарий" rows="4"></textarea>
                        <p class="g_policy">Нажимая на кнопку “Отправить” вы соглашаетесь с <span id="policy">политикой
                                конфиденциальности</span> и обработкой персональных данных</p>
                        <button type="submit" class="">
                            <span class="text">Отправить</span>
                            <span class="aggregate">
                                <svg width="68" height="17" viewBox="0 0 68 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 8.22222H67M67 8.22222L53.0563 1M67 8.22222L53.0563 16" stroke="white"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="section-map">
            <iframe src="https://yandex.ru/map-widget/v1/?z=12&ol=biz&oid=125083811843&scroll=false"
                frameborder="0"></iframe>
        </div>
        <footer>
            <div class="footer-left">
                <img loading="lazy" class="logo" src="{{ Vite::asset('resources/images/base/imkor.png') }}" />
                <p>© 2024 г</p>
            </div>
            <div class="footer-right">
                <div class="social-icon">
                    <a href="@isset($settings['vk_url']){{ $settings['vk_url'] }}@else#@endisset">
                        <img loading="lazy" class="tagline-image"
                            src="{{ Vite::asset('resources/images/base/vk.webp') }}" />
                    </a>
                    <a href="@isset($settings['telegram_url']){{ $settings['telegram_url'] }}@else#@endisset">
                        <img loading="lazy" class="tagline-image"
                            src="{{ Vite::asset('resources/images/base/telegram.webp') }}" />
                    </a>
                </div>
                <div class="contact-phone">
                    @isset($settings['phone_number'])
                        <a
                            href="tel:+{{ preg_replace('/\D/', '', $settings['phone_number']) }}">{{ $settings['phone_number'] }}</a>
                    @endisset
                </div>
                <div class="contact-address">
                    @isset($settings['address'])
                        <p>{{ $settings['address'] }}</p>
                    @endisset
                </div>
            </div>
        </footer>
    </div>
@endsection
@section('script')
    @vite(['resources/js/home/accordion.js', 'resources/js/home/car-item.js', 'resources/js/home/index.js', 'resources/js/home/swipper.js'])
@endsection
