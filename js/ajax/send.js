$(document).ready(function(){

	$('#tweet-content').keyup(function()
	{
		$('#tweet-c').html(140 - $('#tweet-content').val().length);
		if($('#tweet-content').val().length > 0)
			$('#send-tweet').removeClass('disabled');
		else
			$('#send-tweet').addClass('disabled');

		
	});
	$('#send-tweet').click(function()
	{
		if($('#tweet-content').val() != "")
		{
			$('#send-tweet').addClass('disabled');
			var data = { "text" : $('#tweet-content').val() };
			sendTweet(data);
		}
		
	});
});

function sendTweet(param)
{
    $.ajax({
      type: "POST",
      url: "ajax/tweet.php",
      data: param
    })
    .done(function( res ) {
    	if(res != null)
    	{
    		var result =jQuery.parseJSON(res);
    		if(result != null)
    		{
    			if(result.post['status'] == "success")
    			{
    				$('#errors').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Tweet sent successfully.</div>');
    				$('#tweet-content').val("");
    			}
    			else if(result.post['login'] =="error")
    			{
    				$('#errors').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Please login!</div>');
    			}
    			else if(result.post['token'] =="error")
    			{
    				$('#errors').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Your Twitter account does not connect or is disconnected.please refresh the page.</div>');
    			}
    			else if(result.post['error'] !="" )
    			{
    				$('#errors').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'+result.post['error']+'</div>');
    			}
    		}
    		
    	}
    	else
    	{
    		$('#errors').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Unknown error! please contact admin.</div>');
    	}
    	$('#send-tweet').removeClass('disabled');
    })
    .fail(function(jqXHR, textStatus) {
    	$('#errors').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>There is some errors.Please check your internet connection.If its going on,please contact admin.</div>');
    	$('#send-tweet').removeClass('disabled');
    });
	

}