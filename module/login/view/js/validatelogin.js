var userProfile;
function valide_login(){
	// var mailp = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
	//console.log("valide_login");

	//Mail
	if(document.formlogin.user.value.length === 0){
		//document.getElementById('e_mail').innerHTML = "Tienes que escribir el mail";
		$('#signin-username').addClass('has-error').next('span').addClass('is-visible').html("EL NOMBRE DE USUARIO ES REQUERIDO");
		document.formlogin.user.focus();
		return 0;
	}
	$('#signin-username').removeClass('has-error').next('span').removeClass('is-visible');

	// if(!mailp.test(document.formlogin.mail.value)){
	// 	//document.getElementById('e_mail').innerHTML = "El formato del mail es invalido";
	// 	$('#signin-email').addClass('has-error').next('span').addClass('is-visible').html("EL FORMATO DE MAIL NO ES VÁLIDO");
	// 	document.formlogin.mail.focus();
	// 	return 0;
	// }
	// $('#signin-email').removeClass('has-error').next('span').removeClass('is-visible');
	//document.getElementById('e_mail').innerHTML = "";
	//Password
	if(document.formlogin.password.value.length === 0){
		console.log("pass");
		$('#signin-password').addClass('has-error').next().next('span').addClass('is-visible').html("LA CONTRASEÑA ES REQUERIDA");
		document.formlogin.password.focus();
		return 0;
	}
	//document.getElementById('e_password').innerHTML = "";
	$('#signin-password').removeClass('has-error').next().next('span').removeClass('is-visible');

	//document.formlogin.click();//click
	//document.formlogin.action="index.php?page=controller_login&op=list_login";
	
}

function valide_register(){
	var mailp = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
	
	//console.log("valide_register");
	//User
	
	if(document.formregister.user.value.length === 0){
		$('#signup-username').addClass('has-error').next('span').addClass('is-visible').html("EL USER ES REQUERIDO");;
		document.formregister.user.focus();
		return 0;
	}
	
	$('#signup-username').removeClass('has-error').next('span').removeClass('is-visible');

	//Mail
	if(document.formregister.mail.value.length === 0){
		$('#signup-email').addClass('has-error').next('span').addClass('is-visible').html("EL MAIL ES REQUERIDO");

		document.formregister.mail.focus();
		return 0;
	}
	$('#signup-email').removeClass('has-error').next('span').removeClass('is-visible');

	if(!mailp.test(document.formregister.mail.value)){
		$('#signup-email').addClass('has-error').next('span').addClass('is-visible').html("FORMATO DE MAIL NO VÁLIDO");
		document.formregister.mail.focus();
		return 0;
	}
	$('#signup-email').removeClass('has-error').next('span').removeClass('is-visible');

	//Password
	if(document.formregister.password.value.length === 0){
		$('#signup-password').addClass('has-error').next().next('span').addClass('is-visible').html("LA CONTRASEÑA ES REQUERIDA");
		document.formregister.password.focus();
		return 0;
	}
	$('#signup-password').removeClass('has-error').next().next('span').removeClass('is-visible');

	if(document.formregister.password.value.length < 6){
		$('#signup-password').addClass('has-error').next().next('span').addClass('is-visible').html("MÁS DE 6 CARACTERES");
		document.formregister.password.focus();
		return 0;
	}
	$('#signup-password').removeClass('has-error').next().next('span').removeClass('is-visible');

	//Repeat Password
	if(document.formregister.rpassword.value.length === 0){
		$('#signup-rpassword').addClass('has-error').next().next('span').addClass('is-visible').html("LA CONTRASEÑA ES REQUERIDA");
		document.formregister.rpassword.focus();
		return 0;
	}
	$('#signup-rpassword').removeClass('has-error').next().next('span').removeClass('is-visible');

	if(document.formregister.rpassword.value != document.formregister.password.value){
		$('#signup-rpassword').addClass('has-error').next().next('span').addClass('is-visible').html("LAS CONTRASEÑAS NO SON IGUALES");
		document.formregister.rpassword.focus();
		return 0;
	}
	$('#signup-rpassword').removeClass('has-error').next().next('span').removeClass('is-visible');
	///terms
	
}

