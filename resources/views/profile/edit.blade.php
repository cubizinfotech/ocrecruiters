@extends('layouts.backend')

@section('styles')
    <style>
        .dropdown-search-wrapper .suggestions-box {
            max-height: 200px;
            overflow-y: auto;
        }

        .dropdown-search-wrapper .suggestion-item {
            padding: 8px 12px;
        }

        .dropdown-search-wrapper .suggestion-item:hover {
            background-color: #f1f1f1;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Update account details</h1>
            <p class="text-muted">Ensure your account is using a long, random password to stay secure.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recruiter Profile</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('recruiters.update') }}" enctype="multipart/form-data"
                        class="bg-white shadow-md rounded-2xl p-8 max-w-3xl mx-auto">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="name" value="{{ old('name', $recruiter->name ?? '') }}"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <div class="dropdown-search-wrapper" style="position: relative; align-items: center; width: 100%;">
                                    <input type="text" id="categoryInput" class="form-control @error('category_id') is-invalid @enderror" name="category"
                                        placeholder="Search category..." autocomplete="off" value="{{ old('category', $recruiter->category->name ?? '') }}"
                                        >
                                    <input type="hidden" name="category_id" id="categoryIdInput" value="{{ old('category_id', $recruiter->category_id ?? '') }}">
                                    <div id="categorySuggestionBox" class="suggestions-box"
                                        style="display: none; position: absolute; top: 100%; left: 0; right: 0; z-index: 1000; background: #fff; border: 1px solid #ccc;">
                                    </div>
                                    @error('category_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="row mb-3 d-none">
                            <label class="col-sm-2 col-form-label">Location <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <select name="location_id"
                                    class="form-select location_select select2 @error('location_id') is-invalid @enderror">
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $loc)
                                        <option value="{{ $loc->id }}"
                                            {{ (old('location_id', $recruiter->location_id ?? '') == $loc->id || strtolower(trim($loc->name)) == 'usa') ? 'selected' : '' }}>
                                            {{ $loc->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">State</label>
                            <div class="col-sm-4">
                                <div class="dropdown-search-wrapper" style="position: relative; align-items: center; width: 100%;">
                                    <input type="text" id="stateInput" class="form-control @error('state_id') is-invalid @enderror" name="state"
                                        placeholder="Search state..." autocomplete="off" value="{{ old('state', $recruiter->state->name ?? '') }}"
                                        >
                                    <input type="hidden" name="state_id" id="stateIdInput" value="{{ old('state_id', $recruiter->state_id ?? '') }}">
                                    <div id="stateSuggestionBox" class="suggestions-box"
                                        style="display: none; position: absolute; top: 100%; left: 0; right: 0; z-index: 1000; background: #fff; border: 1px solid #ccc;">
                                    </div>
                                    @error('state_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-4">
                                <div class="dropdown-search-wrapper" style="position: relative; align-items: center; width: 100%;">
                                    <input type="text" id="cityInput" class="form-control @error('city_id') is-invalid @enderror" name="city"
                                        placeholder="Search city..." autocomplete="off" value="{{ old('city', $recruiter->city->name ?? '') }}"
                                        >
                                    <input type="hidden" name="city_id" id="cityIdInput" value="{{ old('city_id', $recruiter->city_id ?? '') }}">
                                    <div id="citySuggestionBox" class="suggestions-box"
                                        style="display: none; position: absolute; top: 100%; left: 0; right: 0; z-index: 1000; background: #fff; border: 1px solid #ccc;">
                                    </div>
                                    @error('city_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Rating --}}
                        {{--
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Rating</label>
                            <div class="col-sm-4 d-flex align-items-center gap-2">
                                <div class="star-rating" style="font-size: 1.5rem; color: #ffc107;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa{{ $recruiter && $recruiter->rating >= $i ? 's' : 'r' }} fa-star"
                                        data-value="{{ $i }}" style="cursor:pointer;"></i>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating" value="{{ old('rating', $recruiter->rating ?? 0) }}">
                            </div>
                        </div>
                        --}}

                        {{-- Logo Upload --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Logo</label>
                            <div class="col-sm-4">
                                <input type="file" name="logo" id="logo_file" accept="image/*"
                                    class="form-control @error('logo') is-invalid @enderror">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="d-flex">
                                    {{-- Live Preview --}}
                                    <div id="logo_preview" class="mt-2" style="display: none; margin-right: 10px;">
                                        <img id="logo_preview_img" src="#" alt="Logo Preview" width="100" height="100" class="rounded border">
                                    </div>

                                    {{-- Existing logo --}}
                                    @if (!empty($recruiter->logo))
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $recruiter->logo) }}" width="100" height="100" class="rounded border">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Password</h6>
                </div>
                <div class="card-body">
                    <form id="passwordForm" method="POST" action="{{ route('password.update') }}"
                        class="bg-white shadow-md rounded-2xl p-8 max-w-3xl mx-auto mt-10">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="current_password" class="col-sm-2 col-form-label">
                                Current Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-3">
                                <input type="password" id="current_password" name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password...">
                                {{--
                                @error('current_password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-form-label">
                                New Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-3">
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password...">
                                {{--
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">
                                Confirm Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-3">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter confirm password...">
                                {{--
                                @error('password_confirmation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                --}}
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        const categoryOptions = @json($categoryOptions);
        const categoryInput = document.getElementById("categoryInput");
        const categoryIdInput = document.getElementById("categoryIdInput");
        const categorySuggestionBox = document.getElementById("categorySuggestionBox");

        categoryInput.addEventListener("input", function() {
            const query = this.value.toLowerCase().trim();
            categorySuggestionBox.innerHTML = "";
            categoryIdInput.value = "";
            $(categoryInput).removeClass('is-invalid');
            $(categoryInput).find('.invalid-feedback').remove();

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

        const stateOptions = @json($stateOptions); // [{id, name}]
        const cityOptions = @json($citiyOptions); // [{id, state_id, name}]

        const stateInput = document.getElementById("stateInput");
        const stateIdInput = document.getElementById("stateIdInput");
        const stateSuggestionBox = document.getElementById("stateSuggestionBox");

        const cityInput = document.getElementById("cityInput");
        const cityIdInput = document.getElementById("cityIdInput");
        const citySuggestionBox = document.getElementById("citySuggestionBox");

        // ---------- Utility function ----------
        function createSuggestionBox(input, hiddenInput, suggestionBox, items, onSelect) {
            suggestionBox.innerHTML = "";
            const query = input.value.toLowerCase().trim();

            if (!query) {
                suggestionBox.style.display = "none";
                return;
            }

            const filtered = items.filter(item => item.name.toLowerCase().includes(query));
            if (filtered.length === 0) {
                suggestionBox.style.display = "none";
                return;
            }

            filtered.forEach(item => {
                const div = document.createElement("div");
                div.classList.add("suggestion-item");
                div.textContent = item.name;
                div.style.cursor = "pointer";
                div.onclick = function() {
                    input.value = item.name;
                    hiddenInput.value = item.id;
                    suggestionBox.style.display = "none";
                    if (onSelect) onSelect(item);
                };
                suggestionBox.appendChild(div);
            });

            suggestionBox.style.display = "block";
        }

        // ---------- STATE AUTOCOMPLETE ----------
        stateInput.addEventListener("input", function() {
            stateIdInput.value = "";
            $(stateInput).removeClass('is-invalid');
            $(stateInput).siblings('.invalid-feedback').remove();

            createSuggestionBox(
                stateInput,
                stateIdInput,
                stateSuggestionBox,
                stateOptions,
                (selectedState) => {
                    // Clear city if state changes
                    cityInput.value = "";
                    cityIdInput.value = "";
                }
            );
        });

        // ---------- CITY AUTOCOMPLETE ----------
        cityInput.addEventListener("input", function() {
            cityIdInput.value = "";
            $(cityInput).removeClass('is-invalid');
            $(cityInput).siblings('.invalid-feedback').remove();

            // If a state is selected, filter cities within that state
            let filteredCities = cityOptions;
            const selectedStateId = stateIdInput.value;
            if (selectedStateId) {
                filteredCities = cityOptions.filter(city => city.state_id == selectedStateId);
            }

            createSuggestionBox(
                cityInput,
                cityIdInput,
                citySuggestionBox,
                filteredCities,
                (selectedCity) => {
                    // Auto-fill state if user selects city first
                    const foundState = stateOptions.find(s => s.id === selectedCity.state_id);
                    if (foundState) {
                        stateInput.value = foundState.name;
                        stateIdInput.value = foundState.id;
                    }
                }
            );
        });

        // Hide suggestions on outside click
        document.addEventListener("click", (e) => {
            if (!document.querySelector(".dropdown-search-wrapper").contains(e.target)) {
                categorySuggestionBox.style.display = "none";
                stateSuggestionBox.style.display = "none";
                citySuggestionBox.style.display = "none";
            }
        });

        // Clear input if user didn't select a suggestion
        categoryInput.addEventListener("blur", function() {
            setTimeout(() => {
                if (!categoryIdInput.value) {
                    categoryInput.value = "";
                }
                categorySuggestionBox.style.display = "none";
            }, 200);
        });

        stateInput.addEventListener("blur", function() {
            setTimeout(() => {
                if (!stateIdInput.value) {
                    stateInput.value = "";
                }
                stateSuggestionBox.style.display = "none";
            }, 200);
        });

        cityInput.addEventListener("blur", function() {
            setTimeout(() => {
                if (!cityIdInput.value) {
                    cityInput.value = "";
                }
                citySuggestionBox.style.display = "none";
            }, 200);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('logo_file');
            const previewDiv = document.getElementById('logo_preview');
            const img = document.getElementById('logo_preview_img');

            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        img.src = evt.target.result;
                        previewDiv.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewDiv.style.display = 'none';
                }
            });

            const stars = document.querySelectorAll(".star-rating i");
            const ratingInput = document.getElementById("rating");

            stars.forEach(star => {
                star.addEventListener("click", function() {
                    const value = this.getAttribute("data-value");
                    ratingInput.value = value;

                    stars.forEach(s => {
                        if (s.getAttribute("data-value") <= value) {
                            s.classList.remove("far");
                            s.classList.add("fas");
                        } else {
                            s.classList.remove("fas");
                            s.classList.add("far");
                        }
                    });
                });
            });
        });
    </script>

    {{--
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#passwordForm').validate({
                rules: {
                    current_password: {
                        required: true,
                        minlength: 6
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    current_password: {
                        required: "Please enter your current password",
                        minlength: "Password must be at least 6 characters long"
                    },
                    password: {
                        required: "Please enter a new password",
                        minlength: "New password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    }
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger small mt-1');
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    --}}
@endsection
