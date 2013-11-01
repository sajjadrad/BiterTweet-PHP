$(document).ready(function () {
	$('.favorite').live('click', function()
	{
		//alert($(this).closest('.bt-tweetbody').attr('id'));
		var data = {
                "id": $(this).closest('.bt-tweetbody').attr('id')
            };
            favTweet(data,$(this).closest('.bt-tweetbody').attr('id'))
	});
});

function favTweet(param,id) {
    $.ajax({
        type: "POST",
        url: "ajax/favorite.php",
        data: param
    }).done(function (res) {
        if (res != null) {
            var result = jQuery.parseJSON(res);
            if (result != null) {
                if (result.favorite['status'] == "ok") {
					$('#'+id).find('.favorite').html("Unfavorite");
                }
                else if (result.favorite['status'] == "unok") {
                    $('#'+id).find('.favorite').html("Favorite");
                } else if (result.favorite['login'] == "error") {
                    $('#errors').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Please login!</div>')
                } else if (result.favorite['token'] == "error") {
                    $('#errors').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Your Twitter account does not connect or is disconnected.please refresh the page.</div>')
                } else if (result.favorite['error'] != "") {
                    $('#errors').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' + result.favorite['error'] + '</div>')
                }
            }
        } else {
            $('#errors').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Unknown error! please contact admin.</div>')
        }
        $('#send-tweet').removeClass('disabled')
    }).fail(function (jqXHR, textStatus) {
        $('#errors').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>There is some errors.Please check your internet connection.If its going on,please contact admin.</div>');
        $('#send-tweet').removeClass('disabled')
    })
}