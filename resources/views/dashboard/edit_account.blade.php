<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top: 50px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <main class="subs">
        <div class="container-fluid">
            <div class="row charts-docs">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header subscription-h">
                            <i class="fa fa-plus-circle"></i> Edit Account
                        </div>

                        @if(session()->has('edit_profile_success'))
                            <div class="col-md-12 mt-2">
                                <div class="alert alert-success alert-dismissible">
                                    <i class="fa fa-check"></i>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('edit_profile_success') }}
                                </div>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('dashboard') }}">
                                    <button class="btn btn-secondary btn-xs">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </button>
                                </a>
                            </div>

                            <form method="POST" action="{{ route('update_account') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label><b>First Name</b></label>
                                        <input type="text" name="firstname" class="form-control"
                                               value="{{ old('firstname', $user->firstname ?? '') }}">
                                        <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="col-md-4">
                                        <label><b>Middle Name</b></label>
                                        <input type="text" name="middlename" class="form-control"
                                               value="{{ old('middlename', $user->middlename ?? '') }}">
                                        <span class="text-danger">@error('middlename') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="col-md-4">
                                        <label><b>Last Name</b></label>
                                        <input type="text" name="lastname" class="form-control"
                                               value="{{ old('lastname', $user->lastname ?? '') }}">
                                        <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label><b>Company</b></label>
                                        <input type="text" name="company" class="form-control"
                                               value="{{ old('company', $user->company ?? '') }}">
                                        <span class="text-danger">@error('company') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label><b>Mobile Number</b></label>
                                        <input type="text" name="mobile_number" class="form-control"
                                               value="{{ old('mobile_number', $user->mobile_number ?? '') }}">
                                        <span class="text-danger">@error('mobile_number') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label><b>Email</b></label>
                                        <input type="email" name="email" class="form-control"
                                               value="{{ old('email', $user->email ?? '') }}">
                                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label><b>Facebook Page</b></label>
                                        <input type="text" name="facebook_page" class="form-control"
                                               value="{{ old('facebook_page', $user->facebook_page ?? '') }}">
                                        <span class="text-danger">@error('facebook_page') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label><b>New Password (optional)</b></label>
                                        <input type="password" name="password" class="form-control">
                                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label><b>Confirm Password</b></label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>

                                    {{-- AVATAR UPLOAD --}}
<div class="col-md-6 mt-4">
    <label><b>Avatar</b></label>

    <div class="upload-box" id="avatarBox">
        <input type="file" name="avatar" id="avatarInput" accept="image/*" hidden>
        <div class="upload-content text-center">
            <p>Drag & Drop Avatar Here</p>
            <small>or click to upload</small>
        </div>
        <div class="preview-container d-none">
            <button type="button" class="remove-btn" onclick="removeFile('avatar')">×</button>
            <img id="avatarPreview" class="preview-img">
        </div>
    </div>

    

    <span class="text-danger">@error('avatar') {{ $message }} @enderror</span>
</div>


{{-- GOVERNMENT ID UPLOAD --}}
<div class="col-md-6 mt-4">
    <label><b>Government ID</b></label>

    <div class="upload-box" id="govBox">
        <input type="file" name="gov_id" id="govInput" accept="image/*,.pdf" hidden>
        <div class="upload-content text-center">
            <p>Drag & Drop Gov ID Here</p>
            <small>Image or PDF</small>
        </div>
        <div class="preview-container d-none">
            <button type="button" class="remove-btn" onclick="removeFile('gov')">×</button>
            <div id="govPreview"></div>
        </div>
    </div>

    

    <span class="text-danger">@error('gov_id') {{ $message }} @enderror</span>
</div>


                                    <div class="col-md-6 mt-3">
                                        <label><b>Current Avatar</b></label><br>
                                        @if(!empty($user->avatar))
                                            <img src="{{ asset('public/uploads/avatars/'.$user->avatar) }}"
                                                 class="img-thumbnail"
                                                 style="height:80px; width:90px;">
                                        @endif
                                    </div>
                                <div class="col-md-6 mt-3">
                                        <label><b>Uploaded Gov. ID</b></label><br>
                                        @if(!empty($user->gov_id))
                                            <img src="{{ asset('public/uploads/gov_ids/'.$user->gov_id) }}"
                                                 class="img-thumbnail"
                                                 style="height:80px; width:90px;">
                                        @endif
                                    </div>
                                </div>

                                <div class="modal-footer mt-4">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>        
                    </div>
                </div>
            </div>
        </div>
        </div>
                
        </div>
    </main>
<script>
function setupUpload(boxId, inputId, previewId, isGov = false) {

    const box = document.getElementById(boxId);
    const input = document.getElementById(inputId);
    const previewContainer = box.querySelector('.preview-container');
    const uploadContent = box.querySelector('.upload-content');

    box.addEventListener('click', () => input.click());

    box.addEventListener('dragover', (e) => {
        e.preventDefault();
        box.style.borderColor = '#007bff';
    });

    box.addEventListener('dragleave', () => {
        box.style.borderColor = '#ccc';
    });

    box.addEventListener('drop', (e) => {
        e.preventDefault();
        input.files = e.dataTransfer.files;
        handlePreview(input.files[0]);
    });

    input.addEventListener('change', () => {
        handlePreview(input.files[0]);
    });

    function handlePreview(file) {
        uploadContent.classList.add('d-none');
        previewContainer.classList.remove('d-none');

        if (isGov && file.type === "application/pdf") {
            document.getElementById(previewId).innerHTML =
                `<p><i class="fa fa-file-pdf-o"></i> ${file.name}</p>`;
        } else {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (isGov) {
                    document.getElementById(previewId).innerHTML =
                        `<img src="${e.target.result}" class="preview-img">`;
                } else {
                    document.getElementById(previewId).src = e.target.result;
                }
            };
            reader.readAsDataURL(file);
        }
    }
}

function removeFile(type) {
    if (type === 'avatar') {
        document.getElementById('avatarInput').value = '';
        document.querySelector('#avatarBox .preview-container').classList.add('d-none');
        document.querySelector('#avatarBox .upload-content').classList.remove('d-none');
    }
    if (type === 'gov') {
        document.getElementById('govInput').value = '';
        document.querySelector('#govBox .preview-container').classList.add('d-none');
        document.querySelector('#govBox .upload-content').classList.remove('d-none');
    }
}

setupUpload('avatarBox', 'avatarInput', 'avatarPreview');
setupUpload('govBox', 'govInput', 'govPreview', true);
</script>

<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
    
    .upload-box {
    border: 2px dashed #ccc;
    padding: 25px;
    border-radius: 10px;
    cursor: pointer;
    position: relative;
    transition: 0.3s;
}

.upload-box:hover {
    border-color: #007bff;
    background: #f8f9fa;
}

.preview-img {
    max-width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
}

.preview-container {
    position: relative;
}

.remove-btn {
    position: absolute;
    top: -10px;
    right: -10px;
    background: red;
    color: white;
    border: none;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    font-size: 18px;
    cursor: pointer;
}

</style>
