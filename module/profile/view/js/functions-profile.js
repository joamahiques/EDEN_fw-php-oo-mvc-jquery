Dropzone.autoDiscover = false;
$(document).ready(function(){
////////////////////////////////tabs
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	///my profile
	//$('#myprofile').html(' <h2 class="flex1"> My Profile </h2>');
	
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
            if(file.status == "success"){
            alert("El archivo se ha subido correctamente: " + file.name);
            }
        },
        error: function (file) {
            alert("Error subiendo el archivo " + file.name);
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

///////////////////////////para que no se vacie el formulario
		$.get("module/profile/controller/controller-profile.class.php?op=load_data",
		function(response){
		  if(response.profile===""){
			  console.log('aqui1');
			
		  }else{
			console.log('aqui2');
			$("#proname").val(response.profile.proname);
			$("#proemail").val(response.profile.proemail);
			$("#propassword").val(response.profile.propassword);
			$("#provinciaini").val(response.profile.province);
			$('#selcity').val(response.profile.city);
			
		  }
		}, "json");

})



