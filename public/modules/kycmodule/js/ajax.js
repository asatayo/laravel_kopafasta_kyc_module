$(function(){
  $('.overlay').fadeOut(1000);
});

$(function(){
    $('.form').on('submit', function(e){
        const form = $(this);
        e.preventDefault();
        var loader = $('.overlay');
          loader.fadeIn();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: new FormData(this),
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (response) {

             console.log(response);
              setTimeout(function(){
                loader.fadeOut('slow');
              },100);

              $(".form-message").html(response.html);


              if(response.isreloading){
                setTimeout(function(){
                   location.reload();
                },1000);
              }
              if(response.location!=null){
                setTimeout(function(){
                   document.location = response.location;
                },1000);
              }

             if(response.success || (response.remove!=null || response.update!=null)){
               $(".form").trigger('reset');

             }

             if(response.remove!=null){
               $("."+response.remove).fadeOut('slow');
             }

             if(response.update!=null){
               $("."+response.update).html(response.updateHtml);
             }

             if(response.appendHtml!=null){
               $(".append").prepend(response.appendHtml);
             }


              $(".form-message").html(response.html);

              var inputs, index;
                inputs = document.getElementsByTagName('input');
                for (index = 0; index < inputs.length; ++index) {
                  var name = inputs[index].name;

                  if(name.indexOf('[]') != -1){
                    name = name.replace('[]','');

                  }
                    $("."+name+"_error").html("");
                    $("[name='"+name+"']").css({'border': '1px solid #d9dee3'});

                }

              if(!response.success){
                var errorArray = response.errors;
                  $.each(errorArray, function(key, value){


                      $("[name='"+key+"']").css({'border': '1px solid #ff0000'});

                      if(key.indexOf('[]') != -1){
                        key = key.replace('[]','');
                      }

                      var error_holder = key+"_error";
                      $("."+error_holder).html(value[0]);
                      $("."+error_holder).css({'color': '#ff0000'});

                  });
              }
            },
            error: function (error) {
              console.log(error);
              setTimeout(function(){
                loader.fadeOut('slow');
                var  jsonResponse = JSON.parse(error.responseText);
                  $(".form-message").html(jsonResponse.html);
                var jsonArray = jsonResponse.errors;
                  $.each(jsonArray, function(key, value){
                    var error_holder = key+"_error";
                      $("[name='"+key+"']").css({'border-color': 'red'});
                      $("."+error_holder).html(value[0]);
                      $("."+error_holder).css({'color': 'red'});
                  });
              },500);

            }
        });
    });


    $('.form-dialog').on('submit', function(e){
        const form = $(this);
        e.preventDefault();
        var loader = $('.overlay');
          loader.fadeIn();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: new FormData(this),
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (response) {

             console.log(response);
              setTimeout(function(){
                loader.fadeOut('slow');
              },100);


              if(response.isreloading){
                setTimeout(function(){
                   location.reload();
                },1000);
              }
              if(response.location!=null){
                setTimeout(function(){
                   document.location = response.location;
                },1000);
              }

             if(response.success && (response.remove!=null || response.update!=null)){
               $(".form-dialog").trigger('reset');
             }

             if(response.remove!=null){
               $("."+response.remove).fadeOut('slow');
             }

             if(response.update!=null){
               $("."+response.update).html(response.updateHtml);
             }

             if(response.appendHtml!=null){
               $(".append-dialog").prepend(response.appendHtml);
             }


              $(".form-message-dialog").html(response.html);

              var inputs, index;
                inputs = document.getElementsByTagName('input');
                for (index = 0; index < inputs.length; ++index) {
                  var name = inputs[index].name;
                    $("."+name+"_error-dialog").html("");
                    $("[name='"+name+"']").css({'border': '1px solid #d9dee3'});
                }

              if(!response.success){
                var errorArray = response.errors;
                  $.each(errorArray, function(key, value){
                    var error_holder = key+"_error-dialog";
                      $("[name='"+key+"']").css({'border': '1px solid #ff0000'});
                      $("."+error_holder).html(value[0]);
                      $("."+error_holder).css({'color': '#ff0000'});
                  });
              }
            },
            error: function (error) {
              console.log(error);
              setTimeout(function(){
                loader.fadeOut('slow');
                var  jsonResponse = JSON.parse(error.responseText);
                  $(".form-message-dialog").html(jsonResponse.html);
                var jsonArray = jsonResponse.errors;
                  $.each(jsonArray, function(key, value){
                    var error_holder = key+"_error-dialog";
                      $("[name='"+key+"']").css({'border-color': 'red'});
                      $("."+error_holder).html(value[0]);
                      $("."+error_holder).css({'color': 'red'});
                  });
              },500);

            }
        });
    });

  });


  $(function(){
    $(".validate-form").on('submit', function(event) {
        const form = $(this);
        var loader = $('.overlay');
        const data = new FormData(this);
        const action = $(this).attr('action');
        console.log(action);
        event.preventDefault();
         let message = $(this).find("input[name='confirm-msg']").val();
         console.log(message);
         $("#confirm-modal").modal('show');
         $("#confirm-message").html(message);
         $("#confirm-button").on('click', function(){
          loader.fadeIn();
         $("#confirm-modal").modal('hide');
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              url: action,
              method: 'POST',
              data:  data,
              dataType: 'JSON',
              contentType: false,
              cache: false,
              processData: false,
              success: function (response) {
                 console.log(response);
                 setTimeout(function(){
                  loader.fadeOut('slow');
                 },100);

                 if(response.isreloading){
                  setTimeout(function(){
                      location.reload();
                  },2000);
                 }

                 if(response.remove!=null){
                   $("."+response.remove).fadeOut('slow');
                 }

                  $(".validate-form-message").html(response.html);
              },
              error: function (error) {
                  console.log(error);
                 setTimeout(function(){
                  loader.fadeOut('slow');
                 },500);
                  $(".validate-form-message").html(error.html)
              }
          });

         });
    });
  });


  $(function(){
    $(".validate-easyform").on('submit', function(event) {
        const form = $(this);
        var loader = $('.overlay');
        const data = new FormData(this);
        const action = $(this).attr('action');
        event.preventDefault();
         let message = $(this).find("input[name='confirm-msg']").val();
         console.log(message);
         $("#confirm-modal").modal('show');
         $("#confirm-message").html(message);
         $("#confirm-button").on('click', function(){
          loader.fadeIn();
         $("#confirm-modal").modal('hide');
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
                 url: action,
                 method: 'POST',
                 data:  data,
                 dataType: 'JSON',
                 contentType: false,
                 cache: false,
                 processData: false,
                 success: function (response) {
                  loader.fadeOut();


                    //  if(response.isreloading){
                              setTimeout(function(){
                                  location.reload();
                              },2000);
                    //   }

                 console.log(response);

                 if(response.classname!=null){
                    $('.'+response.classname).hide();
                 }
                 if(response.hasdialog){
                  console.log(response);

                    $('#'+response.dialogtype).modal('show');
                    $('#'+response.dialogtype+'-message').html(response.html);
                 }


              },
              error: function (error) {
                 loader.fadeOut();
                  console.log(error);
              }
          });

         });
    });
  });


 function formatNumber(className){

     var stringValueAll = $('.'+className).val();
     console.log(stringValueAll);
     
     if(stringValueAll){
             var stringValue = stringValueAll.replace(/[^0-9\.]/g,'');
             var value = stringValue.replace(',', '');
             var num = parseInt(value);
             var num_parts = num.toString().split(".");
             num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
             var initial =  num_parts.join(".");
             $('.'+className).val(initial);
     }
    
 }
 
 


