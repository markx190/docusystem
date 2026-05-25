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
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Files</li>
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
        <i class="fa fa-edit"></i>
    Update File
</div> 
@if(session()->has('update_item_success'))
<div class="col-md-12 mt-2">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle"></i>
        {{ session('update_item_success') }}
        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
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
<form method="POST"
      action="{{ route('update_item', $item->item_id_no) }}"
      enctype="multipart/form-data">
    @csrf

<div class="row">

    <div class="col-md-3">
        <label><b>Category</b></label>
        <select class="form-control" name="category">
            <option value="{{ $item->category }}">{{ $item->category }}</option>
            <option value="Food and Groceries">Food and Groceries</option>
                    <option value="PSA">PSA</option>
                    <option value="SF10">SF10</option>
                    <option value="FORM 137">FORM 137</option>
                    <option value="SALARY">SALARY</option>
                    <option value="CARD">CARD</option>
        </select>
    </div>

    <div class="col-md-3">
        <label><b>Item Name</b></label>
        <input type="text" class="form-control" name="item_name"
               value="{{ $item->item_name }}">
    </div>

    <div class="col-md-3">
        <label><b>Owner</b></label>
        <input type="text" class="form-control" name="generic"
               value="{{ $item->generic }}">
    </div>

    <div class="col-md-3">
        <label><b>Department</b></label>
        <input type="text" class="form-control" name="brand"
               value="{{ $item->brand }}" readonly>
    </div>

   
    <div class="col-md-12">
        <div class="form-group">
            <label><b>Description</b></label>
            <textarea rows="3" class="form-control"
            name="description">{{ $item->description }}</textarea>
        </div>
    </div>
    <div class="col-md-3">
        <label><b>Traking No.</b></label>
            <input type="text" class="form-control" name="uom"
               value="{{ $item->uom }}">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mt-3">

    <label><b>Change Item Image (optional)</b></label>

    <div id="drop-area" class="upload-wrapper">

        <input type="file"
               name="item_avatar"
               id="fileInput"
               accept="image/*"
               hidden>

        <div id="upload-content">

            <i class="fa fa-cloud-upload upload-icon"></i>

            <h6 class="mt-3">
                Drag & Drop Image Here
            </h6>

            <p class="text-muted">
                or click to browse
            </p>

        </div>

        <!-- PREVIEW -->
        <div id="preview-container" style="display:none;">

            <button type="button"
                    id="removeImage"
                    class="remove-btn">
                ×
            </button>

            <img id="preview-image">

            <div id="file-name" class="mt-2"></div>

        </div>

    
</div>
</div>

    <div class="col-md-6 mt-3 text-center">
        <label><b>File</b></label><br>
        <img src="{{ asset('/uploads/item_avatars/'.$item->item_avatar) }}"
             class="img-thumbnail"
             style="height: 80px; width: 90px;">
    </div>

</div>

<div class="modal-footer mt-4">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-save"></i> Update File
            </button>
        </div>
    </form>
</div>        
                                        </div><!-- /.container-fluid -->
                                    </form>
                                </section>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
</style>
<style>

.upload-wrapper{
    border:2px dashed #007bff;
    border-radius:15px;
    padding:30px;
    background:#f8f9fa;
    text-align:center;
    cursor:pointer;
    transition:0.3s;
    position:relative;
    min-height:260px;

    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
}

.upload-wrapper:hover{
    background:#eef5ff;
}

.upload-wrapper.dragover{
    background:#dbeeff;
    border-color:#0056b3;
}

.upload-icon{
    font-size:55px;
    color:#007bff;
}

#preview-image{
    width:170px;
    height:170px;
    object-fit:cover;
    border-radius:12px;
    border:1px solid #ddd;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

#file-name{
    font-size:14px;
    font-weight:600;
    color:#333;
}

.remove-btn{
    position:absolute;
    top:10px;
    right:10px;
    width:32px;
    height:32px;
    border:none;
    border-radius:50%;
    background:#dc3545;
    color:#fff;
    font-size:20px;
    font-weight:bold;
    line-height:1;
    cursor:pointer;
    transition:0.2s;
}

.remove-btn:hover{
    transform:scale(1.1);
    background:#b52a37;
}

</style>
<script>

const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileInput');

const previewContainer = document.getElementById('preview-container');
const previewImage = document.getElementById('preview-image');

const uploadContent = document.getElementById('upload-content');
const fileName = document.getElementById('file-name');

const removeBtn = document.getElementById('removeImage');


// CLICK TO OPEN FILE
dropArea.addEventListener('click', () => {
    fileInput.click();
});


// FILE INPUT CHANGE
fileInput.addEventListener('change', () => {
    if(fileInput.files.length){
        handleFile(fileInput.files[0]);
    }
});


// DRAG OVER
dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('dragover');
});


// DRAG LEAVE
dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('dragover');
});


// DROP
dropArea.addEventListener('drop', (e) => {

    e.preventDefault();

    dropArea.classList.remove('dragover');

    const files = e.dataTransfer.files;

    if(files.length){

        fileInput.files = files;

        handleFile(files[0]);
    }
});


// HANDLE FILE
function handleFile(file){

    if(file.type.startsWith('image/')){

        const reader = new FileReader();

        reader.onload = function(e){

            previewImage.src = e.target.result;

            previewContainer.style.display = 'block';

            uploadContent.style.display = 'none';

            fileName.innerHTML = file.name;
        }

        reader.readAsDataURL(file);
    }
}


// REMOVE IMAGE
removeBtn.addEventListener('click', (e) => {

    e.stopPropagation();

    fileInput.value = '';

    previewImage.src = '';

    previewContainer.style.display = 'none';

    uploadContent.style.display = 'block';

    fileName.innerHTML = '';
});

</script>