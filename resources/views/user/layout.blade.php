@extends('layouts.default')

@section('title', 'Cài đặt')

@section('content')
    <div class="container mx-auto">
        <div class="product-featured">
            <div class="showcase-container">

                <div class="hidden p-10 pb-16 space-y-6 bg-white md:block">
                    <div class="space-y-0.5">
                        <h2 class="text-2xl font-bold tracking-tight">Cài đặt</h2>
                        <p class="text-muted-foreground">
                            Quản lý cài đặt tài khoản của bạn.
                        </p>
                    </div>
                    <!-- Seperator -->
                    <div class="shrink-0 bg-border h-[1px] w-full"></div>
                    <div class="flex flex-col space-y-8 lg:flex-row lg:space-x-12 lg:space-y-0 ">
                        <nav class="flex space-x-2 border-r-2 border-gray-400 lg:flex-col lg:space-x-0 lg:space-y-1 ">
                            <a class="inline-flex items-center justify-start px-4 py-2 text-sm font-medium transition-colors rounded-l-lg focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 hover:bg-gray-200"
                                href="{{ route('user-info') }}">Thông tin tài khoản</a>
                            <a class="inline-flex items-center justify-start px-4 py-2 text-sm font-medium transition-colors rounded-l-lg focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 bg-muted hover:bg-gray-200"
                                href="/examples/forms/account">Bảo mật</a>
                            <a class="inline-flex items-center justify-start px-4 py-2 text-sm font-medium transition-colors rounded-l-lg focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 hover:bg-gray-200 "
                                href="/examples/forms/appearance">Địa chỉ giao hàng</a>
                            <a class="inline-flex items-center justify-start px-4 py-2 text-sm font-medium transition-colors rounded-l-lg focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 hover:bg-gray-200 "
                                href="{{ route('user-recharge') }}">Nạp tiền</a>
                            <a class="inline-flex items-center justify-start px-4 py-2 text-sm font-medium transition-colors rounded-l-lg focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 hover:bg-gray-200 "
                                href="/examples/forms/display">Cài đặt tài khoản</a>
                        </nav>

                        <div class="flex-1 lg:max-w-2xl">
                            <!-- About Page Content -->
                            @yield('content-user')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
