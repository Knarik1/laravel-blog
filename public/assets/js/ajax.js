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
        //console.log(thisBtn,formUrl, formData);
        // console.log(thisBtn.parents('.row').children('.col-md-8').children('.error-span-comments'));
        $.ajax({
            url: formUrl,
            type: 'POST',
            data: formData,
            datatype: 'json',
            error: function (data) {
                var a = data.responseText;
               //console.log((a['text']));

                var err = JSON.parse(data);

                thisBtn.parents('.row').children('.col-md-8').children('.error-span-comments').html(err['text'])
            },
            success: function (data) {
                var myData =JSON.parse(data) ;
                console.log(myData.id);
                var newComment = '<div class="well">' +
                                 '<button style="float: right">' +
                                  myData.user.name +
                                 '</button>' +
                                 '<button style="float: right">' +
                                  myData.created_at +
                                  '</button><p>' +
                                  myData.text +
                                 '</p><button class="btn btn-warning btn-sm for-reply-ajax-btn" formaction="' +
                                  formUrl+ myData.id +
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


        clickedBtn.attr('class','btn btn-danger btn-sm remove-when-click');
        clickedBtn.html('close');
        $.ajax({
            url: getCommentsUrl,
            type: 'GET',
            datatype: 'json',
            error: function (err) {
                console.log(err);
            },
            success:function (data) {
                var myData = JSON.parse(data);


                var explodedString = getCommentsUrl.split('/');
                var lenghtArray = explodedString.length;
                var myEagerLocalhost1 = getCommentsUrl.replace(explodedString[lenghtArray - 1], '');
                var myEagerLocalhost = myEagerLocalhost1.slice(0, -1);

                var divWell = '';
                var divsForeach = $.each(myData.replies, function (index, value) {
                    var a = '<div class="well">' +
                        '<button style="float: right">' +
                        value.user.name +
                        '</button>' +
                        '<button style="float: right">' +
                        value.created_at +
                        '</button><p>' +
                        value.text +
                        '</p><button class="btn btn-warning btn-sm for-reply-ajax-btn" formaction="' +
                        myEagerLocalhost + '/' + value.id +
                        '"> reply  </button>' +
                        '<div class="for-putting-recursion-div"></div>' +
                        '</div>';
                    divWell =divWell + a;
                });
                var repliesDiv = '';

                if (myData.replies.length > 0) {
                    repliesDiv = '<div class="comments-well">' +
                        divWell +
                        '</div>';
                }

                var ContainerDiv = '<div  class="container-div">' +
                    repliesDiv +
                    '<form class="form-horizontal" role="form">' +
                    '<div class="row">' +
                    '<div class="col-md-8">' +
                    '<textarea name="text" cols="80" rows="4" placeholder="comment ..." class="text-data-wall" autofocus></textarea>' +
                    '<span class="text-danger error-span-comments"></span>' +
                    '<input type="hidden" name="belong_to" value="' +
                    myData.id +
                    '">' +
                    '<input type="hidden" name="post_id" value="' +
                    myData.post_id +
                    '">' +
                    '<input type="hidden" name="user_id" value="' +
                    myData.user_id +
                    '">' +
                    '</div>' +
                    '<div class="offset-md-1"></div>' +
                    '<div class="col-md-3">' +
                    '<button type="button" class="btn btn-primary comment-submit-btn"  formaction="' +
                    myEagerLocalhost +
                    '">Add</button>' +
                    '</div>' +
                    '</div>' +
                    '</form>' +
                    '</div>';

                clickedBtn.next().append(ContainerDiv);
            }
        });

            });


    $( "body" ).delegate( ".remove-when-click", "click", function() {
        $(this).next().children().fadeOut(200);
        $(this).attr('class','btn btn-warning btn-sm for-reply-ajax-btn');
        $(this).html('reply');

    });

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
});