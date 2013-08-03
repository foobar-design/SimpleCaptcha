$(document).ready(function() {
    $("#reloadSimpleCaptcha").click(function() {
        $.getJSON( "SimpleCaptcha.php?q=new", function( data ) {          
             $("#simpleCaptchaChallenge").val(data.challenge);
             
             $("#simpleCaptchaImage").attr("src", data.image);
         }); 
    });
});

