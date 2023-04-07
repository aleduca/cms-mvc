$(document).ready(function(){

	var btn_permisison = $('.btn-permission');

	btn_permisison.on('click', function(event){
		event.preventDefault();

		var data = $(this).attr('data-action');

		$.ajax({
			url:'/adminPermissoes/update',
			data:'data='+data,
			type:'post',
			success: function(response){
				console.log(response);

				if(response == 'atualizado'){
					swal('Atualizado','Atualizado com sucesso','success');
				}

				setTimeout(function(){
					location.reload();
				},3000);

			}
		});

	});

});