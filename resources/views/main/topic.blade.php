<!-- Content Wrapper -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper modern-wrapper">
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <!-- MAIN FEED -->
                <div class="col-lg-8">
                    <!-- CREATE POST -->
                    <div class="card modern-post-card">
                        <div class="card-body p-4">
                            <form method="POST"
                                  action="/create_topic"
                                  enctype="multipart/form-data"
                                  id="trendForm">
                                @csrf
                                <!-- USER HEADER -->
                                <div class="d-flex align-items-center mb-4">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->firstname,0,1)) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="post-user-name">
                                            {{ $user->firstname }}
                                        </div>
                                        <div class="post-user-meta">
                                            Share your thoughts with the community
                                        </div>
                                    </div>
                                </div>
                                <!-- TITLE -->
                                <input type="text"
                                    name="trend_name"
                                    class="form-control modern-input mb-3"
                                    placeholder="Create a topic title">
                                <!-- TOPIC -->
                                <textarea name="topic"
                                    rows="4"
                                    class="form-control modern-input mb-3"
                                    placeholder="What's happening today?"></textarea>
                                <!-- DROPZONE -->
                                <div class="media-dropzone" id="mediaDropzone">
                                    <input type="file"name="topic_media" id="topicMedia" hidden accept="image/*,video/*">
                                    <div class="dropzone-content">
                                        <div class="upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <!-- <div class="upload-title">
                                            Drag & Drop image or video
                                        </div>
                                        <div class="upload-subtitle">
                                            or click to browse media
                                        </div> -->
                                    </div>
                                    <!-- PREVIEW -->
                                    <div id="mediaPreviewWrapper"
                                         class="media-preview-wrapper d-none">
                                        <button type="button"
                                            id="removeMedia"
                                                class="remove-media-btn">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <div id="mediaPreview"></div>
                                    </div>
                                </div>
                                <!-- ACTIONS -->
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div class="post-tools">
                                        <button type="button"
                                                class="tool-btn"
                                                id="openMedia">
                                            <i class="far fa-image"></i>
                                        </button>
                                    </div>
                                    <button class="btn modern-post-btn">
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        Post Topic
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- FEED -->
                    @foreach($trends as $trend)
                    <div class="card trend-card">
                        <div class="card-body d-flex">
                            <!-- CONTENT -->
                            <div class="trend-content">
                                <div class="trend-meta">

    <span class="rank-badge">
        {{ $user->firstname }}
    </span>

    <span class="post-time">
        • {{ $trend->created_at->diffForHumans() }}
    </span>

    @if($trend->client_id_no == $user->account_id)

    <div class="dropdown">

        <div class="custom-dropdown">

    <button class="menu-dots-btn toggle-menu">

        <i class="fas fa-ellipsis-h"></i>

    </button>

    <div class="custom-dropdown-menu">

        <a class="dropdown-item edit-topic-btn"
           href="#"
           data-id="{{ $trend->id }}"
           data-title="{{ $trend->trend_name }}"
           data-topic="{{ $trend->topic }}"
           data-media="{{ $trend->topic_media }}">

            Edit Topic

        </a>

    </div>

</div>

    </div>

    @endif

