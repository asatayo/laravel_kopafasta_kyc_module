function clickEvent(event,last){
       
                
         
            			if(event.value.length){
            				document.getElementById(last).focus();
            				 
            			}

            			const inputs = document.querySelectorAll('#otp_values > *[id]');
            			
            			
            			 
                                for (let i = 0; i < inputs.length; i++) {
                                    inputs[i].addEventListener('keydown', function(event) {
                                        if (event.key === "Backspace" ) {
                                            inputs[i].value = '';
                                            if (i !== 0) inputs[i - 1].focus();
                                        } else {
                                            if (i === inputs.length - 1 && inputs[i].value !== '') {
                                                return true;
                                            } else if (event.keyCode > 47 && event.keyCode < 58) {
                                                inputs[i].value = event.key;
                                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                                event.preventDefault();
                                            } else if (event.keyCode > 64 && event.keyCode < 91) {
                                                inputs[i].value = String.fromCharCode(event.keyCode);
                                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                                event.preventDefault();
                                            }
                                        }
                                    }
                                )}
            			

            			 var inputData = '';
                            for (let i = 0; i < inputs.length; i++) {
                              inputData = inputData+''+inputs[i].value+'';
                            
                            }
                              document.getElementById("otp").value =  inputData;
                              
                             
                
		
}
		


$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
        },
        duration: 600
    });
});

$(".previous").click(function(){

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            previous_fs.css({'opacity': opacity});
        },
        duration: 600
    });
});

$('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
});

$(".submit").click(function(){
    return false;
})

});







$(function(){


  $('#photo_btn').on('click', function(){
      $("#photo").click();
  });

  $('#img').on('click', function(){
      $("#photo").click();
  });

  $("#photo").change(function(){
      readURL(this);
  });

  $('#camera_btn').on('click', function(){
      $("#camera").click();
  });


  $("#camera").change(function(){
      readURL(this);
  });


});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
            // $('#photo').attr('src', e.target.result);
            // document.getElementById('photo').files = input.files[0];
        }

        reader.readAsDataURL(input.files[0]);
    }
}







/*

document.addEventListener("DOMContentLoaded", function(event) {

    function OTPInput() {
        const inputs = document.querySelectorAll('#otp_values > *[id]');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('keydown', function(event) {
                if (event.key === "Backspace" ) {
                    inputs[i].value = '';
                    if (i !== 0) inputs[i - 1].focus();
                } else {
                    if (i === inputs.length - 1 && inputs[i].value !== '') {
                        return true;
                    } else if (event.keyCode > 47 && event.keyCode < 58) {
                        inputs[i].value = event.key;
                        if (i !== inputs.length - 1) inputs[i + 1].focus();
                        event.preventDefault();
                    } else if (event.keyCode > 64 && event.keyCode < 91) {
                        inputs[i].value = String.fromCharCode(event.keyCode);
                        if (i !== inputs.length - 1) inputs[i + 1].focus();
                        event.preventDefault();
                    }
                }

                var inputData = '';
                for (let i = 0; i < inputs.length; i++) {
                  inputData = inputData+''+inputs[i].value+'';
                }
                  document.getElementById("otp").value =  inputData;

            });
        }



    }
    OTPInput();


});

*/

