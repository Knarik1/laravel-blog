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

    $( "body" ).delegate( ".comment-submit-btn", "click", function() {

        var thisBtn = $(this);
        var formUrl = thisBtn.attr('formaction');
        var formData = thisBtn.parents('form').serialize();
        console.log(thisBtn,formUrl, formData);
        // console.log(thisBtn.parents('.row').children('.col-md-8').children('.error-span-comments'));
        $.ajax({
            url: formUrl,
            type: 'POST',
            data: formData,
            datatype: 'json',
            error: function (data) {
                var a = data.responseText;
               console.log((a['text']));

                var err = JSON.parse(data);

                thisBtn.parents('.row').children('.col-md-8').children('.error-span-comments').html(err['text'])
            },
            success: function (data) {
                var text = JSON.parse(data)[1];
                var newComment = '<div class="well">' +
                                 '<button>email</button>' +
                                 '<button>date</button>' +
                                  text +
                                 '<button class="for-reply-ajax-btn" formaction="' +
                                 // '{{ url('/comment/'.$comment['id']) }}' +
                                 '"> reply  </button>' +
                                '<div class="for-putting-recursion-div"></div>' +
                                '</div>';
                $('.text-data-wall').val('');
                thisBtn.parents('.container-div').children('.comments-well').append(newComment);
            }
        });
    });




    $( "body" ).delegate( ".for-reply-ajax-btn", "click", function() {
        var clickedBtn = $(this);
        var getCommentsUrl = clickedBtn.attr('formaction');


        clickedBtn.attr('class','btn btn-warning btn-sm remove-when-click');
        $.ajax({
            url: getCommentsUrl,
            type: 'GET',
            datatype: 'json',
            error: function (err) {
                console.log(err);
            },
            success:function (data) {
                var myData = JSON.parse(data);
                console.log(clickedBtn.next());
                var explodedString = getCommentsUrl.split('/');
                var lenghtArray = explodedString.length;
                var myEagerLocalhost1 = getCommentsUrl.replace(explodedString[lenghtArray-1],'');
                var myEagerLocalhost = myEagerLocalhost1.slice(0, -1);

                var divWell =  $.each(myData[0], function(index, value){
                    var a = '<div class="well">' +
                    '<button>email</button>' +
                    '<button>date</button>' +
                    text +
                    '<button class="for-reply-ajax-btn" formaction="' +
                    // '{{ url('/comment/'.$comment['id']) }}' +
                    '"> reply  </button>' +
                    '<div class="for-putting-recursion-div"></div>' +
                    '</div>';
                });

                var ContainerDiv = '<div  class="container-div">' +
                    '<div class="comments-well">' +
                    divWell +
                    '</div>' +
                    '<form class="form-horizontal" role="form"></form>' +
                    '</div>';

                if(myData[0].length>0){
                    clickedBtn.next().append(ContainerDiv)
                    }
                var divAppended2 = '<form action="' +
                        myEagerLocalhost +
                        '" class="form-horizontal" role="form" method="POST">' +
                        '<input type="hidden" name="belong_to" value="' +
                        clickedBtn.attr('data-belong-to') +
                        '">' +
                        '<input type="hidden" name="post_id" value="' +
                        clickedBtn.attr('data-post-id') +
                        '">' +
                        '<input type="hidden" name="user_id" value="' +
                        clickedBtn.attr('data-user-id')  +
                        '">' +
                        '<div class="row">' +
                        '<div class="col-md-8">' +
                        '<textarea name="text" cols="80" rows="4" placeholder="comment ..." class="text-data-wall" autofocus></textarea>' +
                        '<span class="text-danger error-span-comments"></span>' +
                        '</div>' +
                        '<div class="offset-md-1"></div>' +
                        '<div class="col-md-3">' +
                        '<button type="button" class="btn btn-primary comment-submit-btn">Add</button>' +
                        '</div>' +
                        '</div>' +
                    '</form>';
                clickedBtn.siblings('.container-div').append(divAppended2);
            }
        });

            });
    $( "body" ).delegate( ".remove-when-click", "click", function() {
        $(this).siblings('.container-div').children().fadeOut(200);
        $(this).attr('class','btn btn-warning btn-sm for-reply-ajax-btn');

    });

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
});