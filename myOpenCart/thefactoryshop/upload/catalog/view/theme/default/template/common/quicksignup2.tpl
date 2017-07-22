
<div class="dropdown-menu" aria-labelledby="dLabel">
	
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-12" id="quick-login">
				<h4 class="modal-title"><?php echo $text_returning ?></h4>
				<span style="margin: 0 0 10px; display: block;"><?php echo $text_returning_customer ?></span>
				
				<div class="form-group input input-user required">
					<input type="text" placeholder="<?php echo $entry_email; ?>" name="email" value=""  id="input-email" class="form-control" />
				</div>
				<div class="form-group input input-pass required">
					<input type="password" placeholder="<?php echo $entry_password; ?>" name="password" value="" id="input-password" class="form-control" />
				</div>
				<div class="form-group">
				<button type="button" class="btn btn-primary loginaccount"  data-loading-text="<?php echo $text_loading; ?>"><?php echo $button_login ?></button>
				</div>
				<div class="form-group forgotten">
				<a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
				</div>
			</div>
		
		</div>
	</div>
</div>


<script type="text/javascript"><!--
$('.dropdown.keep-open').on({
    "shown.bs.dropdown": function() { this.closable = true; },
    "click":             function(e) { 
        var target = $(e.target);
        if(target.hasClass("btn-primary")) 
            this.closable = true;
        else 
           this.closable = false; 
    },
    "hide.bs.dropdown":  function() { return this.closable; }
});

//--></script>

<script type="text/javascript"><!--
$('#quick-login input').on('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#quick-login .loginaccount').trigger('click');
	}
});
$('#quick-login .loginaccount').click(function() {
	$.ajax({
		url: 'index.php?route=common/quicksignup/login',
		type: 'post',
		data: $('#quick-login input[type=\'text\'], #quick-login input[type=\'password\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#quick-login .loginaccount').button('loading');
			$('#quick-login .alert-danger').remove();
		},
		complete: function() {
			$('#quick-login .loginaccount').button('reset');
		},
		success: function(json) {
			$('#quick-login .form-group').removeClass('has-error');
			if(json['islogged']){
				 window.location.href="index.php?route=account/account";
			}
			
			if (json['error']) {
				$('#quick-login .modal-header').after('<div class="alert alert-danger" style="margin:5px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				$('#quick-login #input-email').parent().addClass('has-error');
				$('#quick-login #input-password').parent().addClass('has-error');
				$('#quick-login #input-email').focus();
			}
			if(json['success']){
				loacation();
				$('#quick-login').modal('hide');
			}
			
		}
	});
});
//--></script>

<script type="text/javascript"><!--
function loacation() {
	location.reload();
}
//--></script>