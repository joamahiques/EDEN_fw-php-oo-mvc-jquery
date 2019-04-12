
function tryurl(){
	if(window.location.href=='http://localhost/www/EDEN/'){
        url1='';
    }else{
        url1='../../';
	}
	return url1;
}


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
    "progressBar": false,
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
/////////// Pintar en el menú el profile
  if (document.getElementById('btnprofile')){
    $('#menuprofile').prepend(localStorage.getItem("user"));
    $('#avatar').attr("src", localStorage.getItem("avatar"));
    //console.log(localStorage.getItem("avatar"));
    //   console.log("profile");
    //   console.log(localStorage.getItem("user"));
      $('#menuprofile').on('click', function(){
            $('#submenu').toggle( "slow" );
      })
      $('#contenido').on('click', function(){
             $('#submenu').fadeOut( "slow" );
      })
  }
////////////logout inactivity
  setInterval(function(){ 
		$.ajax({
			type : 'GET',
			url  : 'components/login/controller/controller-login.php?&op=actividad',
			success :  function(response){						
				if(response=="inactivo"){
                    alert("Se ha cerrado la cuenta por inactividad");
                    logoutauto();
					//setTimeout('window.location.href = "components/login/controller/controller-login.php?&op=logout";',1000);
				}
			}
		});
  }, 120000);
  
  
});/////////end ready
