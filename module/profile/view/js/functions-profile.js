Dropzone.autoDiscover = false;
///////////validate update profile
function valide_update_profile(){
	var mailp = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
	var phoneval = /^(\+34|0034|34)?[6|7|9][0-9]{8}$/;
	
	//User
	if(document.formprofile.user.value.length === 0){
		$('#proname').addClass('has-error').next('span').addClass('is-visible').html("EL USER ES REQUERIDO");;
		document.formprofile.user.focus();
		return 0;
	}
	
	$('#proname').removeClass('has-error').next('span').removeClass('is-visible');

	//Mail
	if(document.formprofile.mail.value.length === 0){
		$('#proemail').addClass('has-error').next('span').addClass('is-visible').html("EL MAIL ES REQUERIDO");

		document.formprofile.mail.focus();
		return 0;
	}
	$('#proemail').removeClass('has-error').next('span').removeClass('is-visible');

	if(!mailp.test(document.formprofile.mail.value)){
		$('#proemail').addClass('has-error').next('span').addClass('is-visible').html("FORMATO DE MAIL NO VÁLIDO");
		document.formprofile.mail.focus();
		return 0;
	}
	$('#proemail').removeClass('has-error').next('span').removeClass('is-visible');

	//tf
	// if(document.formprofile.tf.value.length === 0){
	// 	$('#protf').addClass('has-error').next('span').addClass('is-visible').html("EL TF ES REQUERIDO");
	// 	document.formprofile.tf.focus();
	// 	return 0;
	// }
	// $('#protf').removeClass('has-error').next('span').removeClass('is-visible');
	if(document.formprofile.tf.value.length != 0){
		if(!phoneval.test(document.formprofile.tf.value)){
			$('#protf').addClass('has-error').next('span').addClass('is-visible').html("FORMATO NO VÁLIDO");
			document.formprofile.password.focus();
			return 0;
		}
		$('#protf').removeClass('has-error').next('span').removeClass('is-visible');
	}
	//Password
	if(document.formprofile.propassword.value.length === 0){
		$('#propassword').addClass('has-error').next().next('span').addClass('is-visible').html("LA CONTRASEÑA ES REQUERIDA");
		document.formprofile.propassword.focus();
		return 0;
	}
	$('#propassword').removeClass('has-error').next().next('span').removeClass('is-visible');

	if(document.formprofile.propassword.value.length < 6 ){
		$('#propassword').addClass('has-error').next().next('span').addClass('is-visible').html("MÁS DE 6 CARACTERES");
		document.formprofile.propassword.focus();
		return 0;
	}
	$('#propassword').removeClass('has-error').next().next('span').removeClass('is-visible');
	
	
}
///////////////// coger datos del ususarios de la bd y pintarlos
function myprofile(){
    $.ajax({
        type:"GET",
        url:"module/profile/controller/controller-profile.class.php?op=load_data_user",
        dataType:"json",
        success: function(data) {
		  //console.log(data[0].province);
		//  data[0].province='VALENCIA';
		//   data[0].city='XÀTIVA';
          $('#proname').attr('value', data[0].name);
		  $('#proemail').attr('value', data[0].email);
		  setTimeout(function(){
			if (typeof data[0].province != 'undefined' && data[0].province) {
				console.log('provi');
				$("#provinciaini").val(data[0].province);
				$("#provinciaini").trigger('change');
				}}, 550);
		  setTimeout(function(){
				if (typeof data[0].city != 'undefined' && data[0].city) {
				  console.log('citi');
				$("#selcity").val(data[0].city);	
				}
			}, 850);
        },
        error: function (data){
          console.log("not user");
          console.log(data);
        }
      })
}
function myprofilefavorites(){
	$.ajax({
        type:"GET",
        url:"module/profile/controller/controller-profile.class.php?op=load_data_favorites",
        dataType:"json",
        success: function(data) {
		  //console.log(data);
		  $('#myfavorites').html('<table width=100% id="tableFavorites">'+
                '<thead>'+
                    '<tr>'+
                        '<td><b>Nombre</b></th>'+
                        '<td><b>Localidad</b></th>'+
                        '<td><b>Provincia</b></th>'+
                        '<td><b>Capacidad</b></th>'+
                        '<td><b>Completa</b></th>'+
                    	'<td><b>Eliminar</b></th>'+
                    '</tr>'+
               ' </thead>'+
				'<tbody id="bodyfavo">'+

				'</tbody>'+'</table>')
				$.each(data, function(index, list) {
					$("#bodyfavo").append("<tr><td>" + list.nombre + "</td>"+
									"<td id='localidad'>" +list.localidad + "</td>"+
									 "<td id='provincia'>" +list.provincia+"</td>"+
									 "<td id='capacidad'>" +list.capacidad+"</td>"+
									 "<td id='completa'>" +list.entera+"</td>"+
									 "<td class='center'><a class='deletefavorite' id='" + list.nombre + "'><i class='fas fa-check'></i></a></td>")					 
				});
         
        },
        error: function (data){
          console.log("not favorites");
          console.log(data);
        }
      })
}

