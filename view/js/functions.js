////url
function tryurl(){
	if(window.location.href==='http://localhost/www/EDEN/'){
        url1='';
    }else{
        url1='../../';
	}
	return url1;
}

///pretty url
function amigable(url) {
  var link="";
  url = url.replace("?", "");
  url = url.split("&");
  cont = 0;
  for (var i=0;i<url.length;i++) {
    cont++;
      var aux = url[i].split("=");
     
      if (cont == 2) {
        link +=  "/"+aux[1]+"/";	
      }else{
        link +=  "/"+aux[1];
      }
      
  }
  return "http://localhost/www/EDEN" + link;
}
///FUNCTION FOR EXTERN VARIABLES
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable) {
            return pair[1];
        }
    }
    return false;
 }

 ///km aleatorios entre 2 numeros
 function numeroAleatorio(min, max) {
    var num=Math.round(Math.random() * (max - min) + min);
    //console.log(num);
    return num;
    }
////protect url
  function protecturl() {
      /////////protect url
      $.ajax({
        type : 'GET',
        //url  : 'model/functions.php?op=controluser',
        url  : 'components/login/controller/controller-login.php?&op=controluser',
        //dataType: 'json',
    })
      .done(function(data){			
        console.log(data)		
        if(data=="okay"){
            setTimeout(' window.location.href = "index.php?page=controllerhome&op=list"; ',1000);
        }else if (data=="ok"){
          loginauto();
              //setTimeout(' window.location.href = "index.php?page=controllerhome&op=list"; ',1000);
              
          }
      })
      .fail( function(response){console.log(response)	});
      }
 ///////////eliminar acentos     
 function quitaAcentos(str){ 
        for (var i=0;i<str.length;i++){ 
        //Sustituye "á é í ó ú" 
        //console.log(str.charAt(i));
        if (str.charAt(i)=="á") str = str.replace("á","a"); 
        if (str.charAt(i)=="à") str = str.replace("à","a"); 
        if (str.charAt(i)=="é") str = str.replace(/é/,"e"); 
        if (str.charAt(i)=="í") str = str.replace(/í/,"i"); 
        if (str.charAt(i)=="ó") str = str.replace(/ó/,"o"); 
        if (str.charAt(i)=="ú") str = str.replace(/ú/,"u"); 
        if (str.charAt(i)=="Á") str = str.replace("Á","A"); 
        if (str.charAt(i)=="À") str = str.replace("À","A"); 
        if (str.charAt(i)=="É") str = str.replace(/É/,"E"); 
        if (str.charAt(i)=="Í") str = str.replace(/Í/,"I"); 
        if (str.charAt(i)=="Ó") str = str.replace(/Ó/,"O"); 
        if (str.charAt(i)=="Ú") str = str.replace(/Ú/,"U"); 
        } 
        //console.log(str);
        return str; 
  } 

  
$(document).ready(function(){
    
    // function datePic() {
       
    $("#datepicker").datepicker({
            firstDay: 1,
            language: "es",
            dateFormat: 'dd/mm/yy', 
            changeMonth: true, 
            changeYear: true, 
            maxDate: "+0M, +0D",
            yearRange: '1890:2050',
            onSelect: function(value, ui) {
        }
    });
    $("#datepicker2").datepicker({
            firstDay: 1,
            language: "es",
            dateFormat: 'dd/mm/yy', 
            changeMonth: true, 
            changeYear: true, 
            maxDate: "+0M, +0D",
            yearRange: '1990:2050',
            showButtonPanel: true,
            onSelect: function(selectedDate) {
        }
    });



//////////    TOASTR
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "show",
    "hideMethod": "fadeOut"
  }
/////////// MENU
      urlgen=tryurl();
      //console.log(urlgen+'login/controluser');
      var token = localStorage.getItem("id_token");
      if (token) {
          $.ajax({
            type : 'POST',
            url:amigable('?module=login&function=controluser'),
            //url  : urlgen+'login/controluser',
            data :{'token':token},
            dataType: 'json',
          })
          .done(function(data){	
            console.log(data);
            //localStorage.setItem("id_token", data[1]);
            //console.log(localStorage.getItem("id_token"));
                if (data != 'error') {
                    console.log(data[0].type);
                    if ((data[0].type === 'client_rs')||(data[0].type === 'client')) {
                      console.log('menuuuuu');
                      $('.sf-menu').empty();
                      $('.sf-menu').html(
                        '<li><a href="'+amigable('?module=home&function=list_home')+'" data-tr="Inicio"></a></li>'+							
                        '<li><a href="'+amigable('?module=shop&function=list_shop')+'" data-tr="Tienda" id="btnshop"></a></li>'+
                        '<li><a href="'+amigable('?module=contact&function=list_contact')+'" data-tr="Contacto"></a></li>'+
                       '<li><a href="'+amigable('?module=cart&function=view')+'"><i class="fa fa-shopping-cart"><span>0</span></i></a></li>'+
                       '<li><a id="menuprofile">  <img id="avatar"></a>'+
                          '<ul id="submenu">'+
                            '<li><a id="btnprofile" href="'+amigable('?module=profile&function=view')+'" data-tr="Perfil"></a></li>'+
                            '<li><a id="btnlogout" data-tr="Salir"></a></li>'+
                          '</ul>'+
                        '</li>'
                      );

                       
                     }
                     if(data[0].type === 'admin'){
                        $('.sf-menu').empty();
                        $('.sf-menu').html(
                          '<li><a href="'+amigable('?module=home&function=list_home')+'" data-tr="Inicio"></a></li>'+
                          '<li><a href="'+amigable('?module=crud&functions=list')+'" data-tr="CRUD"></a></li>'+
                          '<li><a href="'+amigable('?module=shop&function=list_shop')+'" data-tr="Tienda" id="btnshop"></a></li>'+
                          '<li><a href="'+amigable('?module=contact&function=list_contact')+'" data-tr="Contacto"></a></li>'+
                          '<li><a href="'+amigable('?module=cart&function=view')+'"><i class="fa fa-shopping-cart"><span>0</span></i></a></li>'+
                          '<li><a id="menuprofile">  <img id="avatar"></a>'+
                            '<ul id="submenu">'+
                              '<li><a id="btnprofile" href="'+amigable('?module=profile&function=view')+'" data-tr="Perfil"></a></li>'+
                              '<li><a id="btnlogout" data-tr="Salir"></a></li>'+
                            '</ul>'+
                          '</li>'
                      )
                      }
                      $('#menuprofile').prepend(data[0].user);
                      $('#avatar').attr("src", data[0].avatar);
  
                      $('#menuprofile').on('click', function(){
                            $('#submenu').toggle( "slow" );
                      })
                      $('#contenido').on('click', function(){
                            $('#submenu').fadeOut( "slow" );
                      })
                }else{
                      }
            })
            .fail(function(data,response){
              console.log(data);
            })
      }else{
      }

////////////logout inactivity
  setInterval(function(){ 
		$.ajax({
			type : 'POST',
      //url  : urlgen+'login/actividad',
      url: amigable('?module=login&function=actividad'),
			success :  function(response){
        response=response.trim();						
				if(response=="inactivo"){
                    alert("Se ha cerrado la cuenta por inactividad");
                    logoutauto();
					//setTimeout('window.location.href = "components/login/controller/controller-login.php?&op=logout";',1000);
				}
			}
		});
  }, 220000);
  
  
});/////////end ready
