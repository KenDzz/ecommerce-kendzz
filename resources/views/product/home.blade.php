@extends('layouts.default')

@section('title', 'Trang Chủ')

@section('content')



    @include('home.banner')



    <!--
          - CATEGORY
        -->

    {{-- @include('home.category') --}}





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

                    <div class="owl-carousel owl-carousel-sale-timer">

                        @foreach ($sale as $data)
                            <div class="showcase-container item">

                                <div class="showcase">

                                    <div class="showcase-banner">
                                        @if (!empty($data->product->productMedia) && $data->product->productMedia->count())
                                            @foreach ($data->product->productMedia as $key => $productMedia)
                                                @if ($key == 0)
                                                    <img src="{{ url($productMedia->url) }}" alt="{{ $data->product->name }}">
                                                @endif
                                            @endforeach
                                        @else
                                            <img src="https://dummyimage.com/800x700/ffffff/000000&text=first">
                                        @endif
                                </div>

                                <div class="showcase-content">

                                    <div class="showcase-rating">
                                        {!! $data->product->getStarRating() !!}
                                    </div>

                                    <a href="{{ route('detail-product', ['slug' => urlencode($data->product->slug), 'id' => $data->product->id]) }}">
                                        <h3 class="showcase-title">{{ $data->product->name }}</h3>
                                    </a>


                                    <div class="price-box">
                                        @if ($data->product->discount > 0)
                                            <p class="price">
                                                {{ app('App\Http\Controllers\HomeController')->formatCurrency($data->product->price, $data->discount) }}
                                            </p>
                                            <del>{{ app('App\Http\Controllers\HomeController')->formatCurrency($data->product->price, 0) }}</del>
                                        @endif
                                    </div>

                                    <button class="add-cart-btn">Thêm giỏ hàng</button>

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

                                    <div class="countdown-box">

                                        <p class="countdown-desc">
                                            Nhanh lên! Ưu đãi kết thúc sau:
                                        </p>

                                        <div class="countdown">

                                            <div class="countdown-content">

                                                <p class="display-number display-number-day-{{$data->product->id}}">360</p>

                                                <p class="display-text">Ngày</p>

                                            </div>

                                            <div class="countdown-content">
                                                <p class="display-number display-number-hour-{{$data->product->id}}">24</p>
                                                <p class="display-text">Giờ</p>
                                            </div>

                                            <div class="countdown-content">
                                                <p class="display-number display-number-min-{{$data->product->id}}">59</p>
                                                <p class="display-text">Phút</p>
                                            </div>

                                            <div class="countdown-content">
                                                <p class="display-number display-number-sec-{{$data->product->id}}">00</p>
                                                <p class="display-text">Giây</p>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    @endforeach
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
                                        <img src="https://dummyimage.com/800x700/ffffff/000000&text=first"
                                            width="300" class="product-img default">
                                        <img src="https://dummyimage.com/800x700/ffffff/000000&text=second"
                                            alt="{{ $product->name }}" width="300" class="product-img hover">
                                    @endif

                                    @if ($product->discount > 0)
                                        <p class="showcase-badge">{{ $product->discount }}%</p>
                                    @endif

                                    <div class="showcase-actions">

                                        <button class="btn-action btn-action-favourite"
                                            data-product-id="{{ $product->id }}">
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

                    @endif
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

{{-- <div class="blog">

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

    </div> --}}

@section('scripts')
    <script src="{{ url('js/countdowns.js') }}"></script>
@endsection

@endsection
