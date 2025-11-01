@extends('layouts.backend')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Update account details</h1>
        <p class="text-muted">Ensure your account is using a long, random password to stay secure.</p>
    </div>
    {{-- <a href="{{ route('recruiters.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Recruiters
    </a> --}}
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
                class="form-control @error('name') is-invalid @enderror">
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          {{-- Category --}}
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
            <div class="col-sm-4">
              <select name="category_id" class="form-select category_select select2 @error('category_id') is-invalid @enderror">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}" {{ old('category_id', $recruiter->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                  </option>
                @endforeach
              </select>
              @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>

          {{-- Location --}}
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Location <span class="text-danger">*</span></label>
            <div class="col-sm-4">
              <select name="location_id" class="form-select location_select select2 @error('location_id') is-invalid @enderror">
                <option value="">Select Location</option>
                @foreach($locations as $loc)
                  <option value="{{ $loc->id }}" {{ old('location_id', $recruiter->location_id ?? '') == $loc->id ? 'selected' : '' }}>
                    {{ $loc->name }}
                  </option>
                @endforeach
              </select>
              @error('location_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-4">
                <select name="state_id" id="state_id"
                    class="form-select state_select select2 @error('state_id') is-invalid @enderror">
                    <option value="">Select State</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}"
                            {{ old('state_id', $recruiter->state_id ?? '') == $state->id ? 'selected' : '' }}>
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>
                @error('state_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-4">
                <select name="city_id" id="city_id"
                    class="form-select city_select select2 @error('city_id') is-invalid @enderror">
                    <option value="">Select City</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}"
                            {{ old('city_id', $recruiter->city_id ?? '') == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
                @error('city_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

          {{-- Rating --}}
        {{-- <div class="row mb-3">
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
        </div> --}}

          {{-- Logo Upload --}}
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Logo</label>
            <div class="col-sm-4">
              <input type="file" name="logo" id="logo_file" accept="image/*"
                     class="form-control @error('logo') is-invalid @enderror">
              @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror

              {{-- Live Preview --}}
              <div id="logo_preview" class="mt-2" style="display:none;">
                <img id="logo_preview_img" src="#" alt="Logo Preview" width="100" height="100" class="rounded border">
              </div>

              {{-- Existing logo --}}
              @if(!empty($recruiter->logo))
                <div class="mt-2">
                  <img src="{{ asset('storage/' . $recruiter->logo) }}" width="100" height="100" class="rounded border">
                </div>
              @endif
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
                                class="form-control @error('current_password') is-invalid @enderror">
                            {{-- @error('current_password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">
                            New Password <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-3">
                            <input type="password" id="password" name="password" 
                                class="form-control @error('password') is-invalid @enderror">
                            {{-- @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password_confirmation" class="col-sm-2 col-form-label">
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-3">
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                class="form-control @error('password_confirmation') is-invalid @enderror">
                            {{-- @error('password_confirmation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror --}}
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
$(function () {
    $('.category_select').select2({
      placeholder: 'Search category...',
      minimumInputLength: 1,
      ajax: {
          url: '{{ route('categories.ajax') }}',
          dataType: 'json',
          delay: 250,
          data: function (params) {
              return {
                  q: params.term
              };
          },
          processResults: function (data) {
              return {
                  results: data.data.map(function (item) {
                      return { id: item.id, text: item.name };
                  })
              };
          },
          cache: true
        }
    });
  
    $('.location_select').select2({
        placeholder: 'Search location...',
        minimumInputLength: 1,
        ajax: {
            url: '{{ route('location.ajax') }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data.data.map(function (item) {
                        return { id: item.id, text: item.name };
                    })
                };
            },
            cache: true
        }
      });

      $('.state_select').select2({
        placeholder: 'Search state...',
        minimumInputLength: 1,
        ajax: {
            url: '{{ route('state.ajax') }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data.data.map(function (item) {
                        return { id: item.id, text: item.name };
                    })
                };
            },
            cache: true
        }
      });

      $('.city_select').select2({
        placeholder: 'Search city...',
        minimumInputLength: 1,
        ajax: {
            url: '{{ route('city.ajax') }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              const stateId = $('#state_id').val();
                return {
                    q: params.term,
                    state_id: stateId
                };
            },
            processResults: function (data) {
                return {
                    results: data.data.map(function (item) {
                        return { id: item.id, text: item.name };
                    })
                };
            },
            cache: true
        }
      });

      $('.city_select').on('select2:opening select2:open', function (e) {
        const stateId = $('#state_id').val();
        if (!stateId) {
            alert('Please select a state first.');
            e.preventDefault(); // stop dropdown from opening
            return false;
        }
    });

    // $('#state_id').on('change', function () {
    //     let stateId = $(this).val();
    //     let citySelect = $('#city_id');
    //     citySelect.html('<option value="">Loading...</option>');

    //     if (stateId) {
    //         $.ajax({
    //             url: "{{ route('get.cities') }}",
    //             type: "GET",
    //             data: { state_id: stateId },
    //             success: function (data) {
    //                 let options = '<option value="">Select City</option>';
    //                 data.forEach(city => {
    //                     options += `<option value="${city.id}">${city.name}</option>`;
    //                 });
    //                 citySelect.html(options).trigger('change');
    //             },
    //             error: function () {
    //                 citySelect.html('<option value="">Error loading cities</option>');
    //             }
    //         });
    //     } else {
    //         citySelect.html('<option value="">Select City</option>');
    //     }
    // });
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
{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
}); --}}
</script>

@endsection