function myprofilepurchases(){
	$.ajax({
        type:"GET",
        url:"module/profile/controller/controller-profile.class.php?op=load_data_purchases",
        dataType:"json",
        success: function(data) {
		  console.log(data);
		  $('#mypurchases').html('<table width=100% id="tablePurchases">'+
                '<thead>'+
                    '<tr>'+
                        '<td><b>Código</b></th>'+
                        '<td><b>Nombre</b></th>'+
                        '<td><b>Fecha</b></th>'+
                        '<td><b>Cantidad</b></th>'+
                        '<td><b>Precio</b></th>'+
                    	'<td><b>Total</b></th>'+
                    '</tr>'+
               ' </thead>'+
				'<tbody id="bodypur">'+

				'</tbody>'+'</table>')
				for (var i in data) {
					var item = data[i];
					var row = "<tr><td>" + item.codigo + "</td>"+
								"<td>" +item.nombre + "</td>"+
								 "<td>" +item.fecha+"</td>"+
								 "<td>" +item.cantidad+"</td>"+
								 "<td>" +item.precio+"€</td>"+
								 "<td class='center'>" +item.total+"€</td>";
					$("#bodypur").append(row);
			
				}
		},
        error: function (data){
          console.log("not purchases");
          console.log(data);
        }
      })
}

$(document).ready(function(){
////////////////////////////////tabs
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	///my profile
	myprofile();
	//change tabs
	var $activeTab;
	$("ul.tabs li").click(function() {
		
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		$activeTab = $(this).find("a").attr("href"); //Find the href attribute value  
		$($activeTab).fadeIn(); //Fade in the active ID content
		console.log($activeTab);
		if ($activeTab==='#myfavorites'){
			myprofilefavorites()
			setTimeout(function(){$('#tableFavorites').DataTable();}, 50);
			
		}
		if ($activeTab==='#mypurchases'){
			
			$('#mypurchases').html(' <h2 class="flex1"> My Purchases </h2><p>Hello hello my name is Federico</p>');
			myprofilepurchases()
			setTimeout(function(){$('#tablePurchases').DataTable();}, 50);
		}
		
	});

/////////////Dropzone function //////////////////////////////////
    $("#dropzone").dropzone({
        url: "module/profile/controller/controller-profile.class.php?op=uploadimg",
        addRemoveLinks: true,
        maxFileSize: 1000,
        dictResponseError: "An error has occurred on the server",
        acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd',
        init: function () {
            this.on("success", function (file, response) {
                //alert(response);
                $("#progress").show();
                $("#bar").width('100%');
                $("#percent").html('100%');
                $('.msg').text('').removeClass('msg_error');
                $('.msg').text('Success Upload image!!').addClass('msg_ok').animate({'right': '300px'}, 300);
                console.log(file.name);
                console.log("Response: "+response);
            });
        },
        complete: function (file) {
            // if(file.status == "success"){
            // alert("El archivo se ha subido correctamente: " + file.name);
            // }
        },
        error: function (file) {
            // alert("Error subiendo el archivo " + file.name);
        },
        removedfile: function (file, serverFileName) {
            var name = file.name;
            console.log(name);
            $.ajax({
                type: "POST",
                url: "module/profile/controller/controller-profile.class.php?op=delete",
                data: "filename=" + name,
                success: function (data) {
                  console.log(data);
                    $("#progress").hide();
                    $('.msg').text('').removeClass('msg_ok');
                    $('.msg').text('').removeClass('msg_error');
                    $("#e_avatar").html("");
                    
                    var element2;
                    if ((element2 = file.previewElement) !== null) {
                        element2.parentNode.removeChild(file.previewElement);
                    } else {
                        return false;
                    }
                }
            });
        }
	});//End dropzone

/////////////////////CHange Password
//show change-password form 
	$('#changepass').on('click', function(event){
		event.preventDefault();
		console.log("change");

		$('.cd-pass-modal').addClass('is-visible');

	});
	$('.cd-pass-modal').on('click', function(event){
		if( $(event.target).is($('.cd-pass-modal')) || $(event.target).is($('#closepass') )) {
			console.log('close');
			$('.cd-pass-modal').removeClass('is-visible');
		}	
	});
	//close modal when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-pass-modal').removeClass('is-visible');
	    }
	});

