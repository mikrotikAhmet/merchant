/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $("#authenticate").submit(function(){	
        username= $("#username").val();
        password= $("#password").val();
        $.ajax({
            type: "GET",
            url: "http://api.semitepayment.com/index.php?route=authentication/auth/authenticate&username=",
            dataType: "jsonp",
            data : { username: username, password : password },
            contentType: "application/json; charset=utf-8",
            ProcessData: true,
            success: function(data){
                alert();
            },
            error: function(error){
                console.log(error)
            }
            
        });
        return false;
    });
});

