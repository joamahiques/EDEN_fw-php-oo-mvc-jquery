
$(document).ready(function(){

///////////////  AJAX FOR ALL SEARCH
     function ajaxForSearch(durl) {
         var data=durl;
          //console.log(data);
         $.ajax({
            
            type: "POST",
            dataType: "json",
            //url:url,
            url:'../../shop/products',
            data:'page_num=1'+data,
        })
        .done(function( data, textStatus, jqXHR ) {
             //console.log(data);
            
            total_pages=Math.ceil(parseInt(data.totalcount[0].total) / parseInt(6))
           
            if(total_pages<2){
                $("#pagination").hide();
            }
           if(data.results.length==0){
                $('#inicioshop').empty();
                $('<div><h3>Su búsqueda no dió resultados.</h3></div>').attr('id','list').appendTo('#inicioshop');
           }else{
                //console.log(data);
                $('#inicioshop').empty();
                $.each(data.results, function(index, list) {
                    // console.log(data);
                    // console.log(index);
                    $('#inicioshop').append(
                        '<div class="grid">'+ 
                        '<div class="text1 flex">'+ list.nombre + '<a class="corazon" id="'+list.nombre+'"><i class="far fa-heart" ></i></a></div>'+
                        '<br><span>Localidad:   <span id="localidad">'+list.localidad+'</span></span></br>'+
                        '<br><span>Provincia:   <span id="prov">'+list.provincia+'</span></span></br>'+
                        '<br><span>Capacidad Total:     <span id="capacidad">'+list.capacidad+'</span></span></br>'+
                        '<div class="fright">'+
                        '<a  class="read"  id="'+list.nombre+'">READ MORE</a>'+
                        '</div>'+
                        '</div>'
                        
                    ).fadeIn(1000)
                });//end each
             //////// pagination
                    $("#pagination").bootpag({
                        total: total_pages,
                        page: 1,
                        maxVisible: 3,
                        leaps: true,
                        next: '>>',
                        prev: '<<',
                        // href: '#result-page-{{number}}'
                    }).on("page", function (e, num) {
                        //console.log(num);
                        e.preventDefault();
                        $.ajax({
            
                            type: "post",
                            dataType: "json",
                            url:'../../shop/products',
                            data:'page_num='+ num,
                        })
                        .done(function( data, textStatus, jqXHR ) {
                            total_pages=Math.ceil(parseInt(data.totalcount) / parseInt(6))//total pages=round total houses/6
                            //console.log(data.length);
                           if(data.results.length==0){
                                $('#inicioshop').empty();
                                $('<div><h3>Su búsqueda no dió resultados.</h3></div>').attr('id','list').appendTo('#inicioshop');
                           }else{
                                console.log(data);
                                $('#inicioshop').empty();
                                
                                $.each(data.results, function(index, list) {
                                    // console.log(data);
                                    // console.log(index);
                                    $('#inicioshop').append(
                                        '<div class="grid">'+ 
                                        '<div class="text1 flex">'+ list.nombre + '<a class="corazon" id="'+list.nombre+'"><i class="far fa-heart" ></i></a></div>'+
                                        '<br><span>Localidad:   <span id="localidad">'+list.localidad+'</span></span></br>'+
                                        '<br><span>Provincia:   <span id="prov">'+list.provincia+'</span></span></br>'+
                                        '<br><span>Capacidad Total:     <span id="capacidad">'+list.capacidad+'</span></span></br>'+
                                        '<div class="fright">'+
                                        '<a  class="read"  id="'+list.nombre+'">READ MORE</a>'+
                                        '</div>'+
                                        '</div>'
                                        
                                    ).fadeIn(1000);
                                });
                                readmyfavorites();                                
                             }//end if
                         });///end done
                       
                    })// end on page
                 }//end if
                        
            })//end done
        .fail(function( data, response, jqXHR ) {
            console.log(data);
            toastr["error"]("Error de conexión, pruebe mas tarde"),{"iconClass":'toast-info'};

        })

     }//end function

/////  THE RESULTS
     $('#btnshop').on('click', function () {
        sessionStorage.setItem('provincia', 'null'); // save data
        sessionStorage.setItem('local', 'null'); // save data
        sessionStorage.setItem('val', 'null'); // save data

     });
    if (document.getElementById('inicioshop')) {
     
        
            var drop=sessionStorage.getItem('provincia');
            var drop1= sessionStorage.getItem('local'); 
            var drop2= sessionStorage.getItem('val'); 
            // console.log(drop2);
            if(!drop2){
                ///console.log('entra');
                drop2=null;
            }
            if((drop1=='false')||(drop1==0)){
                drop1=null;
            }
            if(drop==0){
                drop=null;
            }
           
             ajaxForSearch('&provi=' + drop + '&local=' + drop1 + '&val=' + drop2);
     }//end if

   
});