//////////////////////////////delete favorites
	$(document).on('click','.deletefavorite',function(){
		console.log('delete');
		var nombre = this.getAttribute('id');
		console.log(nombre);
			$.ajax({
				type:"GET",
				url:"module/profile/controller/controller-profile.class.php?op=delete_favorites&nombre="+nombre,
				dataType:"json",
				success: function(data) {
				console.log(data);
				location.reload();/////////mejor almacenar favoritos en un array e ir eliminando como en cart
				
				},
				error: function (data){
				console.log("not delete");
				console.log(data);
				}
			})
	})

/////////////////////////SEND FORM update profile
    $("#formprofile").submit(function (e) {
        //console.log('superprofile!!')
        e.preventDefault();
		if(valide_update_profile() != 0){
		////////////////////////////////////////////////
			var data = $("#formprofile").serialize();
			//var data_profile_JSON = JSON.stringify(data);
			console.log(data);
			//console.log(data_profile_JSON);
			$.post('module/profile/controller/controller-profile.class.php?op=update_profile',
          		{update_profile_json:data},
      		function (response){
        		console.log(response);//Aqui muestra los resultados de PHP
        		console.log(response.user);
        
    		},"json").fail(function(xhr, textStatus, errorThrown){console.log(xhr)})
			// $.ajax({
			// 	type : 'POST',
			// 	url  : "module/profile/controller/controller-profile.class.php?op=update_profile&"+data,
			// 	data :data,
			// 	dataType: 'json',
			// 	beforeSend: function(){	
			// 		$("#error_login").fadeOut();
			// 	}
			// })
			// .done(function(data){			
			// 	console.log(data)		
				// if(data!=""){
					
				// }else if(data=="No coinciden los datos") {
				// 	console.log("error-login fallo logeandote");
				// 		$("#error_update").fadeIn(1000, function(){						
				// 			$("#error_update").addClass('has-error').children('span').addClass('is-visible').html(data);

				// 		});
				// }///end if
			// })
			// .fail(function( data, textStatus, jqXHR ) {
				//console.log(data);
				// $("#error_update").fadeIn(1000, function(){						
				// 	$("#error_update").addClass('has-error').children('span').addClass('is-visible').append("EL USUARIO YA EXISTE");

				// });
	// 			console.log("fallo update login");
	// 		});
	 	};///end if
	 });
   
///////////////////////////para que no se vacie el formulario
		// $.get("module/profile/controller/controller-profile.class.php?op=load_data",
		// function(response){
		//   if(response.profile===""){
		// 	  console.log('aqui1');
			
		//   }else{
		// 	console.log('aqui2');
		// 	$("#proname").val(response.profile.proname);
		// 	$("#proemail").val(response.profile.proemail);
		// 	$("#propassword").val(response.profile.propassword);
		// 	$("#provinciaini").val(response.profile.province);
		// 	$('#selcity').val(response.profile.city);
			
		//   }
		// }, "json");

})