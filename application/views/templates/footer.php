<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<footer class="footer">
	<div class="container">
		<p class="text-muted">
			<a class="link-nostyle" style="text-decoration:none !important;" href ="https://github.com/chewonit/cs2102" target="_blank">
				<i style="font-size:24px" class="fa fa-github-square fa-lg"></i> 
			</a>&nbsp;
			CS2102 Group 9.
		</p>
	</div>
</footer>

<script type="text/javascript">
	var jq = jQuery.noConflict();
	
	jq( document ).ready(function() {
		<?php if( !is_null($login_result) && $login_result == FALSE) : ?>
			jq.bootstrapGrowl("<h4>Login Failed</h4>Wrong email or password." , {type: 'danger'});
		<?php endif ?>
	});
</script>

<!-- Login Modal -->
<div class="modal fade" id="loginModel" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Log In</h4>
			</div>
			<div class="modal-body">
				
				<?php $attributes = array('class' => 'form-horizontal', 'id' => 'loginForm'); ?>
				<?php echo form_open('login/login_user/', $attributes); ?>
				<div class="form-group">
					<label for="inputLoginEmail" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="inputLoginEmail" name="inputLoginEmail" placeholder="Email" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputLoginPassword" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputLoginPassword" name="inputLoginPassword" placeholder="Password" required>
					</div>
				</div>
				<!-- Remember me option not yet implemented
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label><input type="checkbox"> Remember me</label>
						</div>
					</div>
				</div>
				-->
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default btn-success">Sign in</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>
				<?php echo form_close(); ?>
				
			</div>
		</div>
	</div>
</div>

</body>
</html>