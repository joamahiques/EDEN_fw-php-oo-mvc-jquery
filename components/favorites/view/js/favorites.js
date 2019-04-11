
///////////////////////////////FAVORITOS

//console.log("Favorites");   
function readmyfavorites(){
    if(localStorage.getItem("user")!=null){
        $.ajax({
                
            type: "GET",
            dataType: "json",
            //url: "components/favorites/controller/controllerfavorites.php?op=readfavorites",
            url: '../../favorites/read_favorites'
        })
        .done(function( data, textStatus, jqXHR ) {
        //console.log( data );
            $.each(data, function(i, item) {///bucle para buscar los elementos que coincidan con los id de favoritos y los pintamos
                // console.log( item.nombre );
                var id= document.getElementById(item.nombre);
                //var id2= $('"#'+item.nombre+'"')
                // console.log( id );
                //console.log( id2 );
                $(id).children("i").addClass("fas");    
            });

        });  
    }
}
$(document).ready(function () {

   
    setTimeout(function(){
    ////leemos favoritos para que aparezcan los corazones pintados
    readmyfavorites();
    
///añadir o borrar de favoritos
   
    $(document).on("click",".corazon", function () {
        if(localStorage.getItem("user")===null){

            loginauto();
            
                    
        }else{
   
                    var id = this.getAttribute('id');
                // console.log(id);
                    
                    if($(this).children("i").hasClass("fas")){///si está en favoritos, borralo
                        
                        $(this).children("i").removeClass("fas");//cambiamos la clase al corazón para que se despinte
                            
                            $.ajax({
                            
                                type: "GET",
                                dataType: "json",
                                url: "components/favorites/controller/controllerfavorites.php?op=favoritesDelete&id=" + id+"&email="+localStorage.getItem("email"),
                            })
                            
                            .done(function( data, textStatus, jqXHR ) {
                            // console.log("si es favorito22");
                                
                            });
                    
                    }else{ //si no está en favoritos, agrégalo
                        
                        $(this).children("i").addClass("fas");///añadimos la clase FAS, corazón pintado
                        console.log(localStorage.getItem("email"));
                            $.ajax({
                                    
                                type: "GET",
                                dataType: "json",
                                url: "components/favorites/controller/controllerfavorites.php?op=favorites&id=" + id+"&email="+localStorage.getItem("email"),
                            })
                            .done(function( data, textStatus, jqXHR ) {
                                
                            
                            });
                    }//end if
        }//end if
    });

}, 500);
});