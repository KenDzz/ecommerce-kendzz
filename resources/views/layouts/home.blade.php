@extends('layouts.default')

@include('home.banner')

<!--
  - CATEGORY
-->

@include('home.category')
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
              - PRODUCT FEATURED
            -->

            <div class="product-featured">

                <h2 class="title">Deal of the day</h2>

                <div class="showcase-wrapper has-scrollbar">

                    <div class="showcase-container">

                        <div class="showcase">

                            <div class="showcase-banner">
                                <img src="{{ url('images/products/shampoo.jpg') }}"
                                    alt="shampoo, conditioner & facewash packs" class="showcase-img">
                            </div>

                            <div class="showcase-content">

                                <div class="showcase-rating">
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                </div>

                                <a href="#">
                                    <h3 class="showcase-title">shampoo, conditioner & facewash packs</h3>
                                </a>

                                <p class="showcase-desc">
                                    Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                    dolor dolor sit amet consectetur Lorem ipsum dolor
                                </p>

                                <div class="price-box">
                                    <p class="price">$150.00</p>

                                    <del>$200.00</del>
                                </div>

                                <button class="add-cart-btn">add to cart</button>

                                <div class="showcase-status">
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

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="showcase-container">

                        <div class="showcase">

                            <div class="showcase-banner">
                                <img src="{{ url('images/products/jewellery-1.jpg') }}" alt="Rose Gold diamonds Earring"
                                    class="showcase-img">
                            </div>

                            <div class="showcase-content">

                                <div class="showcase-rating">
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                </div>

                                <h3 class="showcase-title">
                                    <a href="#" class="showcase-title">Rose Gold diamonds Earring</a>
                                </h3>

                                <p class="showcase-desc">
                                    Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                    dolor dolor sit amet consectetur Lorem ipsum dolor
                                </p>

                                <div class="price-box">
                                    <p class="price">$1990.00</p>
                                    <del>$2000.00</del>
                                </div>

                                <button class="add-cart-btn">add to cart</button>

                                <div class="showcase-status">
                                    <div class="wrapper">
                                        <p> already sold: <b>15</b> </p>

                                        <p> available: <b>40</b> </p>
                                    </div>

                                    <div class="showcase-status-bar"></div>
                                </div>

                                <div class="countdown-box">

                                    <p class="countdown-desc">Hurry Up! Offer ends in:</p>

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

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!--
              - PRODUCT GRID
            -->

            <div class="product-main">

                <h2 class="title">New Products</h2>

                <div class="product-grid">
                    @if (!empty($products) && $products->count())
                    @foreach ($products as $product)
                        <div class="showcase">

                            <div class="showcase-banner">

                                @if (!empty($product->productMedia) && $product->productMedia->count())
                                    @foreach ($product->productMedia as $key => $productMedia)
                                        @if ($key == 0)
                                            <img src="{{ url($productMedia->url) }}" alt="{{ $product->name }}"
                                                width="300" class="product-img default">
                                        @else
                                            <img src="{{ url($productMedia->url) }}" alt="{{ $product->name }}"
                                                width="300" class="product-img hover">
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

                                    <button class="btn-action btn-action-favourite" data-product-id="{{$product->id}}">
                                        <ion-icon name="heart-outline" class="icon-favourite-product"></ion-icon>
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

                                <a href="#" class="showcase-category"></a>

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
                {!! $products->links('vendor.pagination.tailwind') !!}
                    {{-- <div class="showcase">

                        <div class="showcase-banner">

                            <img src="{{ url('images/products/jacket-3.jpg') }}" alt="Mens Winter Leathers Jackets"
                                width="300" class="product-img default">
                            <img src="{{ url('images/products/jacket-4.jpg') }}" alt="Mens Winter Leathers Jackets"
                                width="300" class="product-img hover">

                            <p class="showcase-badge">15%</p>

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

                            <a href="#" class="showcase-category">jacket</a>

                            <a href="#">
                                <h3 class="showcase-title">Mens Winter Leathers Jackets</h3>
                            </a>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$48.00</p>
                                <del>$75.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/shirt-1.jpg') }}" alt="Pure Garment Dyed Cotton Shirt"
                                class="product-img default" width="300">
                            <img src="{{ url('images/products/shirt-2.jpg') }}" alt="Pure Garment Dyed Cotton Shirt"
                                class="product-img hover" width="300">

                            <p class="showcase-badge angle black">sale</p>

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
                            <a href="#" class="showcase-category">shirt</a>

                            <h3>
                                <a href="#" class="showcase-title">Pure Garment Dyed Cotton Shirt</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$45.00</p>
                                <del>$56.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/jacket-5.jpg') }}" alt="MEN Yarn Fleece Full-Zip Jacket"
                                class="product-img default" width="300">
                            <img src="{{ url('images/products/jacket-6.jpg') }}" alt="MEN Yarn Fleece Full-Zip Jacket"
                                class="product-img hover" width="300">

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
                            <a href="#" class="showcase-category">Jacket</a>

                            <h3>
                                <a href="#" class="showcase-title">MEN Yarn Fleece Full-Zip Jacket</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$58.00</p>
                                <del>$65.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/clothes-3.jpg') }}" alt="Black Floral Wrap Midi Skirt"
                                class="product-img default" width="300">
                            <img src="{{ url('images/products/clothes-4.jpg') }}" alt="Black Floral Wrap Midi Skirt"
                                class="product-img hover" width="300">

                            <p class="showcase-badge angle pink">new</p>

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
                            <a href="#" class="showcase-category">skirt</a>

                            <h3>
                                <a href="#" class="showcase-title">Black Floral Wrap Midi Skirt</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$25.00</p>
                                <del>$35.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/shoe-2.jpg') }}" alt="Casual Men's Brown shoes"
                                class="product-img default" width="300">
                            <img src="{{ url('images/products/shoe-2_1.jpg') }}" alt="Casual Men's Brown shoes"
                                class="product-img hover" width="300">

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
                            <a href="#" class="showcase-category">casual</a>

                            <h3>
                                <a href="#" class="showcase-title">Casual Men's Brown shoes</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$99.00</p>
                                <del>$105.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/watch-3.jpg') }}" alt="Pocket Watch Leather Pouch"
                                class="product-img default" width="300">
                            <img src="{{ url('images/products/watch-4.jpg') }}" alt="Pocket Watch Leather Pouch"
                                class="product-img hover" width="300">

                            <p class="showcase-badge angle black">sale</p>

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
                            <a href="#" class="showcase-category">watches</a>

                            <h3>
                                <a href="#" class="showcase-title">Pocket Watch Leather Pouch</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$150.00</p>
                                <del>$170.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/watch-1.jpg') }}" alt="Smart watche Vital Plus"
                                class="product-img default" width="300">
                            <img src="{{ url('images/products/watch-2.jpg') }}" alt="Smart watche Vital Plus"
                                class="product-img hover" width="300">

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
                            <a href="#" class="showcase-category">watches</a>

                            <h3>
                                <a href="#" class="showcase-title">Smart watche Vital Plus</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$100.00</p>
                                <del>$120.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/party-wear-1.jpg') }}" alt="Womens Party Wear Shoes"
                                class="product-img default" width="300">
                            <img src="{{ url('images/products/party-wear-2.jpg') }}" alt="Womens Party Wear Shoes"
                                class="product-img hover" width="300">

                            <p class="showcase-badge angle black">sale</p>

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
                            <a href="#" class="showcase-category">party wear</a>

                            <h3>
                                <a href="#" class="showcase-title">Womens Party Wear Shoes</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$25.00</p>
                                <del>$30.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/jacket-1.jpg') }}" alt="Mens Winter Leathers Jackets"
                                class="product-img default" width="300">
                            <img src="{{ url('images/products/jacket-2.jpg') }}" alt="Mens Winter Leathers Jackets"
                                class="product-img hover" width="300">

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
                            <a href="#" class="showcase-category">jacket</a>

                            <h3>
                                <a href="#" class="showcase-title">Mens Winter Leathers Jackets</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$32.00</p>
                                <del>$45.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/sports-2.jpg') }}"
                                alt="Trekking & Running Shoes - black" class="product-img default" width="300">
                            <img src="{{ url('images/products/sports-4.jpg') }}"
                                alt="Trekking & Running Shoes - black" class="product-img hover" width="300">

                            <p class="showcase-badge angle black">sale</p>

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
                            <a href="#" class="showcase-category">sports</a>

                            <h3>
                                <a href="#" class="showcase-title">Trekking & Running Shoes - black</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$58.00</p>
                                <del>$64.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/shoe-1.jpg') }}" alt="Men's Leather Formal Wear shoes"
                                class="product-img default" width="300">
                            <img src="{{ url('images/products/shoe-1_1.jpg') }}"
                                alt="Men's Leather Formal Wear shoes" class="product-img hover" width="300">

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
                            <a href="#" class="showcase-category">formal</a>

                            <h3>
                                <a href="#" class="showcase-title">Men's Leather Formal Wear shoes</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$50.00</p>
                                <del>$65.00</del>
                            </div>

                        </div>

                    </div>

                    <div class="showcase">

                        <div class="showcase-banner">
                            <img src="{{ url('images/products/shorts-1.jpg') }}"
                                alt="Better Basics French Terry Sweatshorts" class="product-img default"
                                width="300">
                            <img src="{{ url('images/products/shorts-2.jpg') }}"
                                alt="Better Basics French Terry Sweatshorts" class="product-img hover"
                                width="300">

                            <p class="showcase-badge angle black">sale</p>

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
                            <a href="#" class="showcase-category">shorts</a>

                            <h3>
                                <a href="#" class="showcase-title">Better Basics French Terry Sweatshorts</a>
                            </h3>

                            <div class="showcase-rating">
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                                <ion-icon name="star-outline"></ion-icon>
                            </div>

                            <div class="price-box">
                                <p class="price">$78.00</p>
                                <del>$85.00</del>
                            </div>

                        </div>

                    </div> --}}

                </div>

            </div>

        </div>

    </div>

