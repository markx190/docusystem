<div class="content-wrapper" style="margin-top: 50px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Manage Amenities</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container d-flex justify-content-center">
            <div class="card" style="width: 1250px; margin-top: -10px;">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-plus-circle"></i> Amenities
                </div>

                <div class="card-body">

                    <!-- Success -->
                    @if(session('add_item_image_success'))
                        <div class="alert alert-success">{{ session('add_item_image_success') }}</div>
                    @endif

                    <!-- Error -->
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                <form id="add_amenity" method="POST" action="{{ route('add_amenity') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="item_id_no" value="{{ $items->item_id_no }}">
                
                    <div class="form-group">
                        <label><b>Amenity Name</b></label>
                        <input type="text" name="amenity_name" class="form-control" value="{{ old('amenity_name') }}">
                        <span class="text-danger">@error('amenity_name') {{ $message }} @enderror</span>
                    </div>
                
                    <div class="form-group mt-3">
                        <label><b>Upload Images/Videos</b></label>
                            <div id="drop-area" class="drop-area">
                            <p>Drag & Drop files here</p>
                            <small>or click to select</small>
                        <input type="file" id="fileElem" name="item_images[]" multiple accept="image/*,video/*" style="display:none;">
                    </div>
                    <span class="text-danger">@error('item_images.*') {{ $message }} @enderror</span>
                    <div id="gallery" class="gallery"></div>
                </div>
            <button type="submit" class="btn btn-primary btn-block mt-3">Upload</button>
        </form>

                <!-- Uploaded Media -->
                <h6 class="mt-4">Uploaded Media</h6>
                    <div class="row">
                        @foreach($amenities as $amenity)
                        <div class="col-4 col-md-3 mb-4 text-center image-card" id="image-card-{{ $amenity->id }}">
                            @if(in_array(pathinfo($amenity->item_image, PATHINFO_EXTENSION), ['mp4','mov','avi']))
                                <video src="{{ asset('/uploads/item_images/'.$amenity->item_image) }}" controls style="width:100%; height:180px; object-fit:cover;"></video>
                            @else
                                <img src="{{ asset('/uploads/item_images/'.$amenity->item_image) }}" style="width:100%; height:180px; object-fit:cover;">
                            @endif
                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $amenity->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div id="deleteModal" class="delete-modal">
                        <div class="delete-box">
                            <p class="mb-3">Are you sure you want to delete this amenity?</p>
                            <div class="text-end">
                                <button id="cancelDelete" class="btn btn-sm btn-secondary me-2">No</button>
                                <button id="confirmDelete" class="btn btn-sm btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>


            </div>
        </div>
    </div>
</div>

<style>
.drop-area {
    border: 2px dashed #ccc;
    border-radius: 10px;
    padding: 25px;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
}

.drop-area.hover { border-color: #007bff; background: #f8f9fa; }

.gallery { margin-top: 15px; display: flex; flex-wrap: wrap; gap: 10px; }

.gallery-item { position: relative; width: 120px; height: 120px; }

.gallery-item img, .gallery-item video { width: 100%; height: 100%; object-fit: cover; border-radius: 6px; }

.remove-btn { position: absolute; top: -6px; right: -6px; background:red; color:white; border:none; border-radius:50%; width:22px; height:22px; cursor:pointer; }

.delete-modal { position: fixed; top: 20px; right: 20px; z-index: 9999; display: none; }

.delete-box { background: #fff; padding: 20px; width: 380px; border-radius:10px; box-shadow:0 10px 25px rgba(0,0,0,0.2); animation: slideIn 0.3s ease; }

@keyframes slideIn { from { opacity:0; transform: translateX(30px);} to {opacity:1; transform: translateX(0);} }




@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

</style>


<script>
const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileElem');
const gallery = document.getElementById('gallery');
const form = document.getElementById('add_amenity');

let filesArray = [];
const MAX_SIZE_MB = 10;

// Click to open file picker
dropArea.addEventListener('click', () => fileInput.click());

// Dragover styling
dropArea.addEventListener('dragover', e => { e.preventDefault(); dropArea.classList.add('hover'); });
dropArea.addEventListener('dragleave', () => dropArea.classList.remove('hover'));
dropArea.addEventListener('drop', e => { e.preventDefault(); dropArea.classList.remove('hover'); handleFiles(e.dataTransfer.files); });

// File input
fileInput.addEventListener('change', () => handleFiles(fileInput.files));

function handleFiles(files) {
    for (let file of files) {
        if (file.size > MAX_SIZE_MB * 1024 * 1024) { alert(file.name + " exceeds 10MB limit."); continue; }
        filesArray.push(file); previewFile(file);
    }
}

function previewFile(file) {
    const reader = new FileReader();
    const div = document.createElement('div');
    div.classList.add('gallery-item');

    const removeBtn = document.createElement('button');
    removeBtn.innerHTML = '×'; removeBtn.classList.add('remove-btn');
    removeBtn.onclick = () => { filesArray = filesArray.filter(f => f!==file); div.remove(); };
    div.appendChild(removeBtn);

    reader.onload = () => {
        if(file.type.startsWith('image/')) {
            const img = document.createElement('img'); img.src = reader.result; div.appendChild(img);
        } else {
            const video = document.createElement('video'); video.src = reader.result; video.controls = true; div.appendChild(video);
        }
    };
    reader.readAsDataURL(file);
    gallery.appendChild(div);
}

// Delete Modal
let selectedAmenityId = null;
const deleteModal = document.getElementById('deleteModal');
const confirmBtn = document.getElementById('confirmDelete');
const cancelBtn = document.getElementById('cancelDelete');

document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function () {
        selectedAmenityId = this.dataset.id;
        deleteModal.style.display = 'block';
    });
});

cancelBtn.addEventListener('click', () => { deleteModal.style.display='none'; selectedAmenityId=null; });

confirmBtn.addEventListener('click', () => {
    if(!selectedAmenityId) return;

    fetch("{{ route('delete_amenity') }}", {
        method:'POST',
        headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}', 'Content-Type':'application/json', 'Accept':'application/json' },
        body: JSON.stringify({id:selectedAmenityId})
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.success) {
            const card=document.getElementById('image-card-'+selectedAmenityId);
            if(card){ card.style.transition="0.3s"; card.style.opacity="0"; setTimeout(()=>card.remove(),300); }
        } else { alert(data.message); }
        deleteModal.style.display='none'; selectedAmenityId=null;
    })
    .catch(()=>{ alert('Server error'); deleteModal.style.display='none'; selectedAmenityId=null; });
});


</script>





