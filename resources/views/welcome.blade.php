<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ocrecruiters</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .divider-line {
            color: #d1d5db;
            font-weight: 300;
            font-size: 18px;
            margin: 0 10px;
            line-height: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .duration-300 {
            transition-duration: .3s;
            display: none;
        }

        .dropdown-search-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 300px;
        }

        .dropdown-search::placeholder {
            color: #999;
            opacity: 1;
            font-size: 16px;
            font-size: bold;
        }

        .dropdown-search {
            width: 100%;
            padding: 10px 12px 10px 0;
            border: none;
            border-radius: 8px;
            background: transparent;
            box-shadow: none;
            outline: none;
            font-size: 14px;
        }

        .dropdown-search {
            background-color: #fff;
            border-radius: 8px;
            padding-left:13px;
        }

        .text-yellow-400 {
            display: none;
        }

        .suggestions-box {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #fff;
            border-radius: 0 0 8px 8px;
            border: 1px solid #e0e0e0;
            border-top: none;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            border-radius: 5px;
        }

        .suggestion-item {
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            color: #333;
        }

        .suggestion-item:hover {
            background-color: #f8f9ff;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="container">
        <div class="flex justify-between items-center header_wrapper">
            <div>
                <a href="/">
                    <x-application-logo class="w-319 h-20 fill-current text-gray-500" />
                </a>
            </div>
            @if (Route::has('login'))
                <div class="btn_group_wrapper">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
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

                <div class="filter_form_wrapper">
                    <form method="GET" action="{{ route('recruiters.index') }}" class="form_wrapper">

                        <img src="{{ asset('img/map-pin.svg') }}" alt="Location Icon"
                            class="w-4 h-4 text-gray-400 mr-2">
                        <div class="dropdown-search-wrapper"
                            style="position: relative; display: flex; align-items: center; width: 100%;">
                            <input type="text" id="stateCityInput" class="form-control dropdown-search"
                                name="" placeholder="Search location..." autocomplete="off">
                            <input type="hidden" name="state_city" id="stateCityIdInput" value="">
                            <div id="stateCitySuggestionBox" class="suggestions-box"
                                style="display: none; position: absolute; top: 100%; left: 0; right: 0; z-index: 1000; background: #fff; border: 1px solid #ccc;">
                            </div>
                        </div>

                        <span class="divider-line">|</span>

                        <img src="{{ asset('img/categorization.png') }}" alt="Location Icon"
                            class="w-4 h-4 text-gray-400 mr-2">
                        <div class="dropdown-search-wrapper"
                            style="position: relative; display: flex; align-items: center; width: 100%;">
                            <input type="text" id="categoryInput" class="form-control dropdown-search" name=""
                                placeholder="Search category..." autocomplete="off">
                            <input type="hidden" name="category" id="categoryIdInput" value="">
                            <div id="categorySuggestionBox" class="suggestions-box"
                                style="display: none; position: absolute; top: 100%; left: 0; right: 0; z-index: 1000; background: #fff; border: 1px solid #ccc;">
                            </div>
                        </div>

                        <button type="submit" class="btn_primary">
                            Search
                        </button>

                    </form>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-between bg-white p-4 rounded-lg shadow-sm border-bottom mb-5">
                <div class="text-sm text-gray-600">
                    @php
                        $from = $recruiters->firstItem() ?? 0;
                        $to = $recruiters->lastItem() ?? 0;
                        $total = $recruiters->total() ?? 0;
                    @endphp
                    Showing <span class="font-semibold">{{ $from }}</span>–
                    <span class="font-semibold">{{ $to }}</span> of
                    <span class="font-semibold">{{ $total }}</span> results
                </div>

                <div class="flex items-center gap-4">
                    <!-- Show -->
                    <div class="flex items-center gap-2">
                        <label for="per_page" class="text-sm text-gray-700">Show:</label>
                        <select id="per_page" name="per_page"
                            class="border cursor-pointer border-gray-300 rounded-md text-sm px-3 py-2 w-24 focus:ring-2 focus:ring-blue-500"
                            onchange="updateQueryParam('per_page', this.value)">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        <label for="sort" class="text-sm text-gray-700">Sort by:</label>
                        <select id="sort" name="sort"
                            class="border cursor-pointer border-gray-300 rounded-md text-sm px-3 py-2 w-44 focus:ring-2 focus:ring-blue-500"
                            onchange="updateQueryParam('sort', this.value)">
                            <option value="">Default</option>
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A–Z)
                            </option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name
                                (Z–A)</option>
                            <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>
                                Rating (High–Low)</option>
                            <option value="rating_asc" {{ request('sort') == 'rating_asc' ? 'selected' : '' }}>Rating
                                (Low–High)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="recruiter_list_wrap">
                <!-- Recruiter Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($recruiters as $recruiter)
                        <div class="recruiter_box transition-transform transform hover:-translate-y-1">
                            <!-- Logo -->
                            <div class="flex justify-center mb-3">
                                @if ($recruiter->logo)
                                    <img src="{{ asset('storage/' . $recruiter->logo) }}"
                                        alt="{{ $recruiter->name }}"
                                        class="w-20 h-20 rounded-full object-cover shadow {{ $recruiter->resume ? 'cursor-pointer' : '' }}">
                                @else
                                    <div
                                        class="bg-gray-200 rounded-full flex items-center justify-center w-20 h-20 text-lg font-bold text-gray-700 {{ $recruiter->resume ? 'cursor-pointer' : '' }}">
                                        {{ strtoupper(substr($recruiter->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Name -->
                            <h2 class="text-lg font-semibold text-gray-800">
                                @if ($recruiter->resume)
                                    <a href="{{ route('recruiters.show', [$recruiter->user_id, $recruiter->name]) }}">
                                        {{ $recruiter->name }}
                                    </a>
                                @else
                                    {{ $recruiter->name }}
                                @endif
                            </h2>
                            <p class="text-sm text-gray-500">{{ $recruiter->location?->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-400 mb-3">{{ $recruiter->category?->name ?? 'N/A' }}</p>

                            <!-- Rating -->
                            <div class="flex justify-center items-center text-yellow-400 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"
                                    class="w-5 h-5 mr-1">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.26 3.89a1 1 0 00.95.69h4.1c.969 0 1.371 1.24.588 1.81l-3.32 2.41a1 1 0 00-.364 1.118l1.26 3.89c.3.921-.755 1.688-1.54 1.118l-3.32-2.41a1 1 0 00-1.176 0l-3.32 2.41c-.785.57-1.84-.197-1.54-1.118l1.26-3.89a1 1 0 00-.364-1.118l-3.32-2.41c-.783-.57-.38-1.81.588-1.81h4.1a1 1 0 00.95-.69l1.26-3.89z" />
                                </svg>
                                <span>{{ number_format($recruiter->rating, 1) }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-500">No recruiters found.</p>
                    @endforelse
                </div>
            </div>

            <div style="display: flex; justify-content: center;">
                {{ $recruiters->appends(request()->query())->links('vendor.pagination.custom-tailwind') }}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        function updateQueryParam(param, value) {
            const url = new URL(window.location.href);

            if (value) {
                url.searchParams.set(param, value);
            } else {
                url.searchParams.delete(param);
            }

            url.searchParams.delete('page');
            window.location.href = url.toString();
        }

        const locationOptions = @json($locationOptions);
        const categoryOptions = @json($categoryOptions);

        const stateCityInput = document.getElementById("stateCityInput");
        const stateCityIdInput = document.getElementById("stateCityIdInput");
        const stateCitySuggestionBox = document.getElementById("stateCitySuggestionBox");

        const categoryInput = document.getElementById("categoryInput");
        const categoryIdInput = document.getElementById("categoryIdInput");
        const categorySuggestionBox = document.getElementById("categorySuggestionBox");

        // Function to set input from URL parameter
        function setLocationFromUrl() {
            const params = new URLSearchParams(window.location.search);
            const stateCityId = params.get('state_city'); // e.g., "43,230"
            const categoryId = params.get('category'); // e.g., "5"

            if (stateCityId && locationOptions[stateCityId]) {
                stateCityInput.value = locationOptions[stateCityId];
                stateCityIdInput.value = stateCityId;
            }

            if (categoryId && categoryOptions[categoryId]) {
                categoryInput.value = categoryOptions[categoryId];
                categoryIdInput.value = categoryId;
            }
        }

        // Call on page load
        setLocationFromUrl();

        stateCityInput.addEventListener("input", function() {
            const query = this.value.toLowerCase().trim();
            stateCitySuggestionBox.innerHTML = "";
            stateCityIdInput.value = "";

            if (!query) {
                stateCitySuggestionBox.style.display = "none";
                return;
            }

            // Filter by value (City, State)
            const filtered = Object.entries(locationOptions).filter(([key, value]) =>
                value.toLowerCase().includes(query)
            );

            if (filtered.length === 0) {
                stateCitySuggestionBox.style.display = "none";
                return;
            }

            filtered.forEach(([key, value]) => {
                const div = document.createElement("div");
                div.classList.add("suggestion-item");
                div.textContent = value;
                div.style.cursor = "pointer";
                div.onclick = function() {
                    stateCityInput.value = value;
                    stateCityIdInput.value = key;
                    stateCitySuggestionBox.style.display = "none";
                };
                stateCitySuggestionBox.appendChild(div);
            });

            stateCitySuggestionBox.style.display = "block";
        });

        categoryInput.addEventListener("input", function() {
            const query = this.value.toLowerCase().trim();
            categorySuggestionBox.innerHTML = "";
            categoryIdInput.value = "";

            if (!query) {
                categorySuggestionBox.style.display = "none";
                return;
            }

            // Filter results
            const filtered = Object.entries(categoryOptions).filter(([key, value]) =>
                value.toLowerCase().includes(query)
            );

            if (filtered.length === 0) {
                categorySuggestionBox.style.display = "none";
                return;
            }

            // Show suggestions
            filtered.forEach(([key, value]) => {
                const div = document.createElement("div");
                div.classList.add("suggestion-item");
                div.textContent = value;
                div.style.cursor = "pointer";
                div.onclick = function() {
                    categoryInput.value = value;
                    categoryIdInput.value = key;
                    categorySuggestionBox.style.display = "none";
                };
                categorySuggestionBox.appendChild(div);
            });

            categorySuggestionBox.style.display = "block";
        });

        // Hide suggestions on outside click
        document.addEventListener("click", (e) => {
            if (!document.querySelector(".dropdown-search-wrapper").contains(e.target)) {
                stateCitySuggestionBox.style.display = "none";
                categorySuggestionBox.style.display = "none";
            }
        });

        // Clear input if user didn't select a suggestion
        stateCityInput.addEventListener("blur", function() {
            setTimeout(() => {
                if (!stateCityIdInput.value) {
                    stateCityInput.value = "";
                }
                stateCitySuggestionBox.style.display = "none";
            }, 200);
        });

        categoryInput.addEventListener("blur", function() {
            setTimeout(() => {
                if (!categoryIdInput.value) {
                    categoryInput.value = "";
                }
                categorySuggestionBox.style.display = "none";
            }, 200);
        });
    </script>
</body>

</html>