</div>





<!--
        - TESTIMONIALS, CTA & SERVICE
      -->

<div>

    <div class="container">

        <div class="testimonials-box">

            <!--
              - TESTIMONIALS
            -->

            <div class="testimonial">

                <h2 class="title">testimonial</h2>

                <div class="testimonial-card">

                    <img src="{{ url('images/testimonial-1.jpg') }}" alt="alan doe" class="testimonial-banner"
                        width="80" height="80">

                    <p class="testimonial-name">Alan Doe</p>

                    <p class="testimonial-title">CEO & Founder Invision</p>

                    <img src="{{ url('images/icons/quotes.svg') }}" alt="quotation" class="quotation-img"
                        width="26">

                    <p class="testimonial-desc">
                        Lorem ipsum dolor sit amet consectetur Lorem ipsum
                        dolor dolor sit amet.
                    </p>

                </div>

            </div>



            <!--
              - CTA
            -->

            <div class="cta-container">

                <img src="{{ url('images/cta-banner.jpg') }}" alt="summer collection" class="cta-banner">

                <a href="#" class="cta-content">

                    <p class="discount">25% Discount</p>

                    <h2 class="cta-title">Summer collection</h2>

                    <p class="cta-text">Starting @ $10</p>

                    <button class="cta-btn">Shop now</button>

                </a>

            </div>



            <!--
              - SERVICE
            -->

            <div class="service">

                <h2 class="title">Our Services</h2>

                <div class="service-container">

                    <a href="#" class="service-item">

                        <div class="service-icon">
                            <ion-icon name="boat-outline"></ion-icon>
                        </div>

                        <div class="service-content">

                            <h3 class="service-title">Worldwide Delivery</h3>
                            <p class="service-desc">For Order Over $100</p>

                        </div>

                    </a>

                    <a href="#" class="service-item">

                        <div class="service-icon">
                            <ion-icon name="rocket-outline"></ion-icon>
                        </div>

                        <div class="service-content">

                            <h3 class="service-title">Next Day delivery</h3>
                            <p class="service-desc">UK Orders Only</p>

                        </div>

                    </a>

                    <a href="#" class="service-item">

                        <div class="service-icon">
                            <ion-icon name="call-outline"></ion-icon>
                        </div>

                        <div class="service-content">

                            <h3 class="service-title">Best Online Support</h3>
                            <p class="service-desc">Hours: 8AM - 11PM</p>

                        </div>

                    </a>

                    <a href="#" class="service-item">

                        <div class="service-icon">
                            <ion-icon name="arrow-undo-outline"></ion-icon>
                        </div>

                        <div class="service-content">

                            <h3 class="service-title">Return Policy</h3>
                            <p class="service-desc">Easy & Free Return</p>

                        </div>

                    </a>

                    <a href="#" class="service-item">

                        <div class="service-icon">
                            <ion-icon name="ticket-outline"></ion-icon>
                        </div>

                        <div class="service-content">

                            <h3 class="service-title">30% money back</h3>
                            <p class="service-desc">For Order Over $100</p>

                        </div>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>





