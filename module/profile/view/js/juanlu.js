function loadtab1(){

  $.ajax({
    type:"GET",
    url:"modules/profile/controller/controller_profile.php?select_user_json=true",
    dataType:"json",
    success: function(data) {
      console.log(data[0].user);
      content = document.createElement('div');
      content.innerHTML ='<div align = "center"><div style = "width:300px; border: solid 1px #333333; " align = "left">'
         +'<div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Create</b></div>'
         +'<div style = "margin:30px">'
         +'<form id="formregister" name="formregister" action = "" method = "post">'
         +'<label>UserName  :</label><input type = "text" id="user" readonly="readonly" class = "box" value="'+ data[0].user
         +'"/><br /><span id="e_username"></span><br />'
         +'<label>mail  :</label><br /><input type = "text" id="mail" name = "mail" class = "box" value="'+ data[0].mail
         +'"/><br /><span id="e_mail"></span><br />'
         +'<label>Password  :</label><input type = "password" id="password" name = "password" class = "box" /><br/><span id="e_passwordr"></span><br />'
         +'<label>Repeat Password  :</label><input type = "password" name = "secondPassword" class = "box"/><br /><span id="e_rpasswordr"></span><br />'
         +'<label>Country  :</label><select type = "country" class = "box"><option selected>Select country</option></select><br /><br />'
         +'<label>Province  :</label><select type = "province" class = "box"><option selected>Select province</option></select><br /><br />'
         +'<label>City  :</label><select type = "city" class = "box"><option selected>Select city</option></select><br /><br />'
         +'<input type="button" id="bottregister" value="Upgrade">'
         +'</form></div></div></div>'
         document.getElementById("content").appendChild(content);

    },
    error: function (data){
      console.log("not user");
      console.log(data);
    }
  })



    
}

function loadtab2(){

  var content = document.createElement('div');
  content.id="dataTable";
  document.getElementById("content").appendChild(content);
  dataTable();  
}

function loadtab3(){
  var content = document.createElement('div');
  content.textContent = "hola 3!!!";
  document.getElementById("content").appendChild(content);
}



  function chargecontent(e){
    /* console.log(e); */
    if(document.getElementById("content")){
      var first = document.getElementById("content").firstChild;
      if (first){
        document.getElementById("content").removeChild(first);
      }
    }

    /* console.log(first); */
    /* document.getElementById("content").removeChild(first.firstChild); */
    switch (e) {
        case 'tab1':
        loadtab1();
        break;
        case 'tab2':
        loadtab2();
        break;
        case 'tab3':
        loadtab3();
        break;
        default:
        loadtab1();
        break;
    }
    $('#content').fadeIn();

  }

  $(document).ready(function(){

    $("div.tab button:first").addClass("active");
    $(".tabcontent").addClass("tab1");
        chargecontent("tab1");

      $("div.tab button").click(function() {

      $("div.tab button").removeClass("active");
          $(this).addClass("active"); 
          $(".tabcontent").removeClass("tab1 tab2 tab3");
      $(".tabcontent").addClass($(this).attr("id")); 
          chargecontent($(this).attr("id"));

      });


  })