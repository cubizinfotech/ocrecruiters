<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Resume - Ocrecruiters</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <style>
            [x-cloak] { display: none !important; }
        </style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .site-footer {
                background: #fff; /* dark gray */
                color: #000; /* light gray text */
                text-align: center;
                padding-top: 50px;
                padding-bottom: 50px;
                margin-top: auto; /* pushes footer to bottom */
                border-top: 1px solid #e5e7eb; /* subtle top border */
            }

            .footer-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 16px;
                font-size: 14px;
            }

            /* Responsive tweak */
            @media (max-width: 640px) {
                .footer-container {
                    font-size: 13px;
                    padding: 8px 12px;
                }
            }
            .hover-shadow {
                transition: all 0.3s ease-in-out;
            }
            .hover-shadow:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
            }

        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">

        <div class="bg-gray-50 min-h-screen">

            <!-- Banner -->
            {{-- <div class="relative w-full h-64 md:h-80 rounded-b-lg overflow-hidden">
                <img src="{{ asset('logos/sample11.jpg') }}" alt="Banner"
                    class="object-cover w-full h-full">
            </div> --}}

            <div class="relative w-full h-64 md:h-80 rounded-b-lg overflow-hidden">
                <img src="{{ $recruiter->resume
                            ? asset('storage/' . $recruiter->resume->banner_path)
                            : asset('logos/sample11.jpg') }}"
                    alt="Banner"
                    class="object-cover w-full h-full">
            </div>

            <!-- Profile Section -->
          <div class="max-w-7xl mx-auto px-4 -mt-16 relative z-10">
                    <div class="bg-white shadow-md rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-4">

                        <!-- Left: Logo -->
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $recruiter->logo) }}" alt="Recruiter Logo" width="120" height="120">
                        </div>

                        <!-- Center: Slogan -->
                        @if (!empty($recruiter->slogan))
                            <div class="flex-1 text-center">
                                <p class="text-gray-800 text-lg font-bold italic tracking-wide">
                                    “{{ $recruiter->slogan }}”
                                </p>
                            </div>
                        @endif

                        <!-- Right: Buttons -->
                        <div style="" class="flex items-center gap-3" x-data="{ fileOpen: false, aboutOpen: false, showContact: false }">

                            @if ($recruiter->resume)
                                <div x-data="{ fileOpen: false }" x-cloak class="relative">
                                   <!--
                                    <button @click="fileOpen = true"
                                        class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-100">
                                        View File
                                    </button>
                                    -->

                                    <!-- File Modal -->
                                    <div x-show="fileOpen"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:leave="transition ease-in duration-200"
                                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                                        <div @click.away="fileOpen = false"
                                            class="bg-white rounded-xl shadow-2xl w-full max-w-3xl p-6 relative">

                                            <button @click="fileOpen = false"
                                                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">
                                                ✕
                                            </button>

                                            <h2 class="text-xl font-semibold text-gray-800 mb-4">File Preview</h2>

                                            <div class="overflow-y-auto max-h-[80vh]">
                                                @if (strtolower(pathinfo($recruiter->resume?->file_path, PATHINFO_EXTENSION)) === 'pdf')
                                                    <iframe src="{{ asset('storage/' . $recruiter->resume->file_path) }}"
                                                        class="w-full h-[500px] border rounded-lg"></iframe>
                                                @elseif (in_array(strtolower(pathinfo($recruiter->resume?->file_path, PATHINFO_EXTENSION)), ['jpg','jpeg','png','gif','webp']))
                                                    <img src="{{ asset('storage/' . $recruiter->resume->file_path) }}"
                                                        alt="Preview"
                                                        class="w-full max-h-[500px] object-contain rounded-lg shadow-md">
                                                @else
                                                    <p class="text-gray-600">
                                                        This file type cannot be previewed.
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($recruiter->resume)
                                <a class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2" href="{{ $recruiter->resume->linkedin }}" target="_blank">
                                    View LinkedIn
                                </a>
                            @endif
                            <!--
                            <button @click="aboutOpen = true"
                                class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-100">
                                About Us
                            </button>
                            -->

                            <!-- About Us Modal -->
                            <div x-show="aboutOpen"
                                x-cloak
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div @click.away="aboutOpen = false"
                                    class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
                                    <button @click="aboutOpen = false"
                                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                                        ✕
                                    </button>
                                    <h2 class="text-lg font-semibold text-gray-800 mb-3">
                                        About {{ $recruiter->resume->first_name ?? 'Recruiter' }}
                                    </h2>

                                    <div class="text-gray-700 text-sm leading-relaxed prose max-w-none">
                                        {!! $recruiter->resume
                                            ? $recruiter->resume->summary
                                            : '<p>No summary information available yet.</p>' !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Button -->
                            <div class="relative" @mouseenter="showContact = true" @mouseleave="showContact = false">
                                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5h2l3 9h11l3-9H3z"/>
                                    </svg>
                                    Contact Us
                                </button>

                                <div x-show="showContact" x-cloak
                                    class="absolute right-0 mt-2 w-56 bg-white text-gray-800 text-sm rounded-lg shadow-lg border p-3">
                                    <p><strong>Email:</strong> {{ $recruiter->resume->email ?? 'Not provided' }}</p>
                                    <p><strong>Phone:</strong> {{ $recruiter->resume->phone ?? 'Not available' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <!-- Content Section -->
            <div class="max-w-7xl mx-auto px-4 mt-10 grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left: About Recruiter -->
                <div class="lg:col-span-2 space-y-6">
                      <div class="bg-white xshadow-md rounded-2xl p-6 border border-gray-100 hover:xshadow-lg transition duration-300">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">
                                        {{ trim(($recruiter->resume->first_name ?? '') . ' ' . ($recruiter->resume->last_name ?? '')) ?: 'No Name Provided' }}
                                    </h1>

                                    <div class="flex items-center gap-2 mt-2 text-sm text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 11c0-2.21 1.79-4 4-4s4 1.79 4 4a4 4 0 01-4 4v5H8v-5a4 4 0 014-4z"/>
                                        </svg>
                                        <span>
                                            {{ $recruiter->city_name ?? '—' }},
                                            {{ $recruiter->state_name ?? '—' }}
                                            <span class="text-gray-400">|</span>
                                            {{ $recruiter->location?->name ?? 'Unknown Location' }}
                                            {{ $recruiter->state_name ?? '—' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Optional recruiter logo --}}
                               <!-- @if(!empty($recruiter->logo))

                                    <div class="w-16 h-16 flex items-center justify-center bg-gray-50 border border-gray-200 rounded-full overflow-hidden shadow-sm">
                                        <img src="{{ asset('storage/'.$recruiter->logo) }}" alt="Logo"
                                            class="w-full h-full object-cover object-center transition-transform duration-300 hover:scale-105">
                                    </div>
                                @endif-->
                            </div>

                            <div style="display:none" class="prose prose-sm max-w-none text-gray-700 leading-relaxed mt-3">
                                @if(!empty($recruiter->resume->summary))
                                    {!! $recruiter->resume->summary !!}
                                @else
                                    <p class="italic text-gray-400">No summary information available yet.</p>
                                @endif
                            </div>
                        </div>
                    <div style="" class="bg-white shadow-sm rounded-xl p-6">
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Professional Summary</h3>
                        <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                            {!! $recruiter->resume
                                        ? $recruiter->resume->summary
                                        : '<p>No summary information available yet.</p>' !!}
                        </p>
                    </div>

                    @if(!empty($recruiter->resume?->experience))
                        @php
                            $experience = json_decode($recruiter->resume->experience, true) ?? [];
                        @endphp
                        @if(count($experience))
                            <div class="bg-white shadow-sm rounded-xl p-6">
                                <h3 class="text-lg font-semibold mb-2 text-gray-800">Work Experience</h3>
                                <ul class="list-disc pl-6 text-gray-700 space-y-2">
                                    @foreach ($experience as $exp)
                                        <li>
                                            <strong>{{ $exp['position'] ?? 'Position Unknown' }}</strong>
                                            @if(!empty($exp['company'])) at {{ $exp['company'] }} @endif
                                            <br>
                                            <small class="text-gray-500">
                                                {{ $exp['start_date'] ?? '' }} to {{ $exp['end_date'] ?? 'Present' }}
                                            </small>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endif

                    <!-- Education -->
                    @if(!empty($recruiter->resume?->education))
                        @php
                            $education = json_decode($recruiter->resume->education, true) ?? [];
                        @endphp
                        @if(count($education))
                            <div class="bg-white shadow-sm rounded-xl p-6">
                                <h3 class="text-lg font-semibold mb-2 text-gray-800">Education</h3>
                                <ul class="list-disc pl-6 text-gray-700 space-y-2">
                                    @foreach ($education as $edu)
                                        <li>
                                            <strong>{{ $edu['degree'] ?? 'Degree Unknown' }}</strong>
                                            - {{ $edu['school'] ?? 'School Unknown' }}
                                            <br>
                                            <small class="text-gray-500">{{ $edu['year'] ?? '' }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endif

                    <!-- Certifications -->
                    @if(!empty($recruiter->resume?->certifications))
                        @php
                            $certifications = json_decode($recruiter->resume->certifications, true) ?? [];
                        @endphp
                        @if(count($certifications))
                            <div class="bg-white shadow-sm rounded-xl p-6">
                                <h3 class="text-lg font-semibold mb-2 text-gray-800">Certifications</h3>
                                <ul class="list-disc pl-6 text-gray-700 space-y-2">
                                    @foreach ($certifications as $cert)
                                        <li>
                                            <strong>{{ $cert['certificate'] ?? 'Certificate Name' }}</strong>
                                            <span class="text-gray-500">({{ $cert['field'] ?? 'Field' }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endif

                    @if(!empty($recruiter->resume?->skills))
                        @php
                            $skills = json_decode($recruiter->resume->skills, true) ?? [];
                        @endphp
                        @if(count($skills))
                            <div class="bg-white shadow-sm rounded-xl p-6">
                                <h3 class="text-lg font-semibold mb-2 text-gray-800">Skills</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($skills as $skill)
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                            {{ $skill }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>

                <!-- Right: Sidebar -->
                <div>
                    <div class="bg-white shadow-md rounded-xl p-6 space-y-4">
                        <div>
                            <h3 class="font-semibold text-gray-800">
                                {{ trim(($recruiter->resume->first_name ?? '') . ' ' . ($recruiter->resume->last_name ?? '')) ?: 'Unknown' }}
                            </h3>
                            <p class="text-sm text-gray-500">{{ $recruiter->location?->name ?? 'N/A' }}</p>
                        </div>

                        <!-- Map -->
                        <div class="mt-6 bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                            <div class="px-5 pt-4 pb-2 flex items-center justify-between">
                                <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a8 8 0 1111.314-11.314z"/>
                                    </svg>
                                    Recruiter Location
                                </h2>
                                <span class="text-sm text-gray-500">
                                    {{ $recruiter->city_name ?? '—' }}, {{ $recruiter->state_name ?? '—' }}
                                </span>
                            </div>

                            <div class="relative">
                                <iframe
                                    src="https://maps.google.com/maps?q={{ urlencode(($recruiter->city_name ?? '') . ',' . ($recruiter->state_name ?? 'India')) }}&output=embed"
                                    class="w-full h-56 md:h-64 rounded-b-2xl border-t border-gray-200"></iframe>

                                {{-- Subtle overlay gradient for style --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-white/5 to-transparent pointer-events-none rounded-b-2xl"></div>
                            </div>
                        </div>


                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-gradient-to-br from-white via-gray-50 to-gray-100 border border-gray-200 rounded-2xl p-6 shadow-sm">

                            {{-- Category --}}
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-indigo-100 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">Category</p>
                                    <p class="text-gray-800 font-medium">{{ $recruiter->category?->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            {{-- Location --}}
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-emerald-100 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 11c0-2.21 1.79-4 4-4s4 1.79 4 4a4 4 0 01-4 4v5H8v-5a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">Location</p>
                                    <p class="text-gray-800 font-medium">{{ $recruiter->location?->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            {{-- State --}}
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-blue-100 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5h18M9 3v2m6-2v2M4 21h16M4 10h16M4 14h16"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">State</p>
                                    <p class="text-gray-800 font-medium">{{ $recruiter->state?->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            {{-- City --}}
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-pink-100 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 2l9 4-9 4-9-4 9-4zm0 6v14"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">City</p>
                                    <p class="text-gray-800 font-medium">{{ $recruiter->city?->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- info -->
                   @if(!empty($recruiter->info))
                        <div class="mt-3 bg-white shadow-md rounded-xl p-6 space-y-4 text-center">
                       <p class="text-gray-700 text-sm mt-2 leading-relaxed">
                            {{ $recruiter->info }}
                        </p>
                       </div>
                   @endif
                </div>
            </div>

        </div>

        <footer class="site-footer flex item-start">
            <div class="footer-container">
                <p>Copyright © {{ date('Y') }}. Ocrecruiters — All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
