@extends('layouts.backend')

@section('title', 'Edit Resume')

@section('styles')
    <style>
        .nav-link {
            text-align: left;
        }

        .suggestions-box {
            max-height: 200px;
            overflow: hidden;
            border-radius: 6px;
            padding-left: 10px;
            top:100%;
            left:0;
            right:0;
            z-index:1000;
            background:#fff;
            border:1px solid #ccc;
            overflow-y: auto;
            position: absolute;
            margin-left: 13px;
            width: 91%;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Resume</h1>
            <p class="text-muted">Update resume information</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Resume</h6>
                </div>
                <div class="card-body">
                    <div class="container py-5">
                        <form action="{{ route('resume.save') }}" method="POST" enctype="multipart/form-data"
                            id="resumeForm" novalidate>
                            @csrf
                            {{--
                            @if (isset($resume))
                                @method('PUT')
                            @endif
                            --}}
                            <div class="row">
                                <!-- Left Tabs -->
                                <div class="col-md-3 mb-4 mb-md-0">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
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
                                            data-bs-target="#v-pills-social-media" type="button" role="tab"
                                            aria-controls="v-pills-social-media" aria-selected="false">
                                            Social Media
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

                                        <div class="tab-pane fade show active" id="v-pills-personal" role="tabpanel" aria-labelledby="v-pills-personal-tab">
                                            <div class="card border-0 shadow-sm p-4">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="first_name" class="form-control"
                                                            required placeholder="Enter first name..."
                                                            value="{{ old('first_name', $resume->first_name ?? '') }}">
                                                    </div>
                                                    <label class="col-sm-2 col-form-label">Last Name <span class="text-danger">*</span></label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="last_name" class="form-control" required
                                                            value="{{ old('last_name', $resume->last_name ?? '') }}"
                                                            placeholder="Enter last name...">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                                                    <div class="col-sm-4">
                                                        <input type="email" name="email" class="form-control"
                                                            required value="{{ old('email', $resume->email ?? '') }}"
                                                            placeholder="Enter email...">
                                                    </div>
                                                    <label class="col-sm-2 col-form-label">Phone <span class="text-danger">*</span></label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="phone" id="phoneInput" class="form-control"
                                                            required value="{{ old('phone', $resume->phone ?? '') }}"
                                                            placeholder="Enter phone...">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Address <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <textarea name="address" rows="3" class="form-control" required placeholder="Enter address...">
                                                            {{ old('address', $resume->address ?? '') }}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-professional" role="tabpanel" aria-labelledby="v-pills-professional-tab">
                                            <div class="card border-0 shadow-sm p-4">
                                                <label for="professional_summary" class="form-label">Professional Summary
                                                <span class="text-danger">*</span></label>
                                                <textarea name="summary" id="professional_summary" class="form-control" rows="30" required placeholder="Enter professional summary...">
                                                    {{ old('professional_summary', $resume->summary ?? '') }}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-work" role="tabpanel" aria-labelledby="v-pills-work-tab">
                                            <div class="card border-0 shadow-sm p-4">
                                                <div id="workHistoryContainer">
                                                    @php
                                                        $workHistory = (isset($workHistory) && is_array($workHistory)) ? $workHistory : json_decode($workHistory, true);
                                                        $workHistory = $workHistory ?: [];
                                                    @endphp

                                                    @foreach ($workHistory as $i => $exp)
                                                        <div class="work-history-item border rounded p-3 mb-3">
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Position <span class="text-danger">*</span></label>
                                                                    <input type="text" name="work[{{ $i }}][position]" value="{{ $exp['position'] ?? '' }}" class="form-control" placeholder="Enter position..." required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Start Date</label>
                                                                    <input type="date" name="work[{{ $i }}][start_date]" value="{{ $exp['start_date'] ?? '' }}" class="form-control">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">End Date</label>
                                                                    <input type="date" name="work[{{ $i }}][end_date]" value="{{ $exp['end_date'] ?? '' }}" class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Company Name</label>
                                                                    <input type="text" name="work[{{ $i }}][company_name]" value="{{ $exp['company_name'] ?? '' }}" class="form-control" placeholder="Enter company name...">
                                                                </div>

                                                                <div class="col-md-3" style="position: relative;">
                                                                    <label class="form-label">State</label>
                                                                    <input type="text" name="work[{{ $i }}][state_name]" class="form-control state-input" placeholder="Search state..." value="{{ $exp['state_name'] ?? '' }}" autocomplete="off">
                                                                    <input type="hidden" name="work[{{ $i }}][state]" class="state-id-input" value="{{ $exp['state'] ?? '' }}">
                                                                    <div class="state-suggestions suggestions-box"></div>
                                                                </div>

                                                                <div class="col-md-3" style="position: relative;">
                                                                    <label class="form-label">City</label>
                                                                    <input type="text" name="work[{{ $i }}][city_name]" class="form-control city-input" placeholder="Search city..." value="{{ $exp['city_name'] ?? '' }}" autocomplete="off">
                                                                    <input type="hidden" name="work[{{ $i }}][city]" class="city-id-input" value="{{ $exp['city'] ?? '' }}">
                                                                    <div class="city-suggestions suggestions-box"></div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-2">
                                                                <label class="form-label">Company Summary</label>
                                                                <textarea name="work[{{ $i }}][company_summary]" class="form-control work-summary" rows="3" placeholder="Enter company summary">
                                                                    {{ $exp['company_summary'] ?? '' }}
                                                                </textarea>
                                                            </div>

                                                            <button type="button" class="btn btn-sm btn-danger remove-work">Remove</button>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button type="button" onclick="addWorkHistoryRow()" class="btn btn-outline-primary btn-sm mt-3">
                                                    + Add Work History
                                                </button>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-edu" role="tabpanel" aria-labelledby="v-pills-edu-tab">
                                            <div class="card border-0 shadow-sm p-4">
                                                <div id="educationContainer">
                                                    @php
                                                        $educationData = is_array($educationData) ? $educationData : json_decode($educationData, true);
                                                        $educationData = $educationData ?: [];
                                                    @endphp

                                                    @foreach ($educationData as $i => $edu)
                                                        <div class="education-item border rounded p-3 mb-3 bg-light">
                                                            <div class="row g-2">
                                                                <div class="col-md-4 mb-2">
                                                                    <label class="form-label">Degree</label>
                                                                    <input type="text" name="education[{{ $i }}][degree]" class="form-control"
                                                                        value="{{ $edu['degree'] ?? '' }}" placeholder="Enter degree name">
                                                                </div>
                                                                <div class="col-md-4 mb-2">
                                                                    <label class="form-label">Field of Study</label>
                                                                    <input type="text" name="education[{{ $i }}][field]" class="form-control"
                                                                        value="{{ $edu['field'] ?? '' }}" placeholder="Enter field of study">
                                                                </div>
                                                                <div class="col-md-4 mb-2">
                                                                    <label class="form-label">School Name</label>
                                                                    <input type="text" name="education[{{ $i }}][school]" class="form-control"
                                                                        value="{{ $edu['school'] ?? '' }}" placeholder="Enter school name">
                                                                </div>

                                                                <div class="col-md-4 mb-2 position-relative">
                                                                    <label class="form-label">State</label>
                                                                    <input type="text" name="education[{{ $i }}][state_name]" class="form-control state-input"
                                                                        placeholder="Search state..." value="{{ $edu['state_name'] ?? '' }}">
                                                                    <input type="hidden" name="education[{{ $i }}][state]" class="state-id-input" value="{{ $edu['state'] ?? '' }}">
                                                                    <div class="state-suggestions suggestions-box"></div>
                                                                </div>

                                                                <div class="col-md-4 mb-2 position-relative">
                                                                    <label class="form-label">City</label>
                                                                    <input type="text" name="education[{{ $i }}][city_name]" class="form-control city-input"
                                                                        placeholder="Search city..." value="{{ $edu['city_name'] ?? '' }}">
                                                                    <input type="hidden" name="education[{{ $i }}][city]" class="city-id-input" value="{{ $edu['city'] ?? '' }}">
                                                                    <div class="city-suggestions suggestions-box"></div>
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

                                        <div class="tab-pane fade" id="v-pills-cert" role="tabpanel" aria-labelledby="v-pills-cert-tab">
                                            <div class="card border-0 shadow-sm p-4">
                                                <div id="certificateContainer">
                                                    @php
                                                        $certData = is_array($certData) ? $certData : json_decode($certData, true);
                                                        $certData = $certData ?: [];
                                                    @endphp

                                                    @foreach ($certData as $i => $cer)
                                                        <div class="certifications-item border rounded p-3 mb-3 bg-light">
                                                            <div class="row g-2">
                                                                <div class="col-md-4 mb-2">
                                                                    <label class="form-label">Certifications</label>
                                                                    <input type="text" name="certifications[{{ $i }}][cert]" class="form-control"
                                                                        value="{{ $cer['cert'] ?? '' }}" placeholder="Enter certification name">
                                                                </div>

                                                                <div class="col-md-4 mb-2">
                                                                    <label class="form-label">Field of Study</label>
                                                                    <input type="text" name="certifications[{{ $i }}][field]" class="form-control"
                                                                        value="{{ $cer['field'] ?? '' }}" placeholder="Enter field of study">
                                                                </div>

                                                                <div class="col-md-4 mb-2">
                                                                    <label class="form-label">Institution Name</label>
                                                                    <input type="text" name="certifications[{{ $i }}][institution]" class="form-control"
                                                                        value="{{ $cer['institution'] ?? '' }}" placeholder="Enter institution name">
                                                                </div>

                                                                <div class="col-md-4 mb-2 position-relative">
                                                                    <label class="form-label">State</label>
                                                                    <input type="text" name="certifications[{{ $i }}][state_name]" class="form-control state-input"
                                                                        placeholder="Search state..." value="{{ $cer['state_name'] ?? '' }}">
                                                                    <input type="hidden" name="certifications[{{ $i }}][state]" class="state-id-input" value="{{ $cer['state'] ?? '' }}">
                                                                    <div class="state-suggestions suggestions-box"></div>
                                                                </div>

                                                                <div class="col-md-4 mb-2 position-relative">
                                                                    <label class="form-label">City</label>
                                                                    <input type="text" name="certifications[{{ $i }}][city_name]" class="form-control city-input"
                                                                        placeholder="Search city..." value="{{ $cer['city_name'] ?? '' }}">
                                                                    <input type="hidden" name="certifications[{{ $i }}][city]" class="city-id-input" value="{{ $cer['city'] ?? '' }}">
                                                                    <div class="city-suggestions suggestions-box"></div>
                                                                </div>
                                                            </div>

                                                            <button type="button" class="btn btn-sm btn-danger removeCertifications mt-2">Remove</button>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button type="button" onclick="addCertificationsRow()" class="btn btn-outline-primary btn-sm mt-3">
                                                    + Add Certifications
                                                </button>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-skill" role="tabpanel" aria-labelledby="v-pills-skill-tab">
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

                                                        @foreach ($skills as $skill)
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

                                        <div class="tab-pane fade" id="v-pills-social-media" role="tabpanel" aria-labelledby="v-pills-social-media-tab">
                                            <div class="row g-4">
                                                <div class="col-md-6">
                                                    <label for="linkedin" class="form-label fw-semibold">LinkedIn Profile</label>
                                                    <input type="url" name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror"
                                                        value="{{ old('linkedin', $resume->linkedin ?? '') }}"
                                                        placeholder="https://www.linkedin.com/in/your-profile">
                                                    @error('linkedin')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="github" class="form-label fw-semibold">GitHub Profile</label>
                                                <input type="url" name="github" id="github" class="form-control @error('github') is-invalid @enderror"
                                                    value="{{ old('github', $resume->github ?? '') }}"
                                                    placeholder="https://github.com/your-username">
                                                @error('github')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                         <div class="tab-pane fade" id="v-pills-files" role="tabpanel" aria-labelledby="v-pills-files-tab">
                                            <div class="row g-4">
                                                <div class="col-md-6">
                                                    <label for="resume_file" class="form-label fw-semibold">Upload Resume</label>
                                                    <input type="file" name="resume_file" id="resume_file"
                                                        class="form-control @error('resume_file') is-invalid @enderror"
                                                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.bmp,.webp">
                                                    @error('resume_file')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div id="resume_preview_container_upload"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    @if (!empty($resume->file_path))
                                                        <div id="resume_preview_container" class="p-2 border rounded" style="min-height:80px;">
                                                            @php
                                                                $ext = strtolower(pathinfo($resume->file_path, PATHINFO_EXTENSION));
                                                                $isImage = in_array($ext, ['jpg','jpeg','png','gif','bmp','webp']);
                                                                $fileUrl = asset('storage/' . $resume->file_path);
                                                                $fileName = $resume->original_file_name ?? basename($resume->file_path);
                                                            @endphp
                                                            @if ($isImage)
                                                                <img src="{{ $fileUrl }}" alt="Resume" width="100" class="rounded border mb-2"><br>
                                                            @endif
                                                            <span>{{ $fileName }}</span><br>
                                                            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">Open</a>
                                                            <a href="{{ $fileUrl }}" download class="btn btn-sm btn-outline-success mt-1">Download</a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="logo_file" class="form-label fw-semibold">Upload Logo (min: 100x100)</label>
                                                    <input type="file" name="logo_file" id="logo_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                                                    @error('logo_file')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div id="logo_preview_container_upload"></div>
                                                </div>

                                                <div class="col-md-6">
                                                    @if (!empty($resume->logo_path))
                                                        <div id="logo_preview_container" class="p-2 border rounded" style="min-height:80px;">
                                                            @php
                                                                $ext = strtolower(pathinfo($resume->logo_path, PATHINFO_EXTENSION));
                                                                $isImage = in_array($ext, ['jpg','jpeg','png','gif','bmp','webp']);
                                                                $fileUrl = asset('storage/' . $resume->logo_path);
                                                                $fileName = $resume->logo_original_name ?? basename($resume->logo_path);
                                                            @endphp
                                                            @if ($isImage)
                                                                <img src="{{ $fileUrl }}" alt="Logo" width="100" height="100" class="rounded border mb-2"><br>
                                                            @endif
                                                            <span>{{ $fileName }}</span><br>
                                                            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">Open</a>
                                                            <a href="{{ $fileUrl }}" download class="btn btn-sm btn-outline-success mt-1">Download</a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="banner_file" class="form-label fw-semibold">Upload Banner (min: 1200x400)</label>
                                                    <input type="file" name="banner_file" id="banner_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                                                    @error('banner_file')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div id="banner_preview_container_upload"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    @if (!empty($resume->banner_path))
                                                        <div id="banner_preview_container" class="p-2 border rounded" style="min-height:80px;">
                                                            @php
                                                                $ext = strtolower(pathinfo($resume->banner_path, PATHINFO_EXTENSION));
                                                                $isImage = in_array($ext, ['jpg','jpeg','png','gif','bmp','webp']);
                                                                $fileUrl = asset('storage/' . $resume->banner_path);
                                                                $fileName = $resume->banner_original_name ?? basename($resume->banner_path);
                                                            @endphp
                                                            @if ($isImage)
                                                                <img src="{{ $fileUrl }}" alt="Banner" width="300" height="100" class="rounded border mb-2"><br>
                                                            @endif
                                                            <span>{{ $fileName }}</span><br>
                                                            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">Open</a>
                                                            <a href="{{ $fileUrl }}" download class="btn btn-sm btn-outline-success mt-1">Download</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary btn-sm"> Save Changes </button>
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
        ClassicEditor.create(document.querySelector('#professional_summary'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch(console.error);

        document.addEventListener('DOMContentLoaded', function() {
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
        });

        document.getElementById("resumeForm").addEventListener("submit", function(e) {
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
                showToast("Please fill all required fields before submitting.", 'error');
            }
        });

        document.addEventListener("DOMContentLoaded", function() {

            function setupFilePreview(inputId, previewContainerId, allowedTypes, maxSizeKB, minWidth = 0, minHeight = 0) {
                const input = document.getElementById(inputId);
                const container = document.getElementById(previewContainerId);

                input.addEventListener('change', function() {

                    $(this).removeClass("is-invalid");

                    const file = this.files[0];
                    if (!file) {
                        container.innerHTML = '';
                        return;
                    }

                    const fileType = file.type.toLowerCase();
                    const fileName = file.name;
                    const fileSizeKB = file.size / 1024;
                    const extension = fileName.split('.').pop().toLowerCase();

                    // File type validation
                    if (!allowedTypes.includes(extension)) {
                        showToast(`Invalid file type! Allowed: ${allowedTypes.join(', ')}`, 'error');
                        this.value = '';
                        container.innerHTML = '';
                        focusInvalidField(this);
                        return;
                    }

                    // File size validation
                    if (fileSizeKB > maxSizeKB) {
                        showToast(`File too large! Max allowed: ${maxSizeKB / 1024} MB`, 'error');
                        this.value = '';
                        container.innerHTML = '';
                        focusInvalidField(this);
                        return;
                    }

                    // For images: check minimum dimensions
                    if (fileType.startsWith('image/') && (minWidth > 0 || minHeight > 0)) {
                        const img = new Image();
                        img.onload = () => {
                            if (img.width < minWidth || img.height < minHeight) {
                                showToast(`Image must be at least ${minWidth}x${minHeight} pixels`, 'error');
                                input.value = '';
                                container.innerHTML = '';
                                focusInvalidField(input);
                                return;
                            }
                            renderPreview(img, fileName);
                        };
                        img.src = URL.createObjectURL(file);
                    } else {
                        renderPreview(null, fileName);
                    }
                });

                function renderPreview(imgElement, fileName) {
                    container.innerHTML = '';
                    if (imgElement) {
                        imgElement.className = 'rounded border mb-2';
                        imgElement.width = 100;
                        container.appendChild(imgElement);
                    }
                    const span = document.createElement('span');
                    span.textContent = fileName;
                    container.appendChild(span);
                    container.appendChild(document.createElement('br'));
                }
            }

            // Focus invalid field and activate its tab
            function focusInvalidField(field) {
                $(field).addClass("is-invalid");
                field.focus();
            }

            // Resume
            setupFilePreview('resume_file', 'resume_preview_container_upload', ['pdf','jpg','jpeg','png'], 3072, 1, 1);

            // Logo
            setupFilePreview('logo_file', 'logo_preview_container_upload', ['jpg','jpeg','png','webp'], 1024, 100, 100);

            // Banner with min dimension 1200x400
            setupFilePreview('banner_file', 'banner_preview_container_upload', ['jpg','jpeg','png','webp'], 2048, 1200, 400);

        });

        // Pass from backend
        const stateOptions = @json($stateOptions); // [{id, name}]
        const cityOptions = @json($citiyOptions); // [{id, state_id, name}]

        function initWorkRow(workItem) {
            const stateInput = workItem.querySelector('.state-input');
            const stateIdInput = workItem.querySelector('.state-id-input');
            const stateSuggestionBox = workItem.querySelector('.state-suggestions');

            const cityInput = workItem.querySelector('.city-input');
            const cityIdInput = workItem.querySelector('.city-id-input');
            const citySuggestionBox = workItem.querySelector('.city-suggestions');

            // ---------- STATE AUTOCOMPLETE ----------
            stateInput.addEventListener('input', function() {
                stateIdInput.value = '';
                stateSuggestionBox.innerHTML = '';

                const query = stateInput.value.toLowerCase();
                if (!query) { stateSuggestionBox.style.display = 'none'; return; }

                const filtered = stateOptions.filter(s => s.name.toLowerCase().includes(query));
                if (filtered.length === 0) { stateSuggestionBox.style.display = 'none'; return; }

                filtered.forEach(state => {
                    const div = document.createElement('div');
                    div.classList.add('suggestion-item');
                    div.textContent = state.name;
                    div.style.cursor = 'pointer';
                    div.onclick = () => {
                        stateInput.value = state.name;
                        stateIdInput.value = state.id;
                        stateSuggestionBox.style.display = 'none';

                        // Clear city if state changed
                        cityInput.value = '';
                        cityIdInput.value = '';
                    };
                    stateSuggestionBox.appendChild(div);
                });

                stateSuggestionBox.style.display = 'block';
            });

            // ---------- CITY AUTOCOMPLETE ----------
            cityInput.addEventListener('input', function() {
                cityIdInput.value = '';
                citySuggestionBox.innerHTML = '';

                const query = cityInput.value.toLowerCase();
                if (!query) { citySuggestionBox.style.display = 'none'; return; }

                let filteredCities = cityOptions;
                if (stateIdInput.value) {
                    filteredCities = cityOptions.filter(c => c.state_id == stateIdInput.value);
                }

                filteredCities = filteredCities.filter(c => c.name.toLowerCase().includes(query));
                if (filteredCities.length === 0) { citySuggestionBox.style.display = 'none'; return; }

                filteredCities.forEach(city => {
                    const div = document.createElement('div');
                    div.classList.add('suggestion-item');
                    div.textContent = city.name;
                    div.style.cursor = 'pointer';
                    div.onclick = () => {
                        cityInput.value = city.name;
                        cityIdInput.value = city.id;
                        citySuggestionBox.style.display = 'none';

                        // Auto-fill state if user selects city first
                        if (!stateIdInput.value) {
                            const state = stateOptions.find(s => s.id === city.state_id);
                            if (state) {
                                stateInput.value = state.name;
                                stateIdInput.value = state.id;
                            }
                        }
                    };
                    citySuggestionBox.appendChild(div);
                });

                citySuggestionBox.style.display = 'block';
            });

            // Hide suggestions on outside click
            document.addEventListener('click', e => {
                if (!workItem.contains(e.target)) {
                    stateSuggestionBox.style.display = 'none';
                    citySuggestionBox.style.display = 'none';
                }
            });

            // ---------- Clear input if not selected ----------
            stateInput.addEventListener('blur', function () {
                setTimeout(() => {
                    if (!stateIdInput.value) {
                        stateInput.value = '';
                    }
                    stateSuggestionBox.style.display = 'none';
                }, 200);
            });

            cityInput.addEventListener('blur', function () {
                setTimeout(() => {
                    if (!cityIdInput.value) {
                        cityInput.value = '';
                    }
                    citySuggestionBox.style.display = 'none';
                }, 200);
            });

            // Initialize CKEditor for this row
            const summaryTextarea = workItem.querySelector('.work-summary');
            if (summaryTextarea) {
                ClassicEditor.create(summaryTextarea).catch(err => console.error(err));
            }

            // Remove button
            const removeBtn = workItem.querySelector('.remove-work');
            removeBtn?.addEventListener('click', () => workItem.remove());
        }

        // ---------- Add new dynamic row ----------
        function addWorkHistoryRow() {
            const container = document.getElementById('workHistoryContainer');
            const index = container.querySelectorAll('.work-history-item').length;
            const template = document.createElement('div');
            template.classList.add('work-history-item', 'border', 'rounded', 'p-3', 'mb-3');
            template.innerHTML = `
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label">Position <span class="text-danger">*</span></label>
                        <input type="text" name="work[${index}][position]" class="form-control" required placeholder="e.g. Software Engineer">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="work[${index}][start_date]" class="form-control" placeholder="e.g. 2020-01-01">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="work[${index}][end_date]" class="form-control" placeholder="e.g. 2022-12-31">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="work[${index}][company_name]" class="form-control" placeholder="e.g. ABC Corp">
                    </div>
                    <div class="col-md-3" style="position: relative;">
                        <label class="form-label">State</label>
                        <input type="text" name="work[${index}][state_name]" class="form-control state-input" placeholder="Search state...">
                        <input type="hidden" name="work[${index}][state]" class="state-id-input">
                        <div class="state-suggestions suggestions-box"></div>
                    </div>
                    <div class="col-md-3" style="position: relative;">
                        <label class="form-label">City</label>
                        <input type="text" name="work[${index}][city_name]" class="form-control city-input" placeholder="Search city...">
                        <input type="hidden" name="work[${index}][city]" class="city-id-input">
                        <div class="city-suggestions suggestions-box"></div>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label">Company Summary</label>
                    <textarea name="work[${index}][company_summary]" class="form-control work-summary" rows="3" placeholder="Enter company summary..."></textarea>
                </div>
                <button type="button" class="btn btn-sm btn-danger remove-work">Remove</button>
            `;
            container.appendChild(template);
            initWorkRow(template);
        }

        // Initialize existing rows
        document.querySelectorAll('.work-history-item').forEach(initWorkRow);

        function initEducationRow(eduItem) {
            const stateInput = eduItem.querySelector('.state-input');
            const stateIdInput = eduItem.querySelector('.state-id-input');
            const stateSuggestionBox = eduItem.querySelector('.state-suggestions');

            const cityInput = eduItem.querySelector('.city-input');
            const cityIdInput = eduItem.querySelector('.city-id-input');
            const citySuggestionBox = eduItem.querySelector('.city-suggestions');

            // ---------- STATE AUTOCOMPLETE ----------
            stateInput.addEventListener('input', function () {
                stateIdInput.value = '';
                stateSuggestionBox.innerHTML = '';

                const query = stateInput.value.toLowerCase().trim();
                if (!query) { stateSuggestionBox.style.display = 'none'; return; }

                const filtered = stateOptions.filter(s => s.name.toLowerCase().includes(query));

                filtered.forEach(state => {
                    const div = document.createElement('div');
                    div.classList.add('suggestion-item');
                    div.textContent = state.name;
                    div.style.cursor = 'pointer';
                    div.onclick = () => {
                        stateInput.value = state.name;
                        stateIdInput.value = state.id;
                        stateSuggestionBox.style.display = 'none';

                        // Clear city when state changes
                        cityInput.value = '';
                        cityIdInput.value = '';
                    };
                    stateSuggestionBox.appendChild(div);
                });

                stateSuggestionBox.style.display = 'block';
            });

            // ---------- CITY AUTOCOMPLETE ----------
            cityInput.addEventListener('input', function () {
                cityIdInput.value = '';
                citySuggestionBox.innerHTML = '';

                const query = cityInput.value.toLowerCase().trim();
                if (!query) { citySuggestionBox.style.display = 'none'; return; }

                let filteredCities = cityOptions;
                if (stateIdInput.value) {
                    filteredCities = cityOptions.filter(c => c.state_id == stateIdInput.value);
                }

                filteredCities = filteredCities.filter(c => c.name.toLowerCase().includes(query));

                filteredCities.forEach(city => {
                    const div = document.createElement('div');
                    div.classList.add('suggestion-item');
                    div.textContent = city.name;
                    div.style.cursor = 'pointer';
                    div.onclick = () => {
                        cityInput.value = city.name;
                        cityIdInput.value = city.id;
                        citySuggestionBox.style.display = 'none';
                        if (!stateIdInput.value) {
                            const state = stateOptions.find(s => s.id === city.state_id);
                            if (state) {
                                stateInput.value = state.name;
                                stateIdInput.value = state.id;
                            }
                        }
                    };
                    citySuggestionBox.appendChild(div);
                });

                citySuggestionBox.style.display = 'block';
            });

            // ---------- Blur / outside click ----------
            stateInput.addEventListener('blur', function () {
                setTimeout(() => {
                    if (!stateIdInput.value) stateInput.value = '';
                    stateSuggestionBox.style.display = 'none';
                }, 200);
            });

            cityInput.addEventListener('blur', function () {
                setTimeout(() => {
                    if (!cityIdInput.value) cityInput.value = '';
                    citySuggestionBox.style.display = 'none';
                }, 200);
            });

            document.addEventListener('click', function (e) {
                if (!eduItem.contains(e.target)) {
                    stateSuggestionBox.style.display = 'none';
                    citySuggestionBox.style.display = 'none';
                }
            });

            // Remove education row
            const removeBtn = eduItem.querySelector('.removeEducation');
            removeBtn?.addEventListener('click', () => eduItem.remove());
        }

        // ---------- Add new row dynamically ----------
        $('#addEducation').click(function () {
            const index = document.querySelectorAll('.education-item').length;
            const template = `
                <div class="education-item border rounded p-3 mb-3 bg-light">
                    <div class="row g-2">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Degree</label>
                            <input type="text" name="education[${index}][degree]" class="form-control" placeholder="Enter degree name">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Field of Study</label>
                            <input type="text" name="education[${index}][field]" class="form-control" placeholder="Enter field of study">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">School Name</label>
                            <input type="text" name="education[${index}][school]" class="form-control" placeholder="Enter school name">
                        </div>
                        <div class="col-md-4 mb-2 position-relative">
                            <label class="form-label">State</label>
                            <input type="text" name="education[${index}][state_name]" class="form-control state-input" placeholder="Search state...">
                            <input type="hidden" name="education[${index}][state]" class="state-id-input">
                            <div class="state-suggestions suggestions-box"></div>
                        </div>
                        <div class="col-md-4 mb-2 position-relative">
                            <label class="form-label">City</label>
                            <input type="text" name="education[${index}][city_name]" class="form-control city-input" placeholder="Search city...">
                            <input type="hidden" name="education[${index}][city]" class="city-id-input">
                            <div class="city-suggestions suggestions-box"></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger removeEducation mt-2">Remove</button>
                </div>`;
            $('#educationContainer').append(template);
            initEducationRow($('#educationContainer .education-item').last()[0]);
        });

        // ---------- Initialize existing rows ----------
        document.querySelectorAll('.education-item').forEach(initEducationRow);

        function initCertificationRow(certItem) {
            const stateInput = certItem.querySelector('.state-input');
            const stateIdInput = certItem.querySelector('.state-id-input');
            const stateSuggestionBox = certItem.querySelector('.state-suggestions');

            const cityInput = certItem.querySelector('.city-input');
            const cityIdInput = certItem.querySelector('.city-id-input');
            const citySuggestionBox = certItem.querySelector('.city-suggestions');

            // ---------- STATE AUTOCOMPLETE ----------
            stateInput.addEventListener('input', function () {
                stateIdInput.value = '';
                stateSuggestionBox.innerHTML = '';

                const query = stateInput.value.toLowerCase().trim();
                if (!query) { stateSuggestionBox.style.display = 'none'; return; }

                const filtered = stateOptions.filter(s => s.name.toLowerCase().includes(query));

                filtered.forEach(state => {
                    const div = document.createElement('div');
                    div.classList.add('suggestion-item');
                    div.textContent = state.name;
                    div.style.cursor = 'pointer';
                    div.onclick = () => {
                        stateInput.value = state.name;
                        stateIdInput.value = state.id;
                        stateSuggestionBox.style.display = 'none';

                        // Clear city when state changes
                        cityInput.value = '';
                        cityIdInput.value = '';
                    };
                    stateSuggestionBox.appendChild(div);
                });

                stateSuggestionBox.style.display = 'block';
            });

            // ---------- CITY AUTOCOMPLETE ----------
            cityInput.addEventListener('input', function () {
                cityIdInput.value = '';
                citySuggestionBox.innerHTML = '';

                const query = cityInput.value.toLowerCase().trim();
                if (!query) { citySuggestionBox.style.display = 'none'; return; }

                let filteredCities = cityOptions;
                if (stateIdInput.value) {
                    filteredCities = cityOptions.filter(c => c.state_id == stateIdInput.value);
                }

                filteredCities = filteredCities.filter(c => c.name.toLowerCase().includes(query));

                filteredCities.forEach(city => {
                    const div = document.createElement('div');
                    div.classList.add('suggestion-item');
                    div.textContent = city.name;
                    div.style.cursor = 'pointer';
                    div.onclick = () => {
                        cityInput.value = city.name;
                        cityIdInput.value = city.id;
                        citySuggestionBox.style.display = 'none';
                        if (!stateIdInput.value) {
                            const state = stateOptions.find(s => s.id === city.state_id);
                            if (state) {
                                stateInput.value = state.name;
                                stateIdInput.value = state.id;
                            }
                        }
                    };
                    citySuggestionBox.appendChild(div);
                });

                citySuggestionBox.style.display = 'block';
            });

            // ---------- Blur / outside click ----------
            stateInput.addEventListener('blur', function () {
                setTimeout(() => {
                    if (!stateIdInput.value) stateInput.value = '';
                    stateSuggestionBox.style.display = 'none';
                }, 200);
            });

            cityInput.addEventListener('blur', function () {
                setTimeout(() => {
                    if (!cityIdInput.value) cityInput.value = '';
                    citySuggestionBox.style.display = 'none';
                }, 200);
            });

            // ---------- Outside click ----------
            document.addEventListener('click', function (e) {
                if (!certItem.contains(e.target)) {
                    stateSuggestionBox.style.display = 'none';
                    citySuggestionBox.style.display = 'none';
                }
            });

            // Remove certification row
            const removeBtn = certItem.querySelector('.removeCertifications');
            removeBtn?.addEventListener('click', () => certItem.remove());
        }

        // ---------- Add new certification row ----------
        function addCertificationsRow() {
            const certIndex = document.querySelectorAll('.certifications-item').length;
            const cer_template = `
                <div class="certifications-item border rounded p-3 mb-3 bg-light">
                    <div class="row g-2">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Certifications</label>
                            <input type="text" name="certifications[${certIndex}][cert]" class="form-control" placeholder="Enter certification name">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Field of Study</label>
                            <input type="text" name="certifications[${certIndex}][field]" class="form-control" placeholder="Enter field of study">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Institution  Name</label>
                            <input type="text" name="certifications[${certIndex}][institution]" class="form-control" placeholder="Enter institution name">
                        </div>
                        <div class="col-md-4 mb-2 position-relative">
                            <label class="form-label">State</label>
                            <input type="text" name="certifications[${certIndex}][state_name]" class="form-control state-input" placeholder="Search state...">
                            <input type="hidden" name="certifications[${certIndex}][state]" class="state-id-input">
                            <div class="state-suggestions suggestions-box"></div>
                        </div>
                        <div class="col-md-4 mb-2 position-relative">
                            <label class="form-label">City</label>
                            <input type="text" name="certifications[${certIndex}][city_name]" class="form-control city-input" placeholder="Search city...">
                            <input type="hidden" name="certifications[${certIndex}][city]" class="city-id-input">
                            <div class="city-suggestions suggestions-box"></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger removeCertifications mt-2">Remove</button>
                </div>
            `;
            $('#certificateContainer').append(cer_template);
            initCertificationRow($('#certificateContainer .certifications-item').last()[0]);
        }

        // ---------- Initialize existing certification rows ----------
        document.querySelectorAll('.certifications-item').forEach(initCertificationRow);

        // Remove work history block
        $(document).on('click', '.remove-work', function() {
            const item = $(this).closest('.work-history-item');
            const textarea = item.find('.work-summary')[0];
            if (textarea && textarea.editorInstance) {
                textarea.editorInstance.destroy().catch(console.error);
            }
            $(this).closest('.work-history-item').remove();
        });

        $(document).on('click', '.removeEducation', function() {
            $(this).closest('.education-item').remove();
        });

        $(document).on('click', '.removeCertifications', function() {
            $(this).closest('.certifications-item').remove();
        });
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('phoneInput');

            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // only digits
                value = value.substring(0, 10); // limit to 10 digits
                if (value.length > 3 && value.length <= 6) {
                    value = value.replace(/(\d{3})(\d+)/, '$1-$2');
                } else if (value.length > 6) {
                    value = value.replace(/(\d{3})(\d{3})(\d+)/, '$1-$2-$3');
                }
                e.target.value = value;
            });
        });
    </script>
@endsection