</div>
                                
                                <!-- TITLE -->
                                <h4 class="trend-title">
                                    {{ $trend->trend_name }}
                                </h4>
                                
                                <!-- TOPIC -->
                                <div class="trend-topic">
                                    {{ $trend->topic }}
                                </div>
                                <!-- MEDIA -->
                                @if($trend->topic_media)
                                    @php
                                        $extension = pathinfo(
                                            $trend->topic_media,
                                            PATHINFO_EXTENSION
                                        );
                                    @endphp

                                    @if(in_array(strtolower($extension), ['mp4','mov','avi','webm']))
                                        <video controls
                                            class="preview-media mt-3">
                                            <source src="{{ asset('uploads/topic_media/'.$trend->topic_media) }}">
                                        </video>
                                    @else
                                        <img src="{{ asset('uploads/topic_media/'.$trend->topic_media) }}"
                                             class="preview-media mt-3">
                                    @endif
                                @endif
                                <!-- ACTIONS -->
                                <div class="trend-actions mt-3">

    <div class="vote-pill">

        <!-- UP -->
        <button class="vote-btn upvote-btn"
            data-topic="{{ $trend->id }}"
            data-type="up">

            <i class="bi bi-arrow-up-short"></i>

        </button>

        <!-- COUNT -->
        <span class="vote-count"
              id="vote-count-{{ $trend->id }}">

            {{ $trend->score }}

        </span>

        <!-- DOWN -->
        <button class="vote-btn downvote-btn"
            data-topic="{{ $trend->id }}"
            data-type="down">

            <i class="bi bi-arrow-down-short"></i>

        </button>

    </div>


                                    <button class="action-btn">
                                        <i class="far fa-comment"></i>
                                        Comments
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-share"></i>
                                        Share
                                    </button>
                                    <button class="action-btn">
                                        <i class="far fa-bookmark"></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- SIDEBAR -->
            <div class="col-lg-4">
                <!-- COMMUNITY RANKING -->
                    <div class="card side-card">
                        <div class="card-body">
                            <h5 class="mb-4">
                            Community Ranking
                        </h5>
                        <div class="community-rank-item">
                            <div class="rank-icon observer">
                                <i class="fas fa-eye"></i>
                            </div>
                        <div>
                        <div class="rank-name">
                            Observer
                        </div>
                        <div class="rank-desc">
                            New community member
                        </div>
                    </div>
                </div>
                <div class="community-rank-item">
                    <div class="rank-icon student">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                <div>
                    <div class="rank-name">
                        Student
                    </div>
                    <div class="rank-desc">
                        Active learner
                    </div>
                </div>
            </div>
            <div class="community-rank-item">
                <div class="rank-icon debater">
                    <i class="fas fa-comments"></i>
                        </div>
                    <div>
                    <div class="rank-name">
                        Debater
                    </div>
                    <div class="rank-desc">
                        Engages discussions
                    </div>
                </div>
            </div>
                            <div class="community-rank-item">
                                <div class="rank-icon avenger">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div>
                                    <div class="rank-name">
                                        Avenger
                                    </div>
                                    <div class="rank-desc">
                                        Highly influential
                                    </div>
                                </div>
                            </div>

                            <div class="community-rank-item">
                                <div class="rank-icon guro">
                                    <i class="fas fa-crown"></i>
                                </div>
                                <div>
                                <div class="rank-name">
                                    Guro
                                </div>
                                <div class="rank-desc">
                                    Elite mentor status
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- LEADERBOARD -->
                    <div class="card side-card">
                        <div class="card-body">
                            <h5 class="mb-4">
                                Top Contributors
                            </h5>

                            <div class="leader-modern-item">
                                <img src="https://i.pravatar.cc/100?img=1"
                                     class="leader-avatar">
                                <div>

                                    <div class="leader-name">
                                        JuanDelaCruz
                                    </div>

                                    <div class="leader-points">
                                        12,420 pts
                                    </div>
                                </div>
                            </div>
                            <div class="leader-modern-item">
                                <img src="https://i.pravatar.cc/100?img=2"
                                     class="leader-avatar">
                                <div>
                                    <div class="leader-name">
                                        TechGuro
                                    </div>
                                    <div class="leader-points">
                                        10,110 pts
                                    </div>
                                </div>
                            </div>

                            <div class="leader-modern-item">
                                <img src="https://i.pravatar.cc/100?img=3"
                                     class="leader-avatar">
                                <div>

                                    <div class="leader-name">
                                        DebateMaster
                                    </div>
                                    <div class="leader-points">
                                        9,845 pts
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade"
     id="editTopicModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modern-modal">

            <div class="modal-header border-0">

                <h5 class="modal-title">
                    Edit Topic
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

            <div id="mediaError"
     class="media-error-message d-none">
</div>
                <input type="hidden"
                       id="editTopicId">

                <input type="text"
                       id="editTrendTitle"
                       class="form-control modern-input mb-3"
                       placeholder="Topic title">

                <textarea id="editTrendTopic"
                          class="form-control modern-input"
                          rows="5"
                          placeholder="Topic content"></textarea>
                          <div class="edit-media-wrapper mt-3">

    <input type="file"
           id="editTopicMedia"
           class="d-none"
           accept="image/*,video/*">

    <button type="button"
            class="btn btn-light"
            id="changeMediaBtn">

        Change Media

    </button>

    <button type="button"
            class="btn btn-danger"
            id="removeEditMediaBtn">

        Remove

    </button>

    <div id="editMediaPreview"
         class="mt-3"></div>

</div>

            </div>

            <div class="modal-footer border-0">

                <button class="btn modern-save-btn"
                        id="saveTopicBtn">

                    Save Changes

                </button>

            </div>

        </div>

    </div>