$(document).ready(function(){
///////////AUTH0
var WebAuth = new auth0.WebAuth({
	domain: 'dev-joamahi.eu.auth0.com',
    clientID: '9jz8YMFTP9gdmpBtvdzh7guntVbCZpy9',
    redirectUri: 'http://localhost/www/EDEN/home/list_home/',
    audience: 'https://' + 'dev-joamahi.eu.auth0.com' + '/userinfo',
    responseType: 'token id_token',
    scope: 'openid profile',
    leeway: 60
});

$(document).on('click','#login_auth',function(e){
	e.preventDefault();
	WebAuth.authorize();
});

handleAuthentication();
setTimeout(function(){ getProfile(); }, 1000);
function handleAuthentication() {
    WebAuth.parseHash(function(err, authResult) {
      if (authResult && authResult.accessToken && authResult.idToken) {
        window.location.hash = '';
        setSession(authResult);
      } else if (err) {
        console.log(err);
        //alert('Error: ' + err.error + '. Check the console for further details.');
      }
      
    });
  }
  function getProfile() {
    if (!userProfile) {
      var accessToken = localStorage.getItem('token');
      if (!accessToken) {
      }else{
        WebAuth.client.userInfo(accessToken, function(err, profile) {
          console.log(profile);
        //   if (profile) {
        //     id_profile = profile.sub.split('|');
        //     $.post(amigable("?module=login&function=log_social"),{'data_social_net':JSON.stringify({'id_user':id_profile[1],'user':profile.nickname,'email':profile.nickname + "@gmail.com",'avatar':profile.picture})},function(data){
        //         localStorage.removeItem('id_token');
        //         localStorage.setItem('id_token',JSON.parse(data));
        //         localStorage.removeItem('access_token');
        //         localStorage.removeItem('expires_at');

        //         Command: toastr["success"]("Inicio de sesión correcto", "Iniciando sesion");
        //         setTimeout(function(){ window.location.href = amigable("?module=home&function=list_home"); }, 3000);
        //     });
        //   }
        });
      }
    }
  }
  function setSession(authResult) {
    // Set the time that the access token will expire at
    var expiresAt = JSON.stringify(
      authResult.expiresIn * 1000 + new Date().getTime()
    );
    localStorage.setItem('token', authResult.accessToken);
    localStorage.setItem('id_token', authResult.idToken);
    localStorage.setItem('expires_at', expiresAt);
  }
//////////////login	
	$("#formlogin").submit(function (e) {
		console.log("valide_login11");
		e.preventDefault();
		url1=tryurl();
		if(valide_login() != 0){
			var data1 = $("#formlogin").serialize();
			//var data=$("#signin-password").val();
			console.log(data1);
			$.ajax({
				type : 'POST',
				url  : url1+'login/login',
				data :data1,
				dataType: 'json',
				beforeSend: function(){	
					$(".has-error").removeClass('has-error');
				}
			})
			.done(function(data, response){			
				
				if(data[0]=='false'){
					//console.log('errorrrr');
					if(data[1]=='La contraseña no es correcta'){
						$('#signin-password').addClass('has-error').next().next('span').addClass('is-visible').html(data[1]);
					}else{
						$('#signin-username').addClass('has-error').next('span').addClass('is-visible').html(data[1]);
					// $("#error_login").fadeIn(1000, function(){						
					// 	$("#error_login").addClass('has-error').children('span').addClass('is-visible').html(data[1]);
					// 	});
					}
				}else{
					localStorage.setItem('token',data);
					toastr["info"]('Iniciando sesión'),{"iconClass":'toast-info'};
					//logincart();
					//setTimeout('window.location.href = "http://localhost/www/EDEN/home/list_home/";',4000);
					// 	localStorage.setItem("user", data.name);
				// 	localStorage.setItem("type", data.type);
				// 	localStorage.setItem("avatar", data.avatar);
				// 	localStorage.setItem("email", data.email);
				// 	logincart();
				}
				
			})
			.fail(function( data, success, jqXHR ) {
				toastr["error"]("ERROR DE CONEXION. PRUEBE MAS TARDE"),{"iconClass":'toast-info'};
				//setTimeout('window.location.href = "http://localhost/www/EDEN/home/list_home/";',4000);
			});
	 	};///end if
	 });
////////////register
	$("#formregister").submit(function (e) {
		e.preventDefault();
		url1=tryurl();
		if (valide_register() != 0) {
			var data1 = $("#formregister").serialize();
			//console.log(data);
			$.ajax({
				type : 'POST',
				url : url1+'login/register',
				data : data1,
				beforeSend: function(){	
					//console.log(data)
					$("#error_register").fadeOut();
				}
			})
			////si nos registramos: 
				.done(function(response,data,jqXHR ) {
					console.log(response);
					///// autologin una vez registrado
					if(response=="            ok"){
						 toastr["success"]('Revisa tu correo para activar tu cuenta'),{"iconClass":'toast-info'};
						 setTimeout('window.location.href = "http://localhost/www/EDEN/home/list_home/";',4000);
					}else if (response=="            Error") {
						toastr["info"]('Fallo de conexión. Prueba mas tarde'),{"iconClass":'toast-info'};
						setTimeout('window.location.href = "http://localhost/www/EDEN/home/list_home/";',4000);					// 	setTimeout(' window.location.href = window.location.href; ',1000);
					 }else{
						//console.log("error-register fallo validateloginphp");
						$("#error_register").fadeIn(1000, function(){						
							$("#error_register").addClass('has-error').children('span').addClass('is-visible').html(response);

						});
					}
				})
				.fail(function( response, data, jqXHR ) {
					toastr["info"]('Fallo de conexión. Prueba mas tarde'),{"iconClass":'toast-info'};
					setTimeout('window.location.href = "http://localhost/www/EDEN/home/list_home/";',3000);
				})
			
		
		}
	});

///////////logout
	$("#btnlogout").on('click', function () {
		//console.log("logout!!!!!");
		deletelogout()
		logoutauto();
		
		
	});

//////////////////////////////

	var $form_modal = $('.cd-user-modal'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup'),
		$form_forgot_password = $form_modal.find('#cd-reset-password'),
		$form_modal_tab = $('.cd-switcher'),
		$tab_login = $form_modal_tab.children('li').eq(0).children('a'),
		$tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
		$forgot_password_link = $form_login.find('.cd-form-bottom-message a'),
		$back_to_login_link = $form_forgot_password.find('.cd-form-bottom-message a'),
		$main_nav = $('.main-nav');

	//open modal
	$main_nav.on('click', function(event){
		//console.log($form_modal);
			// clean before open
			$("#formregister")[0].reset();
			$("#formlogin")[0].reset();
			$(".has-error").removeClass('has-error');
			$('.is-visible').removeClass('is-visible');
			$form_modal.addClass('is-visible');	
			//show the selected form
			( $(event.target).is('.cd-signup') ) ? signup_selected() : login_selected();
	});

	//close modal
	$('.cd-user-modal').on('click', function(event){
		//console.log(localStorage.getItem('type'));
		if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
			$form_modal.removeClass('is-visible');
			
			if((!localStorage.getItem('type'))||(localStorage.getItem('type')!='admin')){
				 window.location.href = "http://localhost/www/EDEN/home/list_home/"; 
			}
		}	
	});
	//close modal when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$form_modal.removeClass('is-visible');
	    }
	});

	

	//switch from a tab to another
	$form_modal_tab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( $tab_login ) ) ? login_selected() : signup_selected();
	});

	//hide or show password
	$('.hide-password').on('click', function(){
		var $this= $(this),
			$password_field = $this.prev('input');
		
		( 'password' == $password_field.attr('type') ) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
		( 'Hide' == $this.text() ) ? $this.text('Show') : $this.text('Hide');
		//focus and move cursor to the end of input field
		$password_field.putCursorAtEnd();
	});

	//show forgot-password form 
	$forgot_password_link.on('click', function(event){
		event.preventDefault();
		forgot_password_selected();
	});

	//back to login from the forgot-password form
	$back_to_login_link.on('click', function(event){
		event.preventDefault();
		login_selected();
	});

	function login_selected(){
		$form_login.addClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.addClass('selected');
		$tab_signup.removeClass('selected');
	}

	function signup_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.addClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.removeClass('selected');
		$tab_signup.addClass('selected');
	}

	function forgot_password_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.addClass('is-selected');
	}

	//REMOVE THIS - it's just to show error messages 
	$form_login.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		$form_login.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
	});
	$form_signup.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		$form_signup.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
	});




	//IE9 placeholder fallback
	//credits http://www.hagenburger.net/BLOG/HTML5-Input-Placeholder-Fix-With-jQuery.html
	// if(!Modernizr.input.placeholder){
	// 	$('[placeholder]').focus(function() {
	// 		var input = $(this);
	// 		if (input.val() == input.attr('placeholder')) {
	// 			input.val('');
	// 	  	}
	// 	}).blur(function() {
	// 	 	var input = $(this);
	// 	  	if (input.val() == '' || input.val() == input.attr('placeholder')) {
	// 			input.val(input.attr('placeholder'));
	// 	  	}
	// 	}).blur();
	// 	$('[placeholder]').parents('form').submit(function() {
	// 	  	$(this).find('[placeholder]').each(function() {
	// 			var input = $(this);
	// 			if (input.val() == input.attr('placeholder')) {
	// 		 		input.val('');
	// 			}
	// 	  	})
	// 	});
	// }

});


