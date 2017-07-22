<script>
		function subscribe()
		{
			var emailpattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			var email = $('#txtemail1').val();
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
						data: 'email=' + $('#txtemail1').val(),
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
	
<div class="module newsletter">
		<div class="header-title">
				<h3 class="modtitle">
						<?php echo $heading_title?>
				</h3>
				<p><?php echo $description ?></p>
		</div>
		<div class="modcontent">
				<form action="#" method="post">
					<div class="form-group required">
								<div class="input-box">
								  <input type="email" name="txtemail1" id="txtemail1" value="" placeholder="<?php echo $email_text;?>" class="form-control input-lg"  /> 
								</div>
								<div class="subcribe">
										<button type="submit" class="btn btn-default btn-lg" onclick="return subscribe();"><?php echo $Subscribe_text?></button>  
								</div>
					</div>
					
				</form>
		</div>
</div>
