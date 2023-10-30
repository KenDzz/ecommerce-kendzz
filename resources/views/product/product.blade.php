@extends('layouts.default')

@section('title', $product->name)

@section('content')
    <div class="container mx-auto">
        <div class="product-featured">
            <div class="showcase-wrapper has-scrollbar">
                <div class="showcase-container">

                    <div class="showcase">

                        <div class="showcase-banner">
                            {{-- <img src="{{ url('images/products/shampoo.jpg') }}" alt="shampoo, conditioner & facewash packs"
                            class="showcase-img"> --}}
                            <section id="main-carousel" class="splide" aria-label="My Awesome Gallery">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach ($product->productMedia as $image)
                                            <li class="splide__slide">
                                                <img src="{{ url($image->url) }}" alt="">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </section>
                            <ul id="thumbnails" class="thumbnails">
                                @foreach ($product->productMedia as $image)
                                    <li class="thumbnail">
                                        <img src="{{ url($image->url) }}" alt="">
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="showcase-content">
                            <div class="flex h-auto">
                                <div class="flex-none inline-block text-sm align-bottom">
                                    <div class="showcase-rating">
                                        {!! $product->getStarRating() !!}
                                    </div>
                                </div>
                                <div
                                    class="inline-block h-auto w-0.5 self-stretch bg-neutral-100 opacity-100 dark:opacity-50 ml-2">
                                </div>
                                <div class="flex-none ml-2">
                                    <p class="inline-block text-sm align-top">0 Đánh giá</p>
                                </div>
                                <div
                                    class="inline-block h-auto w-0.5 self-stretch bg-neutral-100 opacity-100 dark:opacity-50 ml-2">
                                </div>
                                <div class="flex-none ml-2">
                                    <p class="inline-block text-sm align-top">{{ $product->purchases }} Đã bán</p>
                                </div>
                            </div>

                            <a href="#">
                                <h3 class="!text-xl showcase-title">{{ $product->name }}</h3>
                            </a>

                            <div class="price-box">
                                @if ($product->discount > 0)
                                    <p class="price">
                                        {{ app('App\Http\Controllers\HomeController')->formatCurrency($product->price, $product->discount) }}
                                    </p>
                                    <del>{{ app('App\Http\Controllers\HomeController')->formatCurrency($product->price, 0) }}</del>
                                @else
                                    <p class="price">
                                        {{ app('App\Http\Controllers\HomeController')->formatCurrency($product->price, $product->discount) }}
                                    </p>
                                @endif
                                <span
                                    class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 align-middle">Giảm
                                    {{ $product->discount }}%</span>

                            </div>

                            <div class="flex mt-3">
                                <div class="flex-initial w-32 mt-auto mb-auto">
                                    <p class="inline-block text-sm align-middle text-zinc-400">Số lượng</p>
                                </div>
                                <div class="flex-none ml-2">
                                    <div class="w-32 h-10 custom-number-input">
                                        <div class="relative flex flex-row w-full h-10 mt-1 bg-transparent rounded-lg">
                                            <button data-action="decrement"
                                                class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-400">
                                                <span class="m-auto text-2xl font-thin">−</span>
                                            </button>
                                            <input type="number"
                                                class="flex items-center w-full font-semibold text-center text-gray-700 bg-gray-300 outline-none focus:outline-none text-md hover:text-black focus:text-black md:text-basecursor-default"
                                                name="custom-input-number" value="0"></input>
                                            <button data-action="increment"
                                                class="w-20 h-full text-gray-600 bg-gray-300 rounded-r cursor-pointer hover:text-gray-700 hover:bg-gray-400">
                                                <span class="m-auto text-2xl font-thin">+</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex choose-category">
                                <div class="flex-initial w-32 mt-auto mb-auto">
                                    <p class="inline-block text-sm align-middle text-zinc-400">Phân loại</p>
                                </div>
                                <div class="flex-none ml-2">
                                    <!-- Sizes -->
                                    <div class="mt-10">
                                        <fieldset class="mt-4">
                                            <legend class="sr-only">Choose a size</legend>
                                            <div class="grid grid-cols-4 gap-4">

                                                @foreach ($productTypes as $productType)
                                                    @if ($productType->quantity > 0)
                                                        <label
                                                            class="relative flex items-center justify-center px-4 py-3 text-sm font-medium text-gray-900 uppercase transition duration-300 ease-in-out bg-white border rounded-md shadow-sm cursor-pointer group hover:bg-gray-50 focus:outline-none sm:flex-1 hover:scale-105 active:bg-indigo-500 active:text-white">
                                                            <img src="/{{ $productType->img_url }}"
                                                                alt="{{ $productType->name }}"
                                                                class="object-cover w-8 h-8 mr-2" />
                                                            <input type="radio" id="category-choice"
                                                                name="category-choice" value="{{ $productType->id }}"
                                                                class="sr-only" aria-labelledby="category-choice-1-label">
                                                            <span
                                                                id="category-choice-1-label">{{ $productType->name }}</span>

                                                            <span class="absolute rounded-md pointer-events-none -inset-px"
                                                                aria-hidden="true"></span>
                                                        </label>
                                                    @else
                                                        <label
                                                            class="relative flex items-center justify-center px-4 py-3 text-sm font-medium text-gray-200 uppercase transition duration-300 ease-in-out border rounded-md cursor-not-allowed active:bg-indigo-500 active:text-white hover:scale-105 group hover:bg-gray-50 focus:outline-none sm:flex-1 bg-gray-50">
                                                            <img src="/{{ $productType->img_url }}"
                                                                alt="{{ $productType->name }}"
                                                                class="object-cover w-8 h-8 mr-2" />

                                                            <input type="radio" id="category-choice"
                                                                name="category-choice" value="{{ $productType->id }}"
                                                                disabled class="sr-only"
                                                                aria-labelledby="category-choice-7-label">
                                                            <span
                                                                id="category-choice-7-label">{{ $productType->name }}</span>
                                                            <span aria-hidden="true"
                                                                class="absolute border-2 border-gray-200 rounded-md pointer-events-none -inset-px">
                                                                <svg class="absolute inset-0 w-full h-full text-gray-200 stroke-2"
                                                                    viewBox="0 0 100 100" preserveAspectRatio="none"
                                                                    stroke="currentColor">
                                                                    <line x1="0" y1="100" x2="100"
                                                                        y2="0" vector-effect="non-scaling-stroke" />
                                                                </svg>
                                                            </span>
                                                        </label>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </fieldset>
                                    </div>

                                </div>
                            </div>

                            <div class="flex choose-size">
                            </div>



                            <div class="flex mt-5">
                                <div class="flex-none">
                                    <button class="add-cart-btn">Mua</button>
                                </div>
                                <div class="flex-none ml-2">
                                    <button class="add-cart-btn">Thêm vào giỏ hàng</button>
                                </div>
                            </div>

                            {{-- <div class="showcase-status">
                                <div class="wrapper">
                                    <p>
                                        already sold: <b>20</b>
                                    </p>

                                    <p>
                                        available: <b>40</b>
                                    </p>
                                </div>

                                <div class="showcase-status-bar"></div>
                            </div>

                            <div class="countdown-box">

                                <p class="countdown-desc">
                                    Hurry Up! Offer ends in:
                                </p>

                                <div class="countdown">

                                    <div class="countdown-content">

                                        <p class="display-number">360</p>

                                        <p class="display-text">Days</p>

                                    </div>

                                    <div class="countdown-content">
                                        <p class="display-number">24</p>
                                        <p class="display-text">Hours</p>
                                    </div>

                                    <div class="countdown-content">
                                        <p class="display-number">59</p>
                                        <p class="display-text">Min</p>
                                    </div>

                                    <div class="countdown-content">
                                        <p class="display-number">00</p>
                                        <p class="display-text">Sec</p>
                                    </div>

                                </div>

                            </div> --}}

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="container mx-auto">
        <div class="product-featured">
            <div class="grid grid-cols-1 gap-4 mx-auto md:grid-cols-1 lg:grid-cols-3 ">
                <div class="col-span-1 bg-white showcase-wrapper has-scrollbar">
                    <div class="showcase-container">
                        <div class="flex h-auto">
                            <div class="flex-none inline-block text-sm align-bottom">
                                <img class="w-20 h-20 rounded-full"
                                    src="https://dummyimage.com/800x700/000000/ffffff&text=Avatar"
                                    alt="image description">
                            </div>
                            <div
                                class="inline-block h-auto w-0.5 self-stretch bg-neutral-100 opacity-100 dark:opacity-50 ml-2">
                            </div>
                            <div class="flex-none ml-2">
                                <div class="grid grid-cols-1 gap-1 mx-auto md:grid-cols-1 lg:grid-cols-1 ">
                                    <div class="col-span-1">
                                        <h1 class="inline-block">Store</h1>
                                        <p class="text-sm text-gray-400">Online 31 phút trước</p>
                                    </div>
                                    <div class="col-span-1">
                                        <a href="/"
                                            class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                                            <span
                                                class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                                Nhắn tin
                                            </span>
                                        </a>
                                        <a href="/"
                                            class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-500 to-pink-500 group-hover:from-purple-500 group-hover:to-pink-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800">
                                            <span
                                                class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                                Xem shop
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 bg-white h-200 showcase-wrapper has-scrollbar">
                    <div class="showcase-container">
                        <div class="flex-none h-full mx-auto">
                            <div class="grid grid-cols-2 gap-6 md:grid-cols-2 lg:grid-cols-6">
                                <div>
                                    <p class="text-gray-400">Đánh Giá</p>
                                </div>
                                <div>
                                    <p class="text-sm text-red-600">14k</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Tham gia</p>
                                </div>
                                <div>
                                    <p class="text-sm text-red-600">14 tháng trước</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Sản phẩm</p>
                                </div>
                                <div>
                                    <p class="text-sm text-red-600">46</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Lượt bán</p>
                                </div>
                                <div>
                                    <p class="text-sm text-red-600">46k</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto">
        <div class="product-featured">
            <div class="showcase-container">
                <h1
                    class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    Thông tin <span
                        class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Sản
                        phẩm</span></h1>
                {!! $product->describes !!}
            </div>
        </div>
    </div>
@endsection
