<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @yield('extra_css')
</head>
<body class="bg-gray-50">
    <div class="flex h-screen bg-gray-100">
        <!-- SIDEBAR -->
        <div class="hidden md:flex md:w-64 md:flex-col">
            <div class="flex flex-col flex-grow overflow-y-auto bg-gradient-to-b from-indigo-600 to-purple-700 text-white pt-5 pb-4">
                <!-- Logo -->
                <div class="px-6 pb-6 border-b border-indigo-500">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <i class="fas fa-home text-indigo-600 text-lg"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">Rental</h1>
                            <p class="text-xs text-indigo-200">Admin Panel</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-3 py-4 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-indigo-600 shadow-lg' : 'text-indigo-100 hover:bg-indigo-500' }}">
                        <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.categories.index') }}" 
                       class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-white text-indigo-600 shadow-lg' : 'text-indigo-100 hover:bg-indigo-500' }}">
                        <i class="fas fa-tags w-5 h-5 mr-3"></i>
                        Kategori
                    </a>

                    <a href="{{ route('admin.products.index') }}" 
                       class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-white text-indigo-600 shadow-lg' : 'text-indigo-100 hover:bg-indigo-500' }}">
                        <i class="fas fa-tshirt w-5 h-5 mr-3"></i>
                        Produk
                    </a>

                    <a href="{{ route('admin.rentals.index') }}" 
                       class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.rentals.*') ? 'bg-white text-indigo-600 shadow-lg' : 'text-indigo-100 hover:bg-indigo-500' }}">
                        <i class="fas fa-calendar w-5 h-5 mr-3"></i>
                        Penyewaan
                    </a>

                    <a href="{{ route('admin.payments.index') }}" 
                       class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.payments.*') ? 'bg-white text-indigo-600 shadow-lg' : 'text-indigo-100 hover:bg-indigo-500' }}">
                        <i class="fas fa-credit-card w-5 h-5 mr-3"></i>
                        Pembayaran
                    </a>
                </nav>

                <!-- User Section -->
                <div class="px-3 py-4 border-t border-indigo-500">
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-3 py-2 text-sm font-medium text-indigo-100 rounded-lg hover:bg-indigo-500 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- TOP BAR -->
            <div class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900">@yield('page_title', 'Dashboard')</h1>
                    <div class="flex items-center gap-4">
                        <div class="hidden sm:block text-sm text-gray-600">
                            {{ auth()->user()->name }}
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- PAGE CONTENT -->
            <div class="flex-1 overflow-auto">
                <div class="px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Alerts -->
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle text-red-500 mr-3 mt-0.5"></i>
                                <div>
                                    <h3 class="font-semibold text-red-800">Ada Kesalahan</h3>
                                    <ul class="mt-2 text-sm text-red-700 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <p class="text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-times-circle text-red-500 mr-3"></i>
                                <p class="text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Content -->
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
    @yield('extra_js')
</body>
</html>