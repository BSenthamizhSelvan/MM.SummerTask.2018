<div class="row">

	<div class="col-sm-8 col-xs-12">

		<div class="col-xs-12">
			<?php 
			if(!empty($success_msg)){
				echo '<div class="alert alert-success">'.$success_msg.'</div>';
			}elseif(!empty($error_msg)){
				echo '<div class="alert alert-danger">'.$error_msg.'</div>';
			}
			?>
		</div>

		<h4>COMMENTS</h4>
		<div>
			<?php 

			foreach ($comments as $comment) {  ?>

				<div class="comment-bar">
					<img class="mr-3" src="<?php echo base_url('assets/img/common/') ?>user.jpg" alt="user image">
					<div class="comment-body">
						<h5 class="mt-0"><?php echo $users[$comment['user_id'] - '1']['username'] ?></h5>
						<p class="comment-date">
							<?php echo $comment['date']; ?>
						</p>
						<?php echo $comment['content']; ?>
					</div>
				</div>

			<?php } ?>

		</div>
		<br>
		<div>
			<?php if ($this->session->userdata('isloggedin')) { ?>
				<h3>
					LEAVE A COMMENT
				</h3>
				<form class="form-horizontal" method="post" action="">
					<div class="form-group">
						<textarea class="form-control" rows="5" placeholder="Comment" maxlength="3000" name="comment"></textarea>
					</div>
					<input type="submit" name="submit" class="btn btn-primary" value="Comment">
				</form>

			<?php  } else {
				?>  

				Please <a id="PERSONAL_PROFILE" href="<?php echo site_url('users/login'); ?>">login</a> to continue...

			<?php } ?>
		</div>

	</div>

</div>