</div>

<script>

const dropzone = document.getElementById('mediaDropzone');
const input = document.getElementById('topicMedia');
const preview = document.getElementById('mediaPreview');
const previewWrapper = document.getElementById('mediaPreviewWrapper');
const removeBtn = document.getElementById('removeMedia');
const openMedia = document.getElementById('openMedia');

/* OPEN FILE PICKER */
dropzone.addEventListener('click', () => {
    input.click();
});

openMedia.addEventListener('click', (e) => {
    e.preventDefault();
    input.click();
});
/* DRAG OVER */
dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('dragging');
});

/* DRAG LEAVE */
dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('dragging');
});

/* DROP FILE */
dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('dragging');
    const files = e.dataTransfer.files;
    if(files.length > 0){
        input.files = files;
        showPreview(files[0]);
    }
});

/* INPUT CHANGE */
input.addEventListener('change', () => {
    if(input.files.length > 0){
        showPreview(input.files[0]);
    }
});
/* REMOVE MEDIA */
removeBtn.addEventListener('click', (e) => {
    e.preventDefault();
    input.value = '';
    preview.innerHTML = '';
    previewWrapper.classList.add('d-none');
});

/* SHOW PREVIEW */

function showPreview(file)
{
    preview.innerHTML = '';
    previewWrapper.classList.remove('d-none');
    const fileType = file.type;
    /* IMAGE */
    if(fileType.startsWith('image/')){
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = 'preview-media';
        preview.appendChild(img);
    }

    /* VIDEO */

    else if(fileType.startsWith('video/')){
        const video = document.createElement('video');
        video.src = URL.createObjectURL(file);
        video.controls = true;
        video.className = 'preview-media';
        preview.appendChild(video);
    }

}
</script>
<script>

document.addEventListener('DOMContentLoaded', function () {

    document.addEventListener('click', async function (e) {

        const button = e.target.closest('.vote-btn');
        if (!button) return;

        const topicId = button.getAttribute('data-topic');
        const type = button.getAttribute('data-type');

        console.log("clicked:", topicId, type);

        try {

            const res = await fetch("{{ route('like_topic') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    topic_id: topicId,
                    type: type
                })
            });

            const data = await res.json();

            console.log("response:", data);

            // 🔥 ALWAYS update score if available
            if (data.score !== undefined) {
                const counter = document.getElementById('vote-count-' + topicId);
                if (counter) {
                    counter.innerText = data.score;
                }
            }

            // optional message (debug or toast later)
            if (!data.success) {
                console.log(data.message);
            }

        } catch (err) {
            console.error("Vote error:", err);
        }

    });

});

</script>
<script>
$(document).on('click', '.edit-topic-btn', function (e) {

    e.preventDefault();

    let id = $(this).data('id');
    let title = $(this).data('title');
    let topic = $(this).data('topic');

    $('#editTopicId').val(id);
    $('#editTrendTitle').val(title);
    $('#editTrendTopic').val(topic);

    $('#editTopicModal').modal('show');

});

</script>

<script>

$(document).on('click', '.edit-topic-btn', function (e) {

    e.preventDefault();

    let id = $(this).data('id');
    let title = $(this).data('title');
    let topic = $(this).data('topic');
    let media = $(this).data('media');

    $('#editTopicId').val(id);
    $('#editTrendTitle').val(title);
    $('#editTrendTopic').val(topic);

    // MEDIA PREVIEW
    let preview = '';

    if(media){

        let extension = media.split('.').pop().toLowerCase();

        if(['mp4','mov','avi','webm'].includes(extension)){

            preview = `
                <video controls class="preview-media">
                    <source src="/uploads/topic_media/${media}">
                </video>
            `;

        } else {

            preview = `
                <img src="/uploads/topic_media/${media}"
                     class="preview-media">
            `;

        }

    }

    $('#editMediaPreview').html(preview);

    $('#editTopicModal').modal('show');

});

</script>
<script>

$('#changeMediaBtn').click(function () {

    $('#editTopicMedia').click();

});

</script>
<script>