<!--
        - BLOG
      -->

<div class="blog">

    <div class="container">

        <div class="blog-container has-scrollbar">

            <div class="blog-card">

                <a href="#">
                    <img src="{{ url('images/blog-1.jpg') }}"
                        alt="Clothes Retail KPIs 2021 Guide for Clothes Executives" width="300"
                        class="blog-banner">
                </a>

                <div class="blog-content">

                    <a href="#" class="blog-category">Fashion</a>

                    <a href="#">
                        <h3 class="blog-title">Clothes Retail KPIs 2021 Guide for Clothes Executives.</h3>
                    </a>

                    <p class="blog-meta">
                        By <cite>Mr Admin</cite> / <time datetime="2022-04-06">Apr 06, 2022</time>
                    </p>

                </div>

            </div>

            <div class="blog-card">

                <a href="#">
                    <img src="{{ url('images/blog-2.jpg') }}"
                        alt="Curbside fashion Trends: How to Win the Pickup Battle." class="blog-banner"
                        width="300">
                </a>

                <div class="blog-content">

                    <a href="#" class="blog-category">Clothes</a>

                    <h3>
                        <a href="#" class="blog-title">Curbside fashion Trends: How to Win the Pickup
                            Battle.</a>
                    </h3>

                    <p class="blog-meta">
                        By <cite>Mr Robin</cite> / <time datetime="2022-01-18">Jan 18, 2022</time>
                    </p>

                </div>

            </div>

            <div class="blog-card">

                <a href="#">
                    <img src="{{ url('images/blog-3.jpg') }}"
                        alt="EBT vendors: Claim Your Share of SNAP Online Revenue." class="blog-banner"
                        width="300">
                </a>

                <div class="blog-content">

                    <a href="#" class="blog-category">Shoes</a>

                    <h3>
                        <a href="#" class="blog-title">EBT vendors: Claim Your Share of SNAP Online Revenue.</a>
                    </h3>

                    <p class="blog-meta">
                        By <cite>Mr Selsa</cite> / <time datetime="2022-02-10">Feb 10, 2022</time>
                    </p>

                </div>

            </div>

            <div class="blog-card">

                <a href="#">
                    <img src="{{ url('images/blog-4.jpg') }}"
                        alt="Curbside fashion Trends: How to Win the Pickup Battle." class="blog-banner"
                        width="300">
                </a>

                <div class="blog-content">

                    <a href="#" class="blog-category">Electronics</a>

                    <h3>
                        <a href="#" class="blog-title">Curbside fashion Trends: How to Win the Pickup
                            Battle.</a>
                    </h3>

                    <p class="blog-meta">
                        By <cite>Mr Pawar</cite> / <time datetime="2022-03-15">Mar 15, 2022</time>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>
