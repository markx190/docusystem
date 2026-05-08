<div class="modal" id="avatarModal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content pull-right">
    <div class="edit-avatar"><b><p id="header-label">
        <i class="fa fa-user-circle"></i> Change Profile Avatar</p></b></div>
<div class="row">
    <div class="col-md-12 c-avatar-space">
        </div>
</div> 
<form id="avatar-edit-form" enctype="multipart/form-data" method="post">    
{{ csrf_field() }}
<div class="modal-body c-avatar-pad">
    <!-- <p id="modal-label"></p> -->
        <div class="row m-label-margin">
            <div class="col-md-12 view-avatar">
        <img id="view-profile-avatar" style="width:125px; height:120px; border-radius:50%" />
    </div>
</div>
<div class="avatar-alert-div"></div>
<div class="row">
    <div class="col-md-8 open-avatar">
        <div class="form-group">
            <label for="service-avatar"><b>Profile Avatar</b></label>
                <input id="edit-hic-id-no" type="hidden" name="hic_id_no" class="form-control">
                <input style="height: 3em;" id="edit-input-avatar" type="file" name="avatar" class="form-control edit-file">
            <span id="edit-input-avatar-text"></span>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button id="edit-avatar-btn" type="submit" name="upload" class="btn btn-success btn-sm pull-right">Save</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>
<style>
    .edit-avatar {
        background-color: #28A745;
        height: 2.3em;
        /* margin-top: -1px; */
    }
    #header-label {
        margin-left: 5px;
        margin-top: 2.5px;
    }
</style>