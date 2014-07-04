/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $("#authenticate").submit(function(){	
        username= $("#username").val();
        password= $("#password").val();
        
        var data= {

            "username": username,

            "password": password

            };
        
        $.ajax({
            type: 'GET',
            url: 'http://api.semitepayment.com/index.php?route=authentication/auth/authenticate',
            crossDomain: true,
            dataType: 'jsonp',
            data : data,
            jsonpCallback: 'jsonpCallback',
            success: function (response) {
                alert('success--' + response);
            },
            error: function (response) {
                alert('error--'+response);
            }
        });
        return false;
    });
});