//credits https://css-tricks.com/snippets/jquery/move-cursor-to-end-of-textarea-or-input/
jQuery.fn.putCursorAtEnd = function() {
	return this.each(function() {
    	// If this function exists...
    	if (this.setSelectionRange) {
      		// ... then use it (Doesn't work in IE)
      		// Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
      		var len = $(this).val().length * 2;
      		this.setSelectionRange(len, len);
    	} else {
    		// ... otherwise replace the contents with itself
    		// (Doesn't work in Google Chrome)
      		$(this).val($(this).val());
    	}
	});
};

function logoutauto(){
	$.ajax({
		type : 'GET',
		url  : 'components/login/controller/controller-login.php?&op=logout',
	})
		.done(function() {
			
			localStorage.removeItem('user');
			localStorage.removeItem('avatar');
			localStorage.removeItem('type');
			localStorage.removeItem('email');
			deletelogout();
			setTimeout(' window.location.href = "index.php?page=controllerhome&op=list"; ',1000);
			

	})
}
function loginauto(){
	//console.log("madre mia");
					var $form_modal = $('.cd-user-modal'),
                    $form_login = $form_modal.find('#cd-login'),
                    $form_signup = $form_modal.find('#cd-signup'),
                    $form_forgot_password = $form_modal.find('#cd-reset-password'),
                    $form_modal_tab = $('.cd-switcher'),
                    $tab_login = $form_modal_tab.children('li').eq(0).children('a'),
                    $tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
                    $forgot_password_link = $form_login.find('.cd-form-bottom-message a'),
                    $back_to_login_link = $form_forgot_password.find('.cd-form-bottom-message a'),
                    $main_nav = $('.main-nav');
                    
                    $("#formregister")[0].reset();
                    $("#formlogin")[0].reset();
                    $(".has-error").removeClass('has-error');
                    $('.is-visible').removeClass('is-visible');
                    $form_modal.addClass('is-visible');	
                    //show the selected form
                    ( $(event.target).is('.cd-signup') ) ? signup_selected() : login_selected();
                    function login_selected(){
                        $form_login.addClass('is-selected');
                        $form_signup.removeClass('is-selected');
                        $form_forgot_password.removeClass('is-selected');
                        $tab_login.addClass('selected');
                        $tab_signup.removeClass('selected');
                    }
                
                    function signup_selected(){
                        $form_login.removeClass('is-selected');
                        $form_signup.addClass('is-selected');
                        $form_forgot_password.removeClass('is-selected');
                        $tab_login.removeClass('selected');
                        $tab_signup.addClass('selected');
                    }


}