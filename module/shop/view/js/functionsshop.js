
$(document).ready(function(){

///////////////  AJAX FOR ALL SEARCH
     function ajaxForSearch(durl) {
         var url=durl;
        //  console.log(url);
         $.ajax({
            
            type: "GET",
            dataType: "json",
            url:url,
            data:'page_num=1',
        })
        .done(function( data, textStatus, jqXHR ) {
            // console.log(data);
            // if(!data.totalcount[0]){
            //     total_pages=Math.ceil(parseInt(data.totalcount) / parseInt(6))//total pages=round total houses/6
                
            // }else{
            total_pages=Math.ceil(parseInt(data.totalcount[0].total) / parseInt(6))
            //    //total_pages=Math.ceil(parseInt(data.length) / parseInt(6))//total pages=round total houses/6
            // }
            //console.log(data.length);
            if(total_pages<2){
                $("#pagination").hide();
            }
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
                        console.log(num);
                        e.preventDefault();
                        $.ajax({
            
                            type: "GET",
                            dataType: "json",
                            url:url,
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
        .fail(function( data, textStatus, jqXHR ) {
            console.log("HELLOOOOO FAIL"+data);
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
           
            ajaxForSearch("module/shop/controller/controllershop.php?op=searchComplete&provi=" + drop + '&local=' + drop1 + '&val=' + drop2);
        // ajaxForSearch("module/shop/controller/controllershop.php?op=list");
    //         if ((!drop && !drop1 && !drop2) || (drop==='null' && drop1==='null' && drop2==='null')){
    //             console.log("vengo de menú");
    //             //ajaxForSearch("module/shop/controller/controllershop.php?op=lis");
    //             ajaxForSearch("module/shop/controller/controllershop.php?op=searchComplete&provi=" + drop + '&local=' + drop1 + '&val=' + drop2);

    //         }//else if((drop1==="false") && (drop2.length==0)){
    //             else if((drop1==null) && (drop2==null)&& (drop!=null)){
    //             console.log("por provincia");
    //             //ajaxForSearch("module/shop/controller/controllershop.php?op=searchProvince1&provi=" + drop);
    //             ajaxForSearch("module/shop/controller/controllershop.php?op=searchComplete&provi=" + drop + '&local=' + drop1 + '&val=' + drop2);

    //         }//else if((drop1!="false") && (drop2.length==0) ){
    //             else if((drop1!=null) && (drop2==null) ){
    //             console.log("por provincia i localidad");
    //             // ajaxForSearch("module/shop/controller/controllershop.php?op=searchPorYLoc&provi=" + drop + '&local=' + drop1);
    //             ajaxForSearch("module/shop/controller/controllershop.php?op=searchComplete&provi=" + drop + '&local=' + drop1 + '&val=' + drop2);

                
    //         }//else if ((drop.length > 4)&&(drop1!="false") &&(drop2.length > 1)){
    //             else if ((drop!=null)&&(drop1!=null) &&(drop2!=null)){
    //             console.log("busqueda completa");
    //             ajaxForSearch("module/shop/controller/controllershop.php?op=searchComplete&provi=" + drop + '&local=' + drop1 + '&val=' + drop2);
                
    //         }//else if((drop=="false"||drop==0) &&(drop1=="false"||drop1==0) && (drop2.length > 0)){
    //             else if((drop==null) &&(drop1==null) && (drop2!=null)){
    //             console.log("busqueda solo por valor del autocomplete");
    //             ajaxForSearch("module/shop/controller/controllershop.php?op=searchComplete&provi=" + drop + '&local=' + drop1 + '&val=' + drop2);

    //             // ajaxForSearch("module/shop/controller/controllershop.php?op=search&val=" + drop2 );
    //         }
     }//end if

   
});
