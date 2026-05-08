<script>
    function goToUpdateAvatar(hicIdNo, button){
        $('#avatarModal').modal('show');

        $('.c-avatar-pad').hide();      
        $('#edit-avatar-btn').attr('disabled', true); 
        $('.c-avatar-space').html('<div class="spinner-dash" style="text-align: center;"><img class="displayed" style="width: 100px; height: 100px;" src="/images/loader_circle.gif" /></div>');  
        setTimeout(hideSpinner, 1000); 

        function hideSpinner(){
            $('.spinner-dash').hide();
            $('.c-avatar-pad').show();
            $('#edit-avatar-btn').attr('disabled', false);
        }  

        // $('#edit-hic-id-no').attr('value', button.getAttribute('data-hic-id-no')); 
        $('#view-profile-avatar').attr('src', button.getAttribute('data-hic-profile-avatar'));

        // const userAvatar = $('#avatar-edit-form input[name="avatar"]');
        // const userAvatar = userAvatar.val();

        $('#avatar-edit-form').on('submit', function(event){
        event.preventDefault();
        $('#edit-avatar-btn').attr('disabled', true);

        $('#edit-input-avatar').bind('click', function(){
            $('#edit-avatar-btn').attr('disabled', false);
            $('#edit-input-avatar-text').text('');
        });

        $.ajax({
        url: "{{ url('/update_user_avatar') }}",
        method:"POST",
        data:new FormData(this),
        contentType: false,
        cache: false,
        dataType: 'JSON',
        processData: false,
        success:function(data)
        {
            console.log(data.errorStatus);
            if (data.errorStatus == 1){
                $('#edit-input-avatar-text').text('An error was found while uploading the image.').css('color', '#D24D57');            
            } else {
                $('.avatar-alert-div').html('<div class="alert alert-success"><div class="fa fa-spinner fa-spin"></div> Profile avatar was changed</div>'); 
                setTimeout(hideAvatarModal, 3000);
            }

        function hideAvatarModal(html){
            $('#avatarModal').modal('hide');
            $.ajax({
            url: "{{ url('/view-profile') }}",
            method: 'GET',
            cache: false,
            success: function(html){
                $('.main-d').html(html);
            }
            });

            }
        }
        });
    });

}
        
</script>
