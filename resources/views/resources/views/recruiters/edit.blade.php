@extends('layouts.backend')

@section('title', 'Edit Resume')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Edit Resume</h1>
        <p class="text-muted">Update resume information</p>
    </div>
    {{-- <a href="{{ route('recruiters.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Recruiters
    </a> --}}
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Resume</h6>
            </div>
            <div class="card-body">
                <div class="container py-5">
                    <form action="{{ route('resume.save') }}" method="POST" enctype="multipart/form-data" id="resumeForm" novalidate>
                        @csrf
                        {{-- @if(isset($resume))
                            @method('PUT')
                        @endif --}}

                        <div class="row">
                            <!-- Left Tabs -->
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-personal-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-personal" type="button" role="tab"
                                        aria-controls="v-pills-personal" aria-selected="true">
                                        Personal Details
                                    </button>
                                    <button class="nav-link" id="v-pills-professional-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-professional" type="button" role="tab"
                                        aria-controls="v-pills-professional" aria-selected="false">
                                        Professional Summary
                                    </button>
                                    <button class="nav-link" id="v-pills-work-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-work" type="button" role="tab"
                                        aria-controls="v-pills-work" aria-selected="false">
                                        Work History
                                    </button>
                                    <button class="nav-link" id="v-pills-edu-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-edu" type="button" role="tab"
                                        aria-controls="v-pills-edu" aria-selected="false">
                                        Education
                                    </button>
                                    <button class="nav-link" id="v-pills-cert-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-cert" type="button" role="tab"
                                        aria-controls="v-pills-cert" aria-selected="false">
                                        Certifications
                                    </button>
                                    <button class="nav-link" id="v-pills-skill-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-skill" type="button" role="tab"
                                        aria-controls="v-pills-skill" aria-selected="false">
                                        Skills
                                    </button>
                                    <button class="nav-link" id="v-pills-files-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-files" type="button" role="tab"
                                        aria-controls="v-pills-files" aria-selected="false">
                                        Upload files
                                    </button>
                                </div>
                            </div>

                            <!-- Right Content -->
                            <div class="col-md-9">
                                <div class="tab-content" id="v-pills-tabContent">

                                   
                                    <div class="tab-pane fade show active" id="v-pills-personal" role="tabpanel"
                                        aria-labelledby="v-pills-personal-tab">
                                        <div class="card border-0 shadow-sm p-4">
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="first_name" class="form-control" required  value="{{ old('first_name', $resume->first_name ?? '') }}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Last Name <span class="text-danger">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="last_name" class="form-control" required value="{{ old('last_name', $resume->last_name ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="email" name="email" class="form-control" required value="{{ old('email', $resume->email ?? '') }}">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Phone <span class="text-danger">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="number" name="phone" class="form-control" required value="{{ old('phone', $resume->phone ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Address <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <textarea name="address" rows="3" class="form-control" required>{{ old('address', $resume->address ?? '') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                  
                                    <div class="tab-pane fade" id="v-pills-professional" role="tabpanel"
                                        aria-labelledby="v-pills-professional-tab">
                                        <div class="card border-0 shadow-sm p-4">
                                            <label for="professional_summary" class="form-label">Professional Summary <span class="text-danger">*</span></label>
                                            <textarea name="summary" id="professional_summary" class="form-control" rows="20" required>{{ old('professional_summary', $resume->summary ?? '') }}</textarea>
                                        </div>
                                    </div>

                                  
                                    <div class="tab-pane fade" id="v-pills-work" role="tabpanel"
                                        aria-labelledby="v-pills-work-tab">
                                        <div class="card border-0 shadow-sm p-4">
                                            <div id="workHistoryContainer">
                                                <!-- Dynamic work history rows will go here -->
                                                @php
                                                    $workHistory = is_array($workHistory) ? $workHistory : json_decode($workHistory, true);
                                                    $workHistory = $workHistory ?: [];
                                                @endphp


                                                @foreach($workHistory as $i => $exp)
                                                    <div class="work-history-item border rounded p-3 mb-3">
                                                        <div class="row mb-2">
                                                            <div class="col-md-6 mb-2">
                                                                <label class="form-label">Position <span class="text-danger">*</span></label>
                                                                <input type="text" name="work[{{ $i }}][position]" value="{{ $exp['position'] ?? '' }}" class="form-control">
                                                            </div>
                                                            <div class="col-md-3 mb-2">
                                                                <label class="form-label">Start Date</label>
                                                                <input type="date" name="work[{{ $i }}][start_date]" value="{{ $exp['start_date'] ?? '' }}" class="form-control">
                                                            </div>
                                                            <div class="col-md-3 mb-2">
                                                                <label class="form-label">End Date</label>
                                                                <input type="date" name="work[{{ $i }}][end_date]" value="{{ $exp['end_date'] ?? '' }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-md-6 mb-2">
                                                                <label class="form-label">Company Name</label>
                                                                <input type="text" name="work[{{ $i }}][company_name]" value="{{ $exp['company_name'] ?? '' }}" class="form-control">
                                                            </div>
                                                            <div class="col-md-3 mb-2">
                                                                <label class="form-label" for="state_{{ $i }}">State</label>
                                                                {{-- <input type="text" name="work[{{ $i }}][company_state]" value="{{ $exp['company_state'] ?? '' }}" class="form-control"> --}}
                                                                <select name="work[{{ $i }}][company_state]" class="form-select state_select" id="state_{{ $i }}">
                                                                    @if(isset($exp['company_state']))
                                                                        @php
                                                                            $state = \App\Models\State::find($exp['company_state']);
                                                                        @endphp
                                                                        @if($state)
                                                                            <option value="{{ $state->id }}" selected>{{ $state->name }}</option>
                                                                        @endif
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 mb-2">
                                                                <label class="form-label" for="city_{{ $i }}">City</label>
                                                                {{-- <input type="text" name="work[{{ $i }}][company_city]" value="{{ $exp['company_city'] ?? '' }}" class="form-control"> --}}
                                                                <select name="work[{{ $i }}][company_city]" class="form-select city_select" id="city_{{ $i }}">
                                                                    @if(isset($exp['company_city']))
                                                                        @php
                                                                            $city = \App\Models\City::find($exp['company_city']);
                                                                        @endphp
                                                                        @if($city)
                                                                            <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                                        @endif
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Company Summary</label>
                                                            <textarea name="work[{{ $i }}][company_summary]" class="form-control work-summary">{{ $exp['company_summary'] ?? '' }}</textarea>
                                                        </div>
                                                            
                                                        <button type="button" class="btn btn-danger btn-sm remove-work">Remove</button>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <button type="button" id="addWorkHistory" class="btn btn-outline-primary btn-sm mt-3">
                                                + Add Work History
                                            </button>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="v-pills-edu" role="tabpanel"
                                        aria-labelledby="v-pills-edu-tab">
                                        <div class="card border-0 shadow-sm p-4">
                                            <div id="educationContainer">
                                                @php
                                                    $educationData = is_array($educationData) ? $educationData : json_decode($educationData, true);
                                                    $educationData = $educationData ?: [];
                                                @endphp

                                                @foreach($educationData as $i => $edu)
                                                    <div class="education-item border rounded p-3 mb-3 bg-light">
                                                        <div class="row g-2">
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label">Degree</label>
                                                                <input type="text" name="education[{{ $i }}][degree]" class="form-control"
                                                                    value="{{ $edu['degree'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label">Field of Study</label>
                                                                <input type="text" name="education[{{ $i }}][field]" class="form-control"
                                                                    value="{{ $edu['field'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label">School Name</label>
                                                                <input type="text" name="education[{{ $i }}][school]" class="form-control"
                                                                    value="{{ $edu['school'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label" for="edu_state_{{ $i }}">State</label>
                                                                <select name="education[{{ $i }}][state]" class="form-select state_select" id="edu_state_{{ $i }}">
                                                                    @if(isset($edu['state']))
                                                                        @php
                                                                            $state = \App\Models\State::find($edu['state']);
                                                                        @endphp
                                                                        @if($state)
                                                                            <option value="{{ $state->id }}" selected>{{ $state->name }}</option>
                                                                        @endif
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label" for="edu_city_{{ $i }}">City</label>
                                                                <select name="education[{{ $i }}][city]" class="form-select city_select" id="edu_city_{{ $i }}">
                                                                    @if(isset($edu['city']))
                                                                        @php
                                                                            $city = \App\Models\City::find($edu['city']);
                                                                        @endphp
                                                                        @if($city)
                                                                            <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                                        @endif
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-sm btn-danger removeEducation mt-2">Remove</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" id="addEducation" class="btn btn-outline-primary btn-sm mt-3">
                                                + Add Education
                                            </button>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="v-pills-cert" role="tabpanel"
                                        aria-labelledby="v-pills-cert-tab">
                                        <div class="card border-0 shadow-sm p-4">
                                            <div id="certificateContainer">
                                                @php
                                                    $certData = is_array($certData) ? $certData : json_decode($certData, true);
                                                    $certData = $certData ?: [];
                                                @endphp

                                                @foreach($certData as $i => $cer)
                                                    <div class="certifications-item border rounded p-3 mb-3 bg-light">
                                                        <div class="row g-2">
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label">Certifications</label>
                                                                <input type="text" name="certifications[{{ $i }}][cert]" class="form-control"
                                                                    value="{{ $cer['cert'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label">Field of Study</label>
                                                                <input type="text" name="certifications[{{ $i }}][field]" class="form-control"
                                                                    value="{{ $cer['field'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label">School Name</label>
                                                                <input type="text" name="certifications[{{ $i }}][school]" class="form-control"
                                                                    value="{{ $cer['school'] ?? '' }}">
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label" for="cert_state_{{ $i }}">State</label>
                                                                <select name="certifications[{{ $i }}][state]" class="form-select state_select" id="cert_state_{{ $i }}">
                                                                    @if(isset($cer['state']))
                                                                        @php
                                                                            $state = \App\Models\State::find($cer['state']);
                                                                        @endphp
                                                                        @if($state)
                                                                            <option value="{{ $state->id }}" selected>{{ $state->name }}</option>
                                                                        @endif
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label" for="cert_city_{{ $i }}">City</label>
                                                                <select name="certifications[{{ $i }}][city]" class="form-select city_select" id="cert_city_{{ $i }}">
                                                                    @if(isset($cer['city']))
                                                                        @php
                                                                            $city = \App\Models\City::find($cer['city']);
                                                                        @endphp
                                                                        @if($city)
                                                                            <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                                        @endif
                                                                    @endif
                                                                </select>
                                                            </div>
                                                           
                                                        </div>
                                                        <button type="button" class="btn btn-sm btn-danger removeCertifications mt-2">Remove</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" id="addCertifications" class="btn btn-outline-primary btn-sm mt-3">
                                                + Add Certifications
                                            </button>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="v-pills-skill" role="tabpanel"
                                        aria-labelledby="v-pills-skill-tab">
                                        <div class="card border-0 shadow-sm p-4">
                                            <div class="border rounded p-3 bg-light">
                                                <label for="skillInput" class="form-label">Add Skills</label>
                                                <div class="input-group">
                                                <input type="text" id="skillInput" class="form-control" placeholder="Type a skill and press Enter">
                                                <button type="button" id="addSkillBtn" class="btn btn-primary">Add</button>
                                                </div>
                                                <div id="skillsContainer" class="mt-3 d-flex flex-wrap gap-2">
                                                  
                                                    @php
                                                        $skillsData = $resume->skills ?? [];
                                                        $skills = is_array($skillsData) ? $skillsData : json_decode($skillsData, true);
                                                    @endphp

                                                    @foreach($skills as $skill)
                                                        <span class="badge bg-success text-white skill-tag">
                                                            {{ $skill }}
                                                            <button type="button" class="btn-close btn-close-white btn-sm ms-1 remove-skill" aria-label="Remove"></button>
                                                            <input type="hidden" name="skills[]" value="{{ $skill }}">
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="v-pills-files" role="tabpanel" aria-labelledby="v-pills-files-tab">
                                        <div class="mb-3">
                                            <label for="resume_file" class="form-label">Upload Resume</label>
                                            <input type="file" name="resume_file" id="resume_file"
                                                class="form-control @error('resume_file') is-invalid @enderror"
                                                accept=".pdf,.jpg,.jpeg,.png,.gif,.bmp,.webp">
                                            @error('resume_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        @if(!empty($resume->file_path))
                                            <a href="{{ asset('storage/' . $resume->file_path) }}"
                                                target="_blank"
                                                class="text-decoration-none ms-2 text-sm" style="float: right;">
                                                {{ $resume->original_file_name ?? basename($resume->file_path) }}
                                            </a>
                                        @endif

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Upload Logo (min: 100x100)</label>
                                            <input type="file" name="logo_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                                            <div id="logo_preview" class="mt-2" style="display:none;">
                                               <img id="logo_preview_img" src="#" alt="Logo Preview" width="100" height="100" class="rounded border">
                                               <span id="logo_preview_name" class="ms-2 small text-muted"></span>
                                           </div>
                                            @if(!empty($resume->logo_path))
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $resume->logo_path) }}" 
                                                        alt="Logo Preview" width="100" height="100" class="rounded border">
                                                    <a href="{{ asset('storage/' . $resume->logo_path) }}" target="_blank" class="ms-2">
                                                        {{ $resume->logo_original_name ?? basename($resume->logo_path) }}
                                                    </a>
                                                </div>
                                            @endif
                                            
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Upload Banner (min: 1200x400)</label>
                                            <input type="file" name="banner_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                                            <div id="banner_preview" class="mt-2" style="display:none;">
                                                <img id="banner_preview_img" src="#" alt="Banner Preview" width="300" height="100" class="rounded border">
                                                <span id="banner_preview_name" class="ms-2 small text-muted"></span>
                                            </div>
                                            @if(!empty($resume->banner_path))
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $resume->banner_path) }}" 
                                                        alt="Banner Preview" width="300" height="100" class="rounded border">
                                                    <a href="{{ asset('storage/' . $resume->banner_path) }}" target="_blank" class="ms-2">
                                                        {{ $resume->banner_original_name ?? basename($resume->banner_path) }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Save Changes
                            </button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

<script type="text/javascript">
    // Initialize CKEditor for professional summary
    ClassicEditor.create(document.querySelector('#professional_summary')).catch(console.error);

    function initStateSelect2(selector) {
        $(selector).select2({
            placeholder: 'Search state...',
            minimumInputLength: 1,
            width: '100%',
            ajax: {
                url: '{{ route('state.ajax') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { q: params.term };
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
    }

    function initCitySelect2(selector, stateSelector) {
        $(selector).select2({
            placeholder: 'Search city...',
            minimumInputLength: 1,
            width: '100%',
            ajax: {
                url: '{{ route('city.ajax') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    const stateId = $(stateSelector).val();
                    return { q: params.term, state_id: stateId };
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

        // Prevent opening city if state not selected
        $(selector).on('select2:opening select2:open', function (e) {
            const stateId = $(stateSelector).val();
            if (!stateId) {
                alert('Please select a state first.');
                e.preventDefault();
            }
        });
    }

    // Function to add a new work history block
    function addWorkHistoryRow() {
        const index = document.querySelectorAll('.work-history-item').length + 1;
        const template = `
        <div class="work-history-item border rounded p-3 mb-3">
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label">Position <span class="text-danger">*</span></label>
                    <input type="text" name="work[${index}][position]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="work[${index}][start_date]" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="work[${index}][end_date]" class="form-control">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="work[${index}][company_name]" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="state_${index}">State</label>
                    <select name="work[${index}][company_state]" class="form-select state_select" id="state_${index}">
                        
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="city_${index}">City</label>
                    <select name="work[${index}][company_city]" class="form-select city_select" id="city_${index}">
                        
                    </select>
                </div>
            </div>

            <div class="mb-2">
                <label class="form-label">Company Summary</label>
                <textarea name="work[${index}][company_summary]" class="form-control work-summary" rows="3"></textarea>
            </div>

            <button type="button" class="btn btn-sm btn-danger remove-work">Remove</button>
        </div>`;
        $('#workHistoryContainer').append(template);

        let stateSelector = `#state_${index}`;
        let citySelector = `#city_${index}`;

        initStateSelect2(stateSelector);
        initCitySelect2(citySelector, stateSelector);
        
        // Initialize CKEditor for this new summary field
        //ClassicEditor.create(document.querySelectorAll('.work-summary')[index]).catch(console.error);

        setTimeout(() => {
            const newTextarea = $('#workHistoryContainer .work-summary').last()[0]; // get the last added textarea
            if (newTextarea) {
                ClassicEditor
                    .create(newTextarea)
                    .then(editor => {
                        // Save reference for removal if needed later
                        newTextarea.editorInstance = editor;
                    })
                    .catch(err => console.error('CKEditor init failed:', err));
            }
        }, 100);
    }

    function addCertificationsRow(){
        const certIndex = document.querySelectorAll('.certifications-item').length + 1;
        const cer_template = `
            <div class="certifications-item border rounded p-3 mb-3 bg-light">
                <div class="row g-2">
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Certifications</label>
                        <input type="text" name="certifications[${certIndex}][cert]" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Field of Study</label>
                        <input type="text" name="certifications[${certIndex}][field]" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">School Name</label>
                        <input type="text" name="certifications[${certIndex}][school]" class="form-control">

                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="cert_state_${certIndex}">State</label>
                        <select name="certifications[${certIndex}][state]" class="form-select state_select" id="cert_state_${certIndex}">
                            
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="cert_city_${certIndex}">City</label>
                        <select name="certifications[${certIndex}][city]" class="form-select city_select" id="cert_city_${certIndex}">
                            
                        </select>
                    </div>
                    
                </div>
                <button type="button" class="btn btn-sm btn-danger removeCertifications mt-2">Remove</button>
            </div>
        `;
        $('#certificateContainer').append(cer_template);

        let stateSelector = `#cert_state_${certIndex}`;
        let citySelector = `#cert_city_${certIndex}`;

        initStateSelect2(stateSelector);
        initCitySelect2(citySelector, stateSelector);
        
    }

    
    function addEducationRow(){
        const eduIndex = document.querySelectorAll('.education-item').length + 1;
        const edu_template = `
            <div class="education-item border rounded p-3 mb-3 bg-light">
                <div class="row g-2">
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Degree</label>
                        <input type="text" name="education[${eduIndex}][degree]" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Field of Study</label>
                        <input type="text" name="education[${eduIndex}][field]" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">School Name</label>
                        <input type="text" name="education[${eduIndex}][school]" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="edu_state_${eduIndex}">State</label>
                        <select name="education[${eduIndex}][state]" class="form-select state_select" id="edu_state_${eduIndex}">
                            
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="edu_city_${eduIndex}">City</label>
                        <select name="education[${eduIndex}][city]" class="form-select city_select" id="edu_city_${eduIndex}">
                            
                        </select>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-danger removeEducation mt-2">Remove</button>
            </div>
        `;
        $('#educationContainer').append(edu_template);

        let stateSelector = `#edu_state_${eduIndex}`;
        let citySelector = `#edu_city_${eduIndex}`;

        initStateSelect2(stateSelector);
        initCitySelect2(citySelector, stateSelector);
        
    }

    // Add Work History click
    $('#addWorkHistory').click(function() {
        addWorkHistoryRow();
    });

    $('#addEducation').click(function() {
        addEducationRow();
    });

    $('#addCertifications').click(function() {
        addCertificationsRow();
    });

     // Remove work history block
    $(document).on('click', '.remove-work', function() {
        const item = $(this).closest('.work-history-item');
        const textarea = item.find('.work-summary')[0];
        if (textarea && textarea.editorInstance) {
            textarea.editorInstance.destroy().catch(console.error);
        }
        $(this).closest('.work-history-item').remove();
    });

    $(document).on('click', '.removeCertifications', function() {
       $(this).closest('.certifications-item').remove();
    });

    $(document).on('click', '.removeEducation', function() {
       $(this).closest('.education-item').remove();
    });
    
    document.addEventListener('DOMContentLoaded', function () {

        $('.state_select').each(function() {
            initStateSelect2(this);
        });

        $('.city_select').each(function() {
            const stateSelector = $(this).closest('.row').find('.state_select');
            initCitySelect2(this, stateSelector);
        });

        //$('#addWorkHistory').on('click', addWorkHistoryRow);

        document.querySelectorAll('.work-summary').forEach((el) => {
            ClassicEditor
                .create(el)
                .then(editor => { el.editorInstance = editor; })
                .catch(console.error);
        });

   
        const skillInput = document.getElementById('skillInput');
        const addSkillBtn = document.getElementById('addSkillBtn');
        const skillsContainer = document.getElementById('skillsContainer');

        addSkillBtn.addEventListener('click', function() {
            const skill = skillInput.value.trim();

            if (skill !== '') {
                addSkillTag(skill);
                skillInput.value = '';
            }
        });
        // Handle Enter key press
        skillInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const skill = skillInput.value.trim();
                if (skill) {
                    addSkillTag(skill);
                    skillInput.value = '';
                }
            }
        });

        // Add skill tag dynamically
        function addSkillTag(skill) {
            const tag = document.createElement('span');
            tag.className = 'badge bg-primary text-white skill-tag d-inline-flex align-items-center px-2 py-1';
            tag.innerHTML = `
                ${skill}
                <button type="button" class="btn-close btn-close-white btn-sm ms-1 remove-skill" aria-label="Remove"></button>
                <input type="hidden" name="skills[]" value="${skill}">
            `;
            skillsContainer.appendChild(tag);
        }

        // Remove skill tag
        $(document).on('click', '.remove-skill', function() {
            $(this).closest('.skill-tag').remove();
        });

        function previewImage(inputId, previewDivId, imgId, nameId) {
            const input = document.getElementById(inputId);
            const previewDiv = document.getElementById(previewDivId);
            const img = document.getElementById(imgId);
            const name = document.getElementById(nameId);

            input.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                        name.textContent = file.name;
                        previewDiv.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewDiv.style.display = 'none';
                }
            });
        }

        previewImage('logo_file', 'logo_preview', 'logo_preview_img', 'logo_preview_name');
        previewImage('banner_file', 'banner_preview', 'banner_preview_img', 'banner_preview_name');

    });
    
    document.getElementById("resumeForm").addEventListener("submit", function (e) {
        // manually update CKEditor fields if any
        if (window.CKEDITOR) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }

        // check for empty required fields
        const requiredFields = this.querySelectorAll("[required]");
        let firstInvalid = null;
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                if (!firstInvalid) firstInvalid = field;
                field.classList.add("is-invalid");
            } else {
                field.classList.remove("is-invalid");
            }
        });

        if (firstInvalid) {
            e.preventDefault();

            // activate the tab containing that invalid field
            const tabPane = firstInvalid.closest('.tab-pane');
            if (tabPane && tabPane.id) {
                const tabTrigger = document.querySelector(`[data-bs-target="#${tabPane.id}"]`);
                if (tabTrigger) new bootstrap.Tab(tabTrigger).show();
            }

            firstInvalid.focus();
            alert("Please fill all required fields before submitting.");
        }
    });
</script>

@endsection
