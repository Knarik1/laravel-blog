/**
 * Created by qnarik on 11/1/16.
 */

$(document).ready(function () {
    var formUrl = $('#form-url').attr('action');
    console.log(formUrl);
    
    
    
    
    $.ajax({
        url: formUrl,
    });
});