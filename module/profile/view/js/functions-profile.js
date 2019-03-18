Dropzone.autoDiscover = false;
///////////validate update profile
function valide_update_profile(){
	var mailp = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
	
	//console.log("valide_register");
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

	//Password
	if(document.formprofile.tf.value.length === 0){
		$('#protf').addClass('has-error').next('span').addClass('is-visible').html("EL TF ES REQUERIDO");
		document.formprofile.tf.focus();
		return 0;
	}
	$('#protf').removeClass('has-error').next('span').removeClass('is-visible');

	// if(document.formprofile.password.value.length < 6){
	// 	$('#signup-password').addClass('has-error').next().next('span').addClass('is-visible').html("MÁS DE 6 CARACTERES");
	// 	document.formprofile.password.focus();
	// 	return 0;
	// }
	// $('#signup-password').removeClass('has-error').next().next('span').removeClass('is-visible');

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
	///terms
	
}
///////////////// coger datos del ususarios de la bd y pintarlos
function myprofile(){
    $.ajax({
        type:"GET",
        url:"module/profile/controller/controller-profile.class.php?op=load_data_user",
        dataType:"json",
        success: function(data) {
          console.log(data);
          $('#proname').attr('value', data[0].name);
          $('#proemail').attr('value', data[0].email);
          $('#provinciaini').attr('value', data[0].province);
          $('#selcity').attr('value', data[0].city);
        },
        error: function (data){
          console.log("not user");
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
	//$('#myprofile').html(' <h2 class="flex1"> My Profile </h2>');
	myprofile();
	//change tabs
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value  
		$(activeTab).fadeIn(); //Fade in the active ID content

		if (activeTab==='#myfavorites'){
			$('#myfavorites').html(' <h2 class="flex1"> My Favorites </h2>');
		}
		if (activeTab==='#mypurchases'){
			$('#mypurchases').html(' <h2 class="flex1"> My Purchases </h2><p>Hello hello my name is Federico</p>');
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
    $("#formprofile").submit(function (e) {
        console.log('superprofile!!')
        e.preventDefault();
        valide_update_profile();
    })
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



