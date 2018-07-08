$(document).ready(function() {
	function poll_data(argument) {
		$.ajax({
			url:"fetch_poll_data.php",
			method:"POST",
			success:function(data)
			{
				$('#poll_result').html(data);
			}
		})
	}

});
