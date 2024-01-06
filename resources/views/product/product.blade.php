@extends('layouts.default')

@section('title', $product->name)

@section('content')
    <div class="container mx-auto">
        <div class="product-featured">
            <div class="showcase-wrapper has-scrollbar">
                <div class="showcase-container product-content" productId="{{ $product->id }}">

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
                                @if($discountSale == 0)
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
                                @else
                                    <p class="price">
                                        {{ app('App\Http\Controllers\HomeController')->formatCurrency($product->price, $discountSale) }}
                                    </p>
                                    <del>{{ app('App\Http\Controllers\HomeController')->formatCurrency($product->price, 0) }}</del>
                                @endif
                                <span
                                    class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 align-middle">Giảm
                                    @if ($discountSale > 0)
                                        {{ $discountSale }}
                                    @else
                                        {{ $product->discount }}
                                    @endif
                                    %</span>

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
                                                class="flex items-center w-full font-semibold text-center text-gray-700 bg-gray-300 outline-none custom-input-number-product focus:outline-none text-md hover:text-black focus:text-black md:text-basecursor-default"
                                                value="0"></input>
                                            <button data-action="increment"
                                                class="w-20 h-full text-gray-600 bg-gray-300 rounded-r cursor-pointer hover:text-gray-700 hover:bg-gray-400">
                                                <span class="m-auto text-2xl font-thin">+</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (!$productTypes->isEmpty() && $productTypes->count() > 0)
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
                                                                <img src="{{ url($productType->img_url) }}"
                                                                    alt="{{ $productType->name }}"
                                                                    class="object-cover w-8 h-8 mr-2" />
                                                                <input type="radio" id="category-choice"
                                                                    name="category-choice" value="{{ $productType->id }}"
                                                                    class="sr-only"
                                                                    aria-labelledby="category-choice-1-label">
                                                                <span
                                                                    id="category-choice-1-label">{{ $productType->name }}</span>

                                                                <span
                                                                    class="absolute rounded-md pointer-events-none -inset-px"
                                                                    aria-hidden="true"></span>
                                                            </label>
                                                        @else
                                                            <label
                                                                class="relative flex items-center justify-center px-4 py-3 text-sm font-medium text-gray-200 uppercase transition duration-300 ease-in-out border rounded-md cursor-not-allowed active:bg-indigo-500 active:text-white hover:scale-105 group hover:bg-gray-50 focus:outline-none sm:flex-1 bg-gray-50">
                                                                <img src="{{ url($productType->img_url) }}"
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
                                                                            y2="0"
                                                                            vector-effect="non-scaling-stroke" />
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
                            @endif

                            <div class="flex choose-size">
                            </div>



                            <div class="flex mt-5">
                                <div class="flex-none">
                                    <button class="add-cart-btn btn-buy-product">Mua</button>
                                </div>
                                <div class="flex-none ml-2">
                                    <button class="add-cart-btn btn-add-product-to-cart">Thêm vào giỏ hàng</button>
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
                            </div> --}}
                            @if ($discountSale > 0)
                                <div class="countdown-box">
                                    <p class="countdown-desc">
                                        Nhanh lên! Ưu đãi kết thúc sau:
                                    </p>
                                    <div class="countdown">
                                        <div class="countdown-content">
                                            <p class="display-number display-number-day-{{$product->id}}">360</p>
                                            <p class="display-text">Ngày</p>
                                        </div>
                                        <div class="countdown-content">
                                            <p class="display-number display-number-hour-{{$product->id}}">24</p>
                                            <p class="display-text">Giờ</p>
                                        </div>
                                        <div class="countdown-content">
                                            <p class="display-number display-number-min-{{$product->id}}">59</p>
                                            <p class="display-text">Phút</p>
                                        </div>
                                        <div class="countdown-content">
                                            <p class="display-number display-number-sec-{{$product->id}}">00</p>
                                            <p class="display-text">Giây</p>
                                        </div>

                                    </div>

                                </div>
                            @endif


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
                                        <a href="#" data-seller-id="{{$product->seller_id}}" class="btn-sender-chat relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
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
    @if (!empty($productRecommendations) && $productRecommendations->count())
        <div class="container mx-auto">
            <div class="product-featured">
                <div class="showcase-container">
                    <h1
                        class="mb-4 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-xl dark:text-white">
                        Gợi ý</h1>
                    <div class="product-grid owl-carousel owl-carousel-remember-system">
                        @foreach ($productRecommendations as $product)
                            <div class="showcase item">

                                <div class="showcase-banner">

                                @if (!empty($product->productMedia) && $product->productMedia->count())
                                        @foreach ($product->productMedia as $key => $productMedia)
                                            @if ($key == 0)
                                                <img src="{{ url($productMedia->url) }}" alt="{{ $product->name }}"
                                                    width="300" class="w-44 h-44 product-img default">
                                            @else
                                                <img src="{{ url($productMedia->url) }}" alt="{{ $product->name }}"
                                                    width="300" class="h-44 w-44 product-img hover">
                                            @endif
                                            @if ($key == 1)
                                            @break
                                        @endif
                                    @endforeach
                                @else
                                    <img src="https://dummyimage.com/800x700/ffffff/000000&text=first" width="300"
                                        class="product-img default">
                                    <img src="https://dummyimage.com/800x700/ffffff/000000&text=second"
                                        alt="{{ $product->name }}" width="300" class="product-img hover">
                                @endif

                                @if ($product->discount > 0)
                                    <p class="showcase-badge">{{ $product->discount }}%</p>
                                @endif
                            </div>

                            <div class="showcase-content">

                                <a href="#" class="showcase-category">{{ $product->category->name }}</a>

                                <a
                                    href="{{ route('detail-product', ['slug' => urlencode($product->slug), 'id' => $product->id]) }}">
                                    <h3 class="showcase-title">{{ $product->name }}</h3>
                                </a>

                                <div class="showcase-rating">
                                    {!! $product->getStarRating() !!}
                                </div>

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
                                </div>

                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
