<div class="content-wrapper" style="margin-top: 50px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h6>Manage Item Images</h6>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Item Images</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container d-flex justify-content-center">
            <div class="card" style="width: 1150px; margin-top: -10px;">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-plus-circle"></i> Item Images
                </div>
                <div class="card-body">
                    @if(session('add_item_image_success'))
                        <div class="alert alert-success">{{ session('add_item_image_success') }}</div>
                    @endif

                    <form id="add_image_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="item_id_no" value="{{ $items->item_id_no }}">

                        <div class="form-group">
                            <label><b>Item Name</b></label>
                            <input type="text" class="form-control" value="{{ $items->item_name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label><b>Upload Images/Videos</b></label>
                                <div id="drop-area" class="drop-area">
                                <p>Drag & Drop files here</p>
                            <input type="file" id="fileElem" multiple accept="image/*,video/*" style="display:none;">
                        </div>

                            <div id="gallery" class="gallery"></div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Upload</button>
                    </form>

                    <hr>
    <!-- Alert placeholder -->
    <div id="deleteAlert" class="alert alert-success alert-dismissible fade show" 
     style="display:none; position:fixed; top:20px; right:20px; z-index:9999; min-width:250px;">
    <span id="deleteAlertMsg"></span>
    {{-- <button type="button" class="btn btn-sm btn-light ms-2" style="height: 1.9em;"
            onclick="document.getElementById('deleteAlert').style.display='none';">
        X
    </button> --}}
</div>


        <h6 class="mt-4">Uploaded Images</h6>
                    <div class="row">
            @foreach($itemImages as $image)
            <div class="col-4 col-md-3 mb-4 text-center image-card"
                id="image-card-{{ $image->id }}">

                @if(in_array(pathinfo($image->item_image, PATHINFO_EXTENSION), ['mp4','mov','avi']))
                <video src="{{ asset('/uploads/item_images/'.$image->item_image) }}"
                   controls class="img-thumbnail media-thumb"></video>
                @else
                <img src="{{ asset('/uploads/item_images/'.$image->item_image) }}"
                 class="img-thumbnail media-thumb">
                @endif

                <button type="button"
                    class="btn btn-danger btn-sm delete-btn mt-2"
                    data-id="{{ $image->id }}"
                    style="border-radius:50%; width:32px; height:32px;">
                <i class="fa fa-trash"></i>
                </button>
            </div>
        @endforeach
    
    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<style>
.drop-area {
    border: 2px dashed #ccc;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
}
.drop-area.hover {
    border-color: #007bff;
    background: #f0f8ff;
}
.gallery {
    margin-top: 15px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
}
.gallery-item {
    position: relative;
    width: 100px;
    height: 100px;
}
.gallery-item img, .gallery-item video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 5px;
}
.gallery-item .remove-btn {
    position: absolute;
    top: -5px;
    right: -5px;
    background: red;
    color: white;
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    cursor: pointer;
}

</style>


<script>
const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileElem');
const gallery = document.getElementById('gallery');
let filesArray = [];

dropArea.addEventListener('click', () => fileInput.click());

fileInput.addEventListener('change', handleFiles);

dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('hover');
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('hover');
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('hover');
    handleFiles(e.dataTransfer);
});

function handleFiles(e) {
    let files = e.files || e.target.files;
    for (let file of files) {
        filesArray.push(file);
        previewFile(file);
    }
}

function previewFile(file) {
    const reader = new FileReader();
    const div = document.createElement('div');
    div.classList.add('gallery-item');

    const removeBtn = document.createElement('button');
    removeBtn.innerHTML = '&times;';
    removeBtn.classList.add('remove-btn');
    removeBtn.onclick = () => {
        filesArray = filesArray.filter(f => f !== file);
        div.remove();
    };
    div.appendChild(removeBtn);

    if (file.type.startsWith('image/')) {
        reader.onload = () => {
            const img = document.createElement('img');
            img.src = reader.result;
            div.appendChild(img);
        }
        reader.readAsDataURL(file);
    } else if (file.type.startsWith('video/')) {
        reader.onload = () => {
            const video = document.createElement('video');
            video.src = reader.result;
            video.controls = true;
            div.appendChild(video);
        }
        reader.readAsDataURL(file);
    }

    gallery.appendChild(div);
}

const MAX_SIZE_MB = 10;

function handleFiles(e) {
    let files = e.files || e.target.files;
    for (let file of files) {

        if(file.size > MAX_SIZE_MB * 1024 * 1024){
            showAlert(`File "${file.name}" exceeds 10 MB and was not added.`, 'warning');
            continue; // Skip this file
        }

        filesArray.push(file);
        previewFile(file);
    }
}

// Helper alert function
function showAlert(message, type = 'danger') {
    const alertBox = document.getElementById('deleteAlert');
    const alertMsg = document.getElementById('deleteAlertMsg');
    alertMsg.innerHTML = message;
    alertBox.className = `alert alert-${type} alert-dismissible fade show`;
    alertBox.style.display = 'block';
    setTimeout(() => { alertBox.style.display = 'none'; }, 4000);
}


    // Override form submit to include our filesArray
    document.getElementById('add_image_form').addEventListener('submit', function(e){
        e.preventDefault();
        const formData = new FormData();
        formData.append('item_id_no', '{{ $items->item_id_no }}');
        filesArray.forEach(f => formData.append('item_images[]', f));

        fetch("{{ route('add_item_image') }}", {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: formData
        })
        .then(res => res.text())
        .then(html => location.reload())
        .catch(err => console.error(err));
    });

let deleteImageId = null;

document.addEventListener('DOMContentLoaded', function () {

    const alertBox = document.getElementById('deleteAlert');
    const alertMsg = document.getElementById('deleteAlertMsg');

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {

            const imageId = this.dataset.id;

            // Show confirmation inline
            alertMsg.innerHTML = `
                Are you sure you want to delete this image?
                <button class="btn btn-sm btn-danger ms-2" id="confirmDeleteInline">Yes</button>
                <button class="btn btn-sm btn-secondary ms-1" id="cancelDeleteInline">No</button>
            `;
            alertBox.style.display = 'block';

            // Cancel button
            document.getElementById('cancelDeleteInline').onclick = function() {
                alertBox.style.display = 'none';
            };

            // Confirm button
            document.getElementById('confirmDeleteInline').onclick = function() {

                fetch("{{ route('delete_item_image') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ id: imageId })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success){
                        // Remove image card
                        const card = document.getElementById('image-card-' + imageId);
                        if(card) card.remove();

                        // Show success message
                        alertMsg.innerHTML = data.message;
                        setTimeout(() => { alertBox.style.display = 'none'; }, 3000);
                    } else {
                        alertMsg.innerHTML = data.message || 'Failed to delete image.';
                    }
                })
                .catch(() => {
                    alertMsg.innerHTML = 'Server error. Try again.';
                });

            };

        });
    });

});


</script>




