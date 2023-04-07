$(document).ready(function(){

    var btn_new_photo = $('#btn-new-photo');

    btn_new_photo.on('click', function(){
        $('.modal-title').html('<span style="font-weight:lighter;"><i class="fa fa-camera"></i> Alterar Foto</span>');
        $("#modal-new-photo-user").modal('show');
    });

});