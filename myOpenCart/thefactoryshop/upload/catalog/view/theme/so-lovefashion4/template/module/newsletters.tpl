<script>
		function subscribe()
		{
			var emailpattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			var email = $('#txtemail').val();
			if(email != "")
			{
				if(!emailpattern.test(email))
				{
					alert("Invalid Email");
					return false;
				}
				else
				{
					$.ajax({
						url: 'index.php?route=module/newsletters/news',
						type: 'post',
						data: 'email=' + $('#txtemail').val(),
						dataType: 'json',
						
									
						success: function(json) {
						
						alert(json.message);
						
						}
						
					});
					return false;
				}
			}
			else
			{
				alert("Email Is Require");
				$(email).focus();
				return false;
			}
			

		}
	</script>
	
<div class="newsletter">
				<div class="text">
						<h3><?php echo $heading_title4?></h3>
						<p><?php echo $description4?></p>
				</div>
				<form action="#" method="post">
					<div class="form-group required">
								<div class="input-box">
								  <input type="email" name="txtemail" id="txtemail" value="" placeholder="<?php echo $email_text;?>" class="form-control input-lg"  /> 
								</div>
								<div class="subcribe">
										<button type="submit" class="btn btn-default btn-lg" onclick="return subscribe();"><?php echo $Subscribe_text4?><i class="fa fa-caret-right"></i></button>  
								</div>
					</div>
					
				</form>
</div>