<div class="container mx-auto">
    <div class="product-featured">
        <div class="showcase-container describes-product">
            <h1
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Thông tin <span
                    class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Sản
                    phẩm</span></h1>
            {!! $product->describes !!}
        </div>
    </div>
</div>
<div class="container mx-auto">
    <div class="product-featured">
        <div class="showcase-container">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="bg-white">
                <div
                    class="max-w-2xl px-2 py-4 mx-auto sm:py-24 sm:px-6 lg:max-w-7xl lg:py-4 lg:px-3 lg:grid lg:grid-cols-12 lg:gap-x-8">
                    <div class="lg:col-span-4">
                        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Đánh giá sản phẩm</h2>

                        <div class="flex items-center mt-3">
                            <div>
                                <div class="flex items-center showcase-rating">
                                    {!! $product->getStarRating() !!}
                                </div>
                            </div>
                            <p class="ml-2 text-sm text-gray-900">Dựa trên {{ $productReviews->count() }} đánh giá</p>
                        </div>

                        <div class="mt-6">
                            <h3 class="sr-only">Review data</h3>

                            <dl class="space-y-3">
                                <div class="flex items-center text-sm">
                                    <dt class="flex items-center flex-1">
                                        <p class="w-3 font-medium text-gray-900">5<span class="sr-only"> star
                                                reviews</span></p>
                                        <div aria-hidden="true" class="flex items-center flex-1 ml-1">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 w-5 h-5 text-yellow-400"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>

                                            <div class="relative flex-1 ml-3">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>
                                                <div style="width: calc({{ $reviewsWithRating5->count() == 0 ? 0 : $reviewsWithRating5->count() / $productReviews->count() }} * 100%)"
                                                    class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full">
                                                </div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="w-10 ml-3 text-sm text-right text-gray-900 tabular-nums">
                                        {{ $reviewsWithRating5->count() == 0 ? 0 : ($reviewsWithRating5->count() / $productReviews->count()) * 100 }}%
                                    </dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex items-center flex-1">
                                        <p class="w-3 font-medium text-gray-900">4<span class="sr-only"> star
                                                reviews</span></p>
                                        <div aria-hidden="true" class="flex items-center flex-1 ml-1">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 w-5 h-5 text-yellow-400"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>

                                            <div class="relative flex-1 ml-3">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc({{ $reviewsWithRating4->count() == 0 ? 0 : $reviewsWithRating4->count() / $productReviews->count() }} * 100%)"
                                                    class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full">
                                                </div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="w-10 ml-3 text-sm text-right text-gray-900 tabular-nums">
                                        {{ $reviewsWithRating4->count() == 0 ? 0 : ($reviewsWithRating4->count() / $productReviews->count()) * 100 }}%
                                    </dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex items-center flex-1">
                                        <p class="w-3 font-medium text-gray-900">3<span class="sr-only"> star
                                                reviews</span></p>
                                        <div aria-hidden="true" class="flex items-center flex-1 ml-1">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 w-5 h-5 text-yellow-400"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>

                                            <div class="relative flex-1 ml-3">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc({{ $reviewsWithRating3->count() == 0 ? 0 : $reviewsWithRating3->count() / $productReviews->count() }} * 100%)"
                                                    class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full">
                                                </div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="w-10 ml-3 text-sm text-right text-gray-900 tabular-nums">
                                        {{ $reviewsWithRating3->count() == 0 ? 0 : ($reviewsWithRating3->count() / $productReviews->count()) * 100 }}%
                                    </dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex items-center flex-1">
                                        <p class="w-3 font-medium text-gray-900">2<span class="sr-only"> star
                                                reviews</span></p>
                                        <div aria-hidden="true" class="flex items-center flex-1 ml-1">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 w-5 h-5 text-yellow-400"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>

                                            <div class="relative flex-1 ml-3">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc({{ $reviewsWithRating2->count() == 0 ? 0 : $reviewsWithRating2->count() / $productReviews->count() }} * 100%)"
                                                    class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full">
                                                </div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="w-10 ml-3 text-sm text-right text-gray-900 tabular-nums">
                                        {{ $reviewsWithRating2->count() == 0 ? 0 : ($reviewsWithRating2->count() / $productReviews->count()) * 100 }}%
                                    </dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex items-center flex-1">
                                        <p class="w-3 font-medium text-gray-900">1<span class="sr-only"> star
                                                reviews</span></p>
                                        <div aria-hidden="true" class="flex items-center flex-1 ml-1">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 w-5 h-5 text-yellow-400"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>

                                            <div class="relative flex-1 ml-3">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc({{ $reviewsWithRating1->count() == 0 ? 0 : $reviewsWithRating1->count() / $productReviews->count() }} * 100%)"
                                                    class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full">
                                                </div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="w-10 ml-3 text-sm text-right text-gray-900 tabular-nums">
                                        {{ $reviewsWithRating1->count() == 0 ? 0 : ($reviewsWithRating1->count() / $productReviews->count()) * 100 }}%
                                    </dd>
                                </div>
                            </dl>
                        </div>


                    </div>

                    <div class="mt-16 lg:mt-0 lg:col-start-6 lg:col-span-7">
                        <h3 class="sr-only">Đánh giá sản phẩm</h3>

                        <div class="flow-root">
                            <div class="-my-12 divide-y divide-gray-200">
                                @if ($productReviews->count() > 0)
                                    @foreach ($productReviews as $productReview)
                                        <div class="py-12">
                                            <div class="flex items-center">
                                                <img src="{{ url('images/testimonial-1.jpg') }}" alt="Emily Selman."
                                                    class="w-12 h-12 rounded-full">
                                                <div class="ml-4">
                                                    <h4 class="text-sm font-bold text-gray-900">
                                                        {{ $productReview->user->name }}</h4>
                                                    <div class="flex items-center mt-1">
                                                        <div class="showcase-rating">
                                                            {!! $productReview->getStarRatingReview() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 space-y-6 text-base italic text-gray-600">
                                                <p>{{ $productReview->comment }}</p>
                                            </div>
                                            <div id="animated-thumbnails" class="flex">

                                            @if ($productReview->img_url != null)
                                                @php
                                                    $img_url = explode('/', $productReview->img_url);
                                                @endphp
                                                    <a class="p-2 transition ease-in-out opacity-50 delay-10 hover:scale-110 item hover:opacity-100 "  href="{{ route('media', ['path1' => $img_url[0], 'path2' => $img_url[1], 'filename' => $img_url[2]]) }}">
                                                        <img src="{{ route('media', ['path1' => $img_url[0], 'path2' => $img_url[1], 'filename' => $img_url[2]]) }}" class="w-24 h-24"/>
                                                    </a>
                                            @endif
                                        </div>

                                        </div>
                                    @endforeach
                                    <div class="mt-3">
                                        {!! $productReviews->links('vendor.pagination.tailwind') !!}
                                    </div>
                                @else
                                    <div class="py-12">
                                        <div class="flex justify-center mt-4 space-y-6 text-base italic text-gray-600">
                                            <p>Sản phẩm chưa có đánh giá</p>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script src="{{ url('js/countdowns.js') }}"></script>
@endsection
