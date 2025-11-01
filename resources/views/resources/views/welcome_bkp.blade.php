<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ocrecruiters</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .hover-shadow {
                transition: all 0.3s ease-in-out;
            }
            .hover-shadow:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
            }

        </style>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="container">
            <div class="flex justify-between items-center header_wrapper">
                <div>
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>
                @if (Route::has('login'))
                    <div class="btn_group_wrapper">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn_transparent">Register</a>
                            @endif
                            <a href="{{ route('login') }}" class="btn_primary">Log in</a>
                        @endauth
                    </div>
                @endif
        </div>

            
        </div>

       

        <div class="recruiter_wrapper">
            <div class="container mx-auto">
                <!-- Header -->
                <div class="filter_wrapper">
                    <div class="text-center mb-5">
                        <h1 class="h2">Browse Recruiters</h1>
                        <p class="text-muted">Find and connect with top recruiters in your area</p>
                    </div>
    
                    <!-- Search Form -->
                    <div class="filter_form_wrapper">
                        <form method="GET" action="{{ route('recruiters.index') }}"
                            class="form_wrapper">
        
                            <select name="category_id" class="form-select category_select select2" style="width: 180px;">
                                <option value="">All Categories</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
        
                            <select name="location_id" class="form-select location_select select2" style="width: 180px;">
                                <option value="">All Locations</option>
                                @foreach ($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>
                                        {{ $loc->name }}
                                    </option>
                                @endforeach
                            </select>
                            
                            {{-- <input type="text" name="name" placeholder="Search by Name"
                                value="{{ request('name') }}" class="form-control" style="width: 160px;"> --}}
        
                            <button type="submit" class="btn_primary">
                                Search
                            </button>
        
                        </form>
                    </div>
                </div>

                <!-- Showing Records Info -->
                {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="text-muted mb-0">
                        Showing {{ $recruiters->firstItem() ?? 0 }}–{{ $recruiters->lastItem() ?? 0 }}
                        of {{ $total }} recruiters
                    </p>
                </div> --}}

                <div class="flex flex-wrap items-center justify-between mb-5 bg-white p-4 rounded-lg shadow-sm">
                    
                    
                    <div class="form-group">
                        <!-- Sort By -->
                        <div class="flex items-center gap-3">
                            <label for="sort" class="text-sm font-medium text-gray-700">Sort By:</label>
                            <select id="sort" name="sort" 
                                    class="border border-gray-300 rounded-md text-sm px-2 py-2 w-44 focus:ring-2 focus:ring-blue-500"
                                    onchange="updateQueryParam('sort', this.value)">
                                <option value="">Default</option>
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A–Z)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z–A)</option>
                                <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>Rating (High–Low)</option>
                                <option value="rating_asc" {{ request('sort') == 'rating_asc' ? 'selected' : '' }}>Rating (Low–High)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Length Menu -->
                        <div class="flex items-center gap-3">
                            <label for="per_page" class="text-sm font-medium text-gray-700">Show:</label>
                            <select id="per_page" name="per_page"
                                    class="border border-gray-300 rounded-md text-sm px-2 py-2 w-24 focus:ring-2 focus:ring-blue-500"
                                    onchange="updateQueryParam('per_page', this.value)">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Grid -->
                <div class="recruiter_list_wrap">
                    <!-- Recruiter Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($recruiters as $recruiter)
                            <div class="recruiter_box transition-transform transform hover:-translate-y-1">
                                <!-- Logo -->
                                <div class="flex justify-center mb-3">
                                    @if($recruiter->logo)
                                        <img src="{{ asset('storage/' .$recruiter->logo) }}" 
                                            alt="{{ $recruiter->name }}" 
                                            class="w-20 h-20 rounded-full object-cover shadow">
                                    @else
                                        <div class="bg-gray-200 rounded-full flex items-center justify-center w-20 h-20 text-lg font-bold text-gray-700">
                                            {{ strtoupper(substr($recruiter->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Name -->
                                <h2 class="text-lg font-semibold text-gray-800"><a href="{{ route('recruiters.show', $recruiter->user_id) }}">{{ $recruiter->name }}</a></h2>
                                <p class="text-sm text-gray-500">{{ $recruiter->location?->name ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-400 mb-3">{{ $recruiter->category?->name ?? 'N/A' }}</p>

                                <!-- Rating -->
                                <div class="flex justify-center items-center text-yellow-400 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5 mr-1">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.26 3.89a1 1 0 00.95.69h4.1c.969 0 1.371 1.24.588 1.81l-3.32 2.41a1 1 0 00-.364 1.118l1.26 3.89c.3.921-.755 1.688-1.54 1.118l-3.32-2.41a1 1 0 00-1.176 0l-3.32 2.41c-.785.57-1.84-.197-1.54-1.118l1.26-3.89a1 1 0 00-.364-1.118l-3.32-2.41c-.783-.57-.38-1.81.588-1.81h4.1a1 1 0 00.95-.69l1.26-3.89z"/>
                                    </svg>
                                    <span>{{ number_format($recruiter->rating, 1) }}</span>
                                </div>

                                <!-- Jobs -->
                                {{-- <span class="text-sm bg-blue-100 text-blue-600 px-3 py-1 rounded">
                                    {{ $recruiter->jobs_open > 0 ? $recruiter->jobs_open . ' Open Jobs' : 'No Open Job' }}
                                </span> --}}
                            </div>
                    @empty
                        <p class="col-span-full text-center text-gray-500">No recruiters found.</p>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $recruiters->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script type="text/javascript">
        function updateQueryParam(param, value) {
            const url = new URL(window.location.href);

            if (value) {
                url.searchParams.set(param, value);
            } else {
                url.searchParams.delete(param);
            }

            // Always reset to first page when sorting or per_page changes
            url.searchParams.delete('page');

            window.location.href = url.toString();
        }
            $(document).ready(function() {
                $('.category_select').select2({
                    placeholder: "Select an category",
                    allowClear: true,
                    width: 'resolve',
                    dropdownPosition: 'below'
                });
                $('.location_select').select2({
                    placeholder: "Select an location",
                    allowClear: true,
                    width: 'resolve',
                    dropdownPosition: 'below'
                });
            });

        </script>
    </body>
</html>
