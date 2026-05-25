<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top: 50px;">
    <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Dashboard</h1> -->
                </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"></li> Files
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<main class="subs">
    <div class="container-fluid"> 
        <div class="row charts-docs">
            <div class="col-xl-12 ">
            <div class="card mb-4">  
            <div class="card-header subscription-h">
        <i class="fa fa-plus-circle"></i>
    Add New File
</div> 
@if(session()->has('add_item_success'))
<div class="col-md-12" style="margin-top: 12px;">
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check"></i>
        <a href="#" style="text-decoration: none; color: #FFFFFF;" class="close" 
            data-dismiss="alert" aria-label="close">&times;
        </a>
        {{ session()->get('add_item_success') }}
    </div>
</div>
@endif
<div class="card-body">
    <div class="col-md-12">
        <a href="{{ route('manage_items') }}"><button class="btn btn-secondary btn-xs" style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-arrow-left"></i> 
            Back
        </button></a>
    </div> 
<form method="post" action="{{ route('add_item') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <label><b>Category</b></label>
                <select class="form-control" name="category">
                    <option value="{{ old('category') }}">{{ old('category') }}</option>
                    <option value="PSA">PSA</option>
                    <option value="SF10">SF10</option>
                    <option value="FORM 137">FORM 137</option>
                    <option value="SALARY">SALARY</option>
                    <option value="CARD">CARD</option>
                </select>
            <span class="text-danger">@error('category') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>File Name</b></label>
                <input id="fStyle" type="text" class="form-control item_name" value="{{ old('item_name') }}" name="item_name" />
            <span class="text-danger">@error('item_name') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>File Owner</b></label>
                <input id="fStyle" type="text" class="form-control generic" value="{{ old('generic') }}" name="generic" />
            <span class="text-danger">@error('generic') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Tracking Number</b></label>
                <input id="mStyle" type="text" class="form-control brand" name="uom">
                <input id="mStyle" type="hidden" class="form-control brand" value="{{ $user->company }}" name="brand">
            <span class="text-danger">@error('brand') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><b>Description</b></label>
                   <textarea rows="3" class="form-control description" name="description"></textarea>
                <span class="text-danger">@error('description') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-9">
            <div class="col-md-9">
                <label><b>Item Image</b></label>
        <div class="drop-area" id="dropArea">
            <p class="drop-text">
                Drag & Drop Image Here<br>
            <span>or click to browse</span>
        </p>
        <input type="file"
               name="item_avatar"
               id="fileInput"
               class="d-none"
               accept="image/*">
        <div class="preview-container" id="previewContainer"></div>
    </div>
    <span class="text-danger">
        @error('item_avatar') {{ $message }} @enderror
    </span>
</div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button id="update-btn" type="submit" 
                class="btn btn-primary btn-sm">
                    <i class="fa fa-save"></i> Save</button>
                        </div>
                            </div>
                        </div>        
                    </div><!-- /.container-fluid -->
                </form>
            </section>
        </div>
    </div>
</main>
<script>
const dropArea = document.getElementById('dropArea');
const fileInput = document.getElementById('fileInput');
const previewContainer = document.getElementById('previewContainer');

dropArea.addEventListener('click', () => {
    fileInput.click();
});

fileInput.addEventListener('change', function () {
    handleFile(this.files[0]);
});

dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('dragover');
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('dragover');
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('dragover');

    const file = e.dataTransfer.files[0];
    fileInput.files = e.dataTransfer.files;

    handleFile(file);
});

function handleFile(file) {

    if (!file) return;

    previewContainer.innerHTML = '';

    const reader = new FileReader();

    reader.onload = function (e) {

        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';
        wrapper.style.display = 'inline-block';

        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('preview-image');

        const removeBtn = document.createElement('button');
        removeBtn.innerHTML = '&times;';
        removeBtn.classList.add('remove-btn');

        removeBtn.onclick = function () {
            previewContainer.innerHTML = '';
            fileInput.value = '';
        };

        wrapper.appendChild(img);
        wrapper.appendChild(removeBtn);

        previewContainer.appendChild(wrapper);
    };

    reader.readAsDataURL(file);
}
</script>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }

.drop-area {
    border: 2px dashed #999;
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    cursor: pointer;
    background: #fafafa;
    transition: 0.3s;
    position: relative;
}

.drop-area:hover {
    background: #f0f0f0;
}

.drop-area.dragover {
    border-color: #007bff;
    background: #eef5ff;
}

.drop-text {
    color: #666;
    font-size: 15px;
}

.drop-text span {
    font-size: 13px;
    color: #999;
}

.preview-container {
    margin-top: 15px;
    position: relative;
}

.preview-image {
    max-width: 200px;
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 5px;
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
    cursor: pointer;
    font-weight: bold;
}
</style>





