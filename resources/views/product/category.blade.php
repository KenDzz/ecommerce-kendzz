@extends('layouts.default')

@section('title', $title)

@section('content')


    @include('home.banner')

    <!--
      - PRODUCT
    -->

    <div class="product-container">

        <div class="container">


            <!--
          - SIDEBAR
        -->

            @include('home.sidebar')


            <div class="product-box">

                <!--
            - PRODUCT GRID
          -->

                <div class="product-main">

                    <h2 class="title">{{ $title }}</h2>

                    <div class="product-grid">

                        @if (!empty($products) && $products->count())
                            @foreach ($products as $product)
                                <div class="showcase">

                                    <div class="showcase-banner">

                                        @if (!empty($product->productMedia) && $product->productMedia->count())
                                            @foreach ($product->productMedia as $key => $productMedia)
                                                @if ($key == 0)
                                                    <img src="{{ url($productMedia->url) }}" alt="{{ $product->name }}"
                                                    width="300" class="h-52 w-52 product-img default">
                                                @else
                                                    <img src="{{ url($productMedia->url) }}" alt="{{ $product->name }}"
                                                    width="300" class="h-52 w-52 product-img hover">
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

                                        <div class="showcase-actions">

                                            <button class="btn-action">
                                                <ion-icon name="heart-outline"></ion-icon>
                                            </button>

                                            <button class="btn-action">
                                                <ion-icon name="eye-outline"></ion-icon>
                                            </button>

                                            <button class="btn-action">
                                                <ion-icon name="repeat-outline"></ion-icon>
                                            </button>

                                            <button class="btn-action">
                                                <ion-icon name="bag-add-outline"></ion-icon>
                                            </button>

                                        </div>

                                    </div>

                                    <div class="showcase-content">

                                        <a href="#" class="showcase-category">{{ $title }}</a>

                                        <a href="{{ route('detail-product', ['slug'=>urlencode($product->slug), 'id' => $product->id]) }}">
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

                        @endif
                    </div>
                    {!! $products->links('vendor.pagination.tailwind') !!}
                </div>

            </div>

        </div>

    </div>


@endsection
