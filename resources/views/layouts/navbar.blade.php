  <!--
    - HEADER
  -->

  <header>

      <div class="header-top">

          <div class="container">

              <ul class="header-social-container">

                  <li>
                      <a href="#" class="social-link">
                          <ion-icon name="logo-facebook"></ion-icon>
                      </a>
                  </li>

                  <li>
                      <a href="#" class="social-link">
                          <ion-icon name="logo-twitter"></ion-icon>
                      </a>
                  </li>

                  <li>
                      <a href="#" class="social-link">
                          <ion-icon name="logo-instagram"></ion-icon>
                      </a>
                  </li>

                  <li>
                      <a href="#" class="social-link">
                          <ion-icon name="logo-linkedin"></ion-icon>
                      </a>
                  </li>

              </ul>

              <div class="header-alert-news">
                  <p>
                      <b>Free Shipping</b>
                      This Week Order Over - $55
                  </p>
              </div>

              <div class="header-top-actions">

                  <select name="currency">

                      <option value="usd">USD &dollar;</option>
                      <option value="eur">EUR &euro;</option>

                  </select>

                  <select name="language">

                      <option value="en-US">English</option>
                      <option value="es-ES">Espa&ntilde;ol</option>
                      <option value="fr">Fran&ccedil;ais</option>

                  </select>

              </div>

          </div>

      </div>

      <div class="header-main">

          <div class="container">

              <a href="#" class="header-logo">
                  <img src="{{ url('images/logo/logo.svg') }}" alt="Anon's logo" width="120" height="36">
              </a>

              <div class="header-search-container">

                  <input type="search" name="search" class="search-field" placeholder="Enter your product name...">

                  <button class="search-btn">
                      <ion-icon name="search-outline"></ion-icon>
                  </button>

              </div>

              <div class="header-user-actions">

                  @if (Auth::check())
                    @php
                        $user = Auth::user();
                        $name = $user->name;
                        $displayedName = "Hi, ". strlen($name) > 6 ? substr($name, 0, 10) . '...' : $name;
                    @endphp
                      <div class="dropdown-menu">
                          <button id="dropdownAvatarNameButton"
                              class="flex items-center p-2 text-sm font-medium text-gray-900 rounded-full md:mr-0 ring-4 ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                              type="button">
                              <span class="sr-only">Open user menu</span>
                              <ion-icon class="w-8 h-8 mr-2 rounded-full" name="person-outline"></ion-icon>
                                {{$displayedName}}
                              <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                  fill="none" viewBox="0 0 10 6">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4" />
                              </svg>
                          </button>

                          <!-- Dropdown menu -->
                          <div
                              class="absolute z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dropdown-menu-user w-44 dark:bg-gray-700 dark:divide-gray-600">

                              <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                  <div class="font-medium ">{{ Auth::user()->name }}</div>
                                  <div class="truncate">Thành viên V.I.P</div>
                              </div>
                              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                  <li>
                                      <a href="#"
                                          class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hồ
                                          sơ</a>
                                  </li>
                                  <li>
                                      <a href="#"
                                          class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Bảo
                                          mật</a>
                                  </li>
                                  <li>
                                      <a href="#"
                                          class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Nạp
                                          tiền</a>
                                  </li>
                              </ul>
                              <div class="py-2">
                                  <a href="{{ route('auth-logout') }}"
                                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Đăng
                                      xuất</a>
                              </div>
                          </div>
                      </div>
                  @else
                      <a class="action-btn" href="{{ route('auth-login') }}">
                          <ion-icon name="person-outline"></ion-icon>
                      </a>
                  @endif


                  <button class="action-btn">
                      <ion-icon name="heart-outline"></ion-icon>
                      <span class="count">0</span>
                  </button>

                  <button class="action-btn btn-cart">
                      <ion-icon name="bag-handle-outline"></ion-icon>
                      @if (session()->has('cart') && is_array(session('cart')))
                          <span class="count count-cart">{{ count(session('cart')) }}</span>
                      @else
                          <span class="count count-cart">0</span>
                      @endif
                  </button>



              </div>

          </div>

      </div>

      <nav class="desktop-navigation-menu">

          <div class="container">

              <ul class="desktop-menu-category-list">

                  <li class="menu-category">
                      <a href="{{ route('index') }}" class="menu-title">Trang chủ</a>
                  </li>

                  <li class="menu-category">
                      <a href="#" class="menu-title">Danh mục</a>

                      <div class="dropdown-panel">

                          <ul class="dropdown-panel-list">

                              <li class="menu-title">
                                  <a href="#">Electronics</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 14]) }}">PC</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 15]) }}">Laptop</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 17]) }}">Camera</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 16]) }}">Máy tính bảng</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 18]) }}">Tai nghe</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="#">
                                      <img src="{{ url('images/electronics-banner-1.jpg') }}"
                                          alt="headphone collection" width="250" height="119">
                                  </a>
                              </li>

                          </ul>

                          <ul class="dropdown-panel-list">

                              <li class="menu-title">
                                  <a href="#">Nam</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 2]) }}">Quần Short</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 2]) }}">Quần Jean</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 4]) }}">Giày</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="#">
                                      <img src="{{ url('images/mens-banner.jpg') }}" alt="men's fashion"
                                          width="250" height="119">
                                  </a>
                              </li>

                          </ul>

                          <ul class="dropdown-panel-list">

                              <li class="menu-title">
                                  <a href="#">Nữ</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 6]) }}">Váy và Áo dài</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 7]) }}">Hoa Tai</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 8]) }}">Vòng cổ</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 9]) }}">Trang điểm</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 6]) }}">Váy và Áo dài</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="#">
                                      <img src="{{ url('images/womens-banner.jpg') }}" alt="women's fashion"
                                          width="250" height="119">
                                  </a>
                              </li>

                          </ul>

                          <ul class="dropdown-panel-list">

                              <li class="menu-title">
                                  <a href="#">Thiết bị điện tử</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 19]) }}">Đồng hồ thông minh</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 20]) }}">TV thông minh</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 21]) }}">Bàn phím</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 22]) }}">Chuột</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="{{ route('category-product', ['id' => 23]) }}">Microphone</a>
                              </li>

                              <li class="panel-list-item">
                                  <a href="#">
                                      <img src="{{ url('images/electronics-banner-2.jpg') }}" alt="mouse collection"
                                          width="250" height="119">
                                  </a>
                              </li>

                          </ul>

                      </div>
                  </li>

                  <li class="menu-category">
                      <a href="#" class="menu-title">Nam</a>

                      <ul class="dropdown-list">

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 1]) }}">Áo</a>
                          </li>

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 2]) }}">Quần Short</a>
                          </li>

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 4]) }}">Giày</a>
                          </li>

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 5]) }}">Ví</a>
                          </li>

                      </ul>
                  </li>

                  <li class="menu-category">
                      <a href="#" class="menu-title">Nữ</a>

                      <ul class="dropdown-list">

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 6]) }}">Váy và Áo dài</a>
                          </li>

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 7]) }}">Hoa Tai</a>
                          </li>

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 8]) }}">Vòng cổ</a>
                          </li>

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 9]) }}">Trang điểm</a>
                          </li>

                      </ul>
                  </li>

                  <li class="menu-category">
                      <a href="#" class="menu-title">Trang sức</a>

                      <ul class="dropdown-list">

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 7]) }}">Hoa tai</a>
                          </li>

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 10]) }}">Nhẫn đôi</a>
                          </li>

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 8]) }}">Vòng cổ</a>
                          </li>

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 11]) }}">Vòng tay</a>
                          </li>

                      </ul>
                  </li>

                  <li class="menu-category">
                      <a href="#" class="menu-title">Nước hoa</a>

                      <ul class="dropdown-list">

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 12]) }}">Khử mùi</a>
                          </li>

                          <li class="dropdown-item">
                              <a href="{{ route('category-product', ['id' => 13]) }}">Nước hoa</a>
                          </li>
                      </ul>
                  </li>

                  <li class="menu-category">
                      <a href="#" class="menu-title">Blog</a>
                  </li>

                  <li class="menu-category">
                      <a href="#" class="menu-title">Ưu đãi hấp dẫn</a>
                  </li>

              </ul>

          </div>

      </nav>

      <div class="mobile-bottom-navigation">

          <button class="action-btn" data-mobile-menu-open-btn>
              <ion-icon name="menu-outline"></ion-icon>
          </button>

          <button class="action-btn">
              <ion-icon name="bag-handle-outline"></ion-icon>

              <span class="count">0</span>
          </button>

          <button class="action-btn">
              <ion-icon name="home-outline"></ion-icon>
          </button>

          <button class="action-btn">
              <ion-icon name="heart-outline"></ion-icon>

              <span class="count">0</span>
          </button>

          <button class="action-btn" data-mobile-menu-open-btn>
              <ion-icon name="grid-outline"></ion-icon>
          </button>

      </div>

      <nav class="mobile-navigation-menu has-scrollbar" data-mobile-menu>

          <div class="menu-top">
              <h2 class="menu-title">Menu</h2>

              <button class="menu-close-btn" data-mobile-menu-close-btn>
                  <ion-icon name="close-outline"></ion-icon>
              </button>
          </div>

          <ul class="mobile-menu-category-list">

              <li class="menu-category">
                  <a href="#" class="menu-title">Home</a>
              </li>

              <li class="menu-category">

                  <button class="accordion-menu" data-accordion-btn>
                      <p class="menu-title">Men's</p>

                      <div>
                          <ion-icon name="add-outline" class="add-icon"></ion-icon>
                          <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                      </div>
                  </button>

                  <ul class="submenu-category-list" data-accordion>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Shirt</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Shorts & Jeans</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Safety Shoes</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Wallet</a>
                      </li>

                  </ul>

              </li>

              <li class="menu-category">

                  <button class="accordion-menu" data-accordion-btn>
                      <p class="menu-title">Women's</p>

                      <div>
                          <ion-icon name="add-outline" class="add-icon"></ion-icon>
                          <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                      </div>
                  </button>

                  <ul class="submenu-category-list" data-accordion>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Dress & Frock</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Earrings</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Necklace</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Makeup Kit</a>
                      </li>

                  </ul>

              </li>

              <li class="menu-category">

                  <button class="accordion-menu" data-accordion-btn>
                      <p class="menu-title">Jewelry</p>

                      <div>
                          <ion-icon name="add-outline" class="add-icon"></ion-icon>
                          <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                      </div>
                  </button>

                  <ul class="submenu-category-list" data-accordion>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Earrings</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Couple Rings</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Necklace</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Bracelets</a>
                      </li>

                  </ul>

              </li>

              <li class="menu-category">

                  <button class="accordion-menu" data-accordion-btn>
                      <p class="menu-title">Perfume</p>

                      <div>
                          <ion-icon name="add-outline" class="add-icon"></ion-icon>
                          <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                      </div>
                  </button>

                  <ul class="submenu-category-list" data-accordion>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Clothes Perfume</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Deodorant</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Flower Fragrance</a>
                      </li>

                      <li class="submenu-category">
                          <a href="#" class="submenu-title">Air Freshener</a>
                      </li>

                  </ul>

              </li>

              <li class="menu-category">
                  <a href="#" class="menu-title">Blog</a>
              </li>

              <li class="menu-category">
                  <a href="#" class="menu-title">Hot Offers</a>
              </li>

          </ul>

          <div class="menu-bottom">

              <ul class="menu-category-list">

                  <li class="menu-category">

                      <button class="accordion-menu" data-accordion-btn>
                          <p class="menu-title">Language</p>

                          <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
                      </button>

                      <ul class="submenu-category-list" data-accordion>

                          <li class="submenu-category">
                              <a href="#" class="submenu-title">English</a>
                          </li>

                          <li class="submenu-category">
                              <a href="#" class="submenu-title">Espa&ntilde;ol</a>
                          </li>

                          <li class="submenu-category">
                              <a href="#" class="submenu-title">Fren&ccedil;h</a>
                          </li>

                      </ul>

                  </li>

                  <li class="menu-category">
                      <button class="accordion-menu" data-accordion-btn>
                          <p class="menu-title">Currency</p>
                          <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
                      </button>

                      <ul class="submenu-category-list" data-accordion>
                          <li class="submenu-category">
                              <a href="#" class="submenu-title">USD &dollar;</a>
                          </li>

                          <li class="submenu-category">
                              <a href="#" class="submenu-title">EUR &euro;</a>
                          </li>
                      </ul>
                  </li>

              </ul>

              <ul class="menu-social-container">

                  <li>
                      <a href="#" class="social-link">
                          <ion-icon name="logo-facebook"></ion-icon>
                      </a>
                  </li>

                  <li>
                      <a href="#" class="social-link">
                          <ion-icon name="logo-twitter"></ion-icon>
                      </a>
                  </li>

                  <li>
                      <a href="#" class="social-link">
                          <ion-icon name="logo-instagram"></ion-icon>
                      </a>
                  </li>

                  <li>
                      <a href="#" class="social-link">
                          <ion-icon name="logo-linkedin"></ion-icon>
                      </a>
                  </li>

              </ul>

          </div>

      </nav>

  </header>
