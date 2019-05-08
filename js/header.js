$(document).ready(function(){
 
    
    $("#logout").on("click", function(){
        
       $.post("ajax/ajax_logout.php").done(function(){
            location.reload();
       }); 
    });
    
    $("#password").on('keyup',function(e){
        if(e.keyCode==13){
            login_click();
        }
    });


});
 
function login_click(){
        var username = $("#username").val();
        var password = $("#password").val();
        if(username.trim().length<3||password.trim().length<3){
             
            
        }
        $.post("ajax/ajax_login.php",{username:username, password:password}).done(function(data){
            //var obj = JSON.parse(data);
            if(data=="0"){
                alert("No such user or wrong pass")
            }
           if(data==1){
               location.reload();
           }
        })
                .fail(function(){
                    alert("fail!");
                })
}

function close_login_form(){
     $("#username").val("");
     $("#password").val("");
     $("#try-1").trigger("close");
}   