<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Anon - @yield('title')</title>
    <!--
    - favicon
  -->
    <link rel="shortcut icon" href="{{ url('images/logo/favicon.ico') }}" type="image/x-icon">

    <!--
    - custom css link
  -->
    <link rel="stylesheet" href="{{ url('css/style-prefix.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ url('css/notiflix-3.2.6.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <link href="{{ url('css/star-rating.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body attr-data-id="{{ Auth::user()->id ?? 0 }}">
    <div class="overlay" data-overlay></div>

    <!--
    - MODAL
  -->

    {{-- <div class="modal" data-modal>

    <div class="modal-close-overlay" data-modal-overlay></div>

    <div class="modal-content">

      <button class="modal-close-btn" data-modal-close>
        <ion-icon name="close-outline"></ion-icon>
      </button>

      <div class="newsletter-img">
        <img src="{{ url('images/newsletter.png') }}" alt="subscribe newsletter" width="400" height="400">
      </div>

      <div class="newsletter">

        <form action="#">

          <div class="newsletter-header">

            <h3 class="newsletter-title">Subscribe Newsletter.</h3>

            <p class="newsletter-desc">
              Subscribe the <b>Anon</b> to get latest products and discount update.
            </p>

          </div>

          <input type="email" name="email" class="email-field" placeholder="Email Address" required>

          <button type="submit" class="btn-newsletter">Subscribe</button>

        </form>

      </div>

    </div>

  </div> --}}





    <!--
    - NOTIFICATION TOAST
  -->

    <div class="notification-toast"  data-toast>

        <button class="toast-close-btn" data-toast-close>
            <ion-icon name="close-outline"></ion-icon>
        </button>

        <div class="toast-banner">
            <img src="{{ url('images/products/jewellery-1.jpg') }}" alt="Rose Gold Earrings" width="80"
                height="70">
        </div>

        <div class="toast-detail">

            <p class="toast-message">
                Someone in new just bought
            </p>

            <p class="toast-title">
                Rose Gold Earrings
            </p>

            <p class="toast-meta">
                <time datetime="PT2M">2 Minutes</time> ago
            </p>

        </div>

    </div>




    @include('layouts.navbar')

    @include('layouts.chat')

    @include('home.cart')

    @include('home.favourite')
    <!--
    - MAIN
    -->

    <main>

        @yield('content')

    </main>

    @include('layouts.footer')


</body>

<!--
    - custom js link
  -->

<script src="{{ url('js/jquery-3.7.0.min.js') }}"></script>
<script src="{{ url('js/notiflix-3.2.6.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>
<script src="{{ url('js/star-rating.min.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script type="module" src="{{ url('js/module.js') }}"></script>
<script>
    var starrating = new StarRating('.star-rating', {
        stars: function(el, item, index) {
            el.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
        },
    });
</script>
<script src="{{ url('js/script.js') }}"></script>
<script src="{{ url('js/product.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

<!--
    - ionicon link
  -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></scrip>

</html>
