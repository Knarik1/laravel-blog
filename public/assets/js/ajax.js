/**
 * Created by qnarik on 11/1/16.
 */

$(document).ready(function () {
    $('#save').click(function () {

        var formUrl = $('#form-id').attr('action');
        var formData = $('#form-id').serialize();

        $('#reg-err-name, #reg-err-email, #reg-err-password').html('');

        $('#reg-err-name-input, #reg-err-email-input, #reg-err-password-input').css({"border-color": "#f1f1f1",
            "border-width":"1px",
            "border-style":"solid"});


        $.ajax({
            url: formUrl,
            type: 'POST',
            data: formData,



            error: function(data)
            {
                var err_array = ['name','email', 'password'];

                function changeCss(array){

                    for( var i=0; i<array.length; i++)

                        if(data.responseJSON[array[i]]){

                            $('#reg-err-' + array[i]).html(data.responseJSON[array[i]]);
                            $('#reg-err-'+array[i]+'-input').css({"border-color": "#A52A2A",
                                "border-width":"1px",
                                "border-style":"solid"});
                        };

                };


                changeCss(err_array);
            },
            success: function (data) {
                console.log(data);
                //
                window.location.href = data;
            }
        });

    });


    $('#login').click(function () {

        var formUrl = $('#form-login-id').attr('action');
        var formData = $('#form-login-id').serialize();

        $('#response-error').html('');
        $('#login-email').css({
            "border-color": "#f1f1f1",
            "border-width": "1px",
            "border-style": "solid"
        });

        $.ajax({
            url: formUrl,
            type: 'POST',
            data: formData,
            datatype: 'json',
            error: function (data) {
                console.log(data.responseJSON.error);
                if (data.responseJSON) {
                    $('#response-error').html(data.responseJSON.error);
                    $('#login-email').css({
                        "border-color": "#791717",
                        "border-width": "1px",
                        "border-style": "solid"
                    });
                }
            },
            success: function (data) {

                window.location.href = data;
            }
        });
    });

        $('#delete-this-record').click(function () {

            var buttonUrl = $(this).attr('formaction');
            console.log(buttonUrl);

           $.ajax({
               url: buttonUrl,
               type: 'DELETE',
               error: function (data) {
                   console.log(data);
               },
               success: function (data) {

                   $('#panel-div-id-'+data).fadeOut('3000')
               }
           })
        });

    $('#category-show').click(function(){
       console.log('ok');
    });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
});