$('#editTopicMedia').change(function () {

    let file = this.files[0];

    if(!file) return;

    // CLEAR OLD ERROR
    $('#mediaError')
        .addClass('d-none')
        .text('');

    // 50MB
    let maxSize = 50 * 1024 * 1024;

    if(file.size > maxSize){

        $('#mediaError')
            .removeClass('d-none')
            .text(
                'File is too large. Maximum upload size is 50MB.'
            );

        $(this).val('');

        return;
    }

    let preview = '';

    if(file.type.startsWith('image/')){

        preview = `
            <img src="${URL.createObjectURL(file)}"
                 class="preview-media">
        `;

    }

    else if(file.type.startsWith('video/')){

        preview = `
            <video controls class="preview-media">
                <source src="${URL.createObjectURL(file)}">
            </video>
        `;

    }

    $('#editMediaPreview').html(preview);

});

</script>
<script>

$('#saveTopicBtn').click(function () {

    // CLEAR OLD ERROR
    $('#mediaError')
        .addClass('d-none')
        .text('');

    let mediaInput = document.getElementById('editTopicMedia');

    // VALIDATE FILE SIZE
    if (mediaInput.files.length > 0) {

        let file = mediaInput.files[0];

        let maxSize = 50 * 1024 * 1024; // 50MB

        if (file.size > maxSize) {

            $('#mediaError')
                .removeClass('d-none')
                .text('File is too large. Maximum upload size is 50MB.');

            return;
        }
    }

    let formData = new FormData();

    formData.append(
        '_token',
        $('meta[name="csrf-token"]').attr('content')
    );

    formData.append(
        'topic_id',
        $('#editTopicId').val()
    );

    formData.append(
        'trend_name',
        $('#editTrendTitle').val()
    );

    formData.append(
        'topic',
        $('#editTrendTopic').val()
    );

    // APPEND MEDIA
    if (mediaInput.files.length > 0) {

        formData.append(
            'topic_media',
            mediaInput.files[0]
        );
    }

    // DISABLE BUTTON
    $('#saveTopicBtn')
        .prop('disabled', true)
        .text('Saving...');

    $.ajax({

        url: "{{ route('update_topic') }}",

        type: "POST",

        data: formData,

        processData: false,
        contentType: false,

        success: function(response){

            if(response.success){

                location.reload();

            } else {

                $('#mediaError')
                    .removeClass('d-none')
                    .text(response.message || 'Something went wrong.');

            }

        },

        error: function(xhr){

            let message = 'Upload failed.';

            if(xhr.responseJSON?.message){
                message = xhr.responseJSON.message;
            }

            $('#mediaError')
                .removeClass('d-none')
                .text(message);

        },

        complete: function(){

            $('#saveTopicBtn')
                .prop('disabled', false)
                .text('Save Changes');

        }

    });

});

</script>
<script>

document.addEventListener('click', function(e){

    // TOGGLE MENU
    if(e.target.closest('.toggle-menu')){

        let dropdown = e.target
            .closest('.custom-dropdown');

        let menu = dropdown
            .querySelector('.custom-dropdown-menu');

        // CLOSE OTHER MENUS
        document.querySelectorAll(
            '.custom-dropdown-menu'
        ).forEach(el => {

            if(el !== menu){
                el.classList.remove('show');
            }

        });

        menu.classList.toggle('show');

        return;
    }

    // CLICK OUTSIDE = CLOSE
    document.querySelectorAll(
        '.custom-dropdown-menu'
    ).forEach(el => {

        el.classList.remove('show');

    });

});

</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body{
    background:#F5F7FA;
    font-family:Inter,sans-serif;
}

/* WRAPPER */

.modern-wrapper{
    background:#F5F7FA !important;
    margin-top:50px;
    min-height:100vh;
}

/* CARDS */

.trend-card,
.side-card,
.modern-post-card{
    background:white;
    border:none;
    border-radius:24px;
    box-shadow:0 4px 20px rgba(0,0,0,0.05);
    margin-bottom:18px;
    overflow:hidden;
}

/* USER HEADER */

.user-avatar{
    width:52px;
    height:52px;
    border-radius:50%;
    background:linear-gradient(135deg,#2563EB,#7C3AED);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-weight:700;
    font-size:18px;
    flex-shrink:0;
}

.post-user-name{
    font-weight:700;
    color:#0F172A;
    font-size:15px;
}

.post-user-meta{
    color:#64748B;
    font-size:12px;
}

/* INPUTS */
.modern-input{
    border:none !important;
    background:#F1F5F9 !important;
    border-radius:18px !important;
    padding:16px !important;
    font-size:15px;
    color:#0F172A;
    box-shadow:none !important;
}

.modern-input:focus{
    background:white !important;
    box-shadow:0 0 0 4px rgba(37,99,235,0.10) !important;
}

/* DROPZONE */
.media-dropzone{
    border:2px dashed #CBD5E1;
    border-radius:22px;
    background:#F8FAFC;
    padding:45px 25px;
    text-align:center;
    cursor:pointer;
    transition:0.25s;
    position:relative;
}

.media-dropzone:hover{
    border-color:#2563EB;
    background:#EFF6FF;
}

.media-dropzone.dragging{
    border-color:#2563EB;
    background:#DBEAFE;
    transform:scale(1.01);
}

.upload-icon{
    font-size:44px;
    color:#2563EB;
    margin-bottom:12px;
}

.upload-title{
    font-weight:700;
    color:#0F172A;
    font-size:16px;
}

.upload-subtitle{
    color:#64748B;
    font-size:13px;
    margin-top:4px;
}


/* PREVIEW */
.media-preview-wrapper{
    position:relative;
    margin-top:18px;
}

.preview-media{
    width:100%;
    max-height:450px;
    object-fit:cover;
    border-radius:18px;
    background:#E2E8F0;
}

/* REMOVE BUTTON */

.remove-media-btn{
    position:absolute;
    top:12px;
    right:12px;
    width:40px;
    height:40px;
    border:none;
    border-radius:50%;
    background:rgba(15,23,42,0.85);
    color:white;
    z-index:20;
    transition:0.2s;
}

.remove-media-btn:hover{
    transform:scale(1.08);
    background:#EF4444;
}

/* TOOLS */

.tool-btn{
    border:none;
    width:46px;
    height:46px;
    border-radius:14px;
    background:#EFF6FF;
    color:#2563EB;
    transition:0.2s;
}

.tool-btn:hover{
    background:#DBEAFE;
    transform:scale(1.05);
}

/* POST BUTTON */

.modern-post-btn{
    background:#2563EB;
    color:white;
    border:none;
    border-radius:14px;
    padding:12px 26px;
    font-weight:600;
    font-size:14px;
    transition:0.2s;
}

.modern-post-btn:hover{
    background:#1D4ED8;
    transform:translateY(-1px);
}

/* TREND CARD */

.vote-panel{
    width:54px;
    display:flex;
    flex-direction:column;
    align-items:center;
    padding-top:5px;
    flex-shrink:0;
}



.trend-content{
    width:100%;
    padding-left:10px;
}

.trend-meta{
    font-size:12px;
    color:#64748B;
    margin-bottom:10px;
}

.rank-badge{
    background:#EEF2FF;
    color:#4338CA;
    padding:4px 10px;
    border-radius:20px;
    font-size:11px;
    font-weight:700;
}

.username,
.post-time{
    margin-left:8px;
}

.trend-title{
    font-size:20px;
    font-weight:700;
    color:#0F172A;
    margin-bottom:12px;
}

.trend-topic{
    color:#334155;
    line-height:1.7;
    font-size:14px;
}

/* ACTIONS */

.trend-actions{
    margin-top:16px;
}

.action-btn{
    border:none;
    background:none;
    color:#64748B;
    margin-right:16px;
    font-size:13px;
    font-weight:600;
    transition:0.2s;
}

.action-btn:hover{
    color:#0F172A;
}

/* COMMUNITY RANKING */

.community-rank-item{
    display:flex;
    align-items:center;
    margin-bottom:18px;
}

.rank-icon{
    width:50px;
    height:50px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    margin-right:14px;
    font-size:18px;
    flex-shrink:0;
}
 
/* Like */
.like-btn{
    border:none;
    background:transparent;
    padding:0;
    cursor:pointer;
    color:#878A8C;
    font-size:1.6rem;
    outline:none !important;
    box-shadow:none !important;
    transition:0.2s ease;
}

.like-btn:hover{
    color:#FF4500;
    transform:scale(1.1);
}

.like-btn.liked{
    color:#FF4500;
}

.like-count{
    font-weight:600;
    font-size:0.9rem;
}

.observer{
    background:linear-gradient(135deg,#3B82F6,#2563EB);
}

.student{
    background:linear-gradient(135deg,#10B981,#059669);
}

.debater{
    background:linear-gradient(135deg,#F59E0B,#D97706);
}

.avenger{
    background:linear-gradient(135deg,#EF4444,#DC2626);
}

.guro{
    background:linear-gradient(135deg,#8B5CF6,#7C3AED);
}

.rank-name{
    font-weight:700;
    color:#0F172A;
}

.rank-desc{
    font-size:12px;
    color:#64748B;
}

/* LEADERBOARD */

.leader-modern-item{
    display:flex;
    align-items:center;
    margin-bottom:18px;
}

.leader-avatar{
    width:54px;
    height:54px;
    border-radius:50%;
    object-fit:cover;
    margin-right:14px;
    border:3px solid #EFF6FF;
}

.leader-name{
    font-weight:700;
    color:#0F172A;
}

.leader-points{
    font-size:12px;
    color:#64748B;
}

/* SCROLLBAR */

::-webkit-scrollbar{
    width:8px;
}

::-webkit-scrollbar-thumb{
    background:#CBD5E1;
    border-radius:20px;
}

/* MOBILE */

@media(max-width:768px){

    .trend-title{
        font-size:17px;
    }

    .media-dropzone{
        padding:28px 18px;
    }

    .preview-media{
        max-height:320px;
    }
}

.active-up{
    color:#FF4500 !important;
}

.active-down{
    color:#7193FF !important;
}
/* action */
.action-menu-wrapper{
    display:flex;
    align-items:center;
    gap:10px;
}

.trend-meta{
    display:flex;
    align-items:center;
    gap:6px;
    flex-wrap:nowrap;
}

.rank-badge,
.post-time{
    display:inline-flex;
    align-items:center;
}

.dropdown{
    display:flex;
    align-items:center;
    margin-left:4px;
}

.menu-dots-btn{
    border:none;
    background:transparent;
    color:#878A8C;
    font-size:0.85rem;
    padding:0 4px;
    line-height:1;
    cursor:pointer;
    outline:none !important;
    box-shadow:none !important;
}

.menu-dots-btn:hover{
    color:#111;
}

.dropdown-menu{
    border:none;
    border-radius:12px;
    box-shadow:0 6px 20px rgba(0,0,0,0.08);
    padding:8px;
}

.dropdown-item{
    border-radius:8px;
    padding:10px 14px;
    transition:0.2s ease;
    font-size: 11px;
}

.dropdown-item:hover{
    background:#f5f5f5;
}
.modern-modal{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,0.12);
}

.modern-save-btn{
    background:#111827;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:10px 20px;
    font-weight:600;
    transition:0.2s ease;
}

.modern-save-btn:hover{
    background:#000;
    transform:translateY(-1px);
}

.custom-dropdown{
    position:relative;
}

.custom-dropdown-menu{
    position:absolute;
    top:28px;
    right:0;
    background:#fff;
    border-radius:12px;
    min-width:160px;
    box-shadow:0 8px 24px rgba(0,0,0,0.08);
    padding:8px;
    display:none;
    z-index:999;
}

.custom-dropdown-menu.show{
    display:block;
}
.media-error-message{
    background:#FEF2F2;
    color:#DC2626;
    padding:10px 14px;
    border-radius:10px;
    font-size:0.85rem;
    margin-bottom:12px;
    border:1px solid #FECACA;
}

.d-none{
    display:none;
}

/* VOTE PILL */

.vote-pill{
    display:inline-flex;
    align-items:center;
    gap:4px;

    background:#F1F5F9;

    border-radius:999px;

    padding:4px 10px;

    transition:all 0.2s ease;

    border:1px solid transparent;
}

/* HOVER CONTAINER */

.vote-pill:hover{
    background:#E2E8F0;
    border-color:#CBD5E1;
}

/* BUTTON */

.vote-btn{
    width:32px;
    height:32px;

    border:none;
    background:transparent;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:50%;

    cursor:pointer;

    transition:all 0.18s ease;

    color:#64748B;
}

/* ICON */

.vote-btn i{
    font-size:1.45rem;
    line-height:1;
}

/* UPVOTE */

.upvote-btn:hover{
    background:#FFE8E0;
    color:#FF4500;
}

/* DOWNVOTE */

.downvote-btn:hover{
    background:#E8F0FF;
    color:#2563EB;
}

/* ACTIVE STATES */

.active-up{
    color:#FF4500 !important;
    background:#FFE8E0;
}

.active-down{
    color:#2563EB !important;
    background:#E8F0FF;
}

/* COUNT */

.vote-count{
    min-width:26px;

    text-align:center;

    font-size:0.92rem;
    font-weight:700;

    color:#0F172A;

    user-select:none;
}
</style>
