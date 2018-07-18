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

		<a href="<?php echo site_url('forum'); ?>"><button class="btn btn-info btn-sm">BACK TO THREADS</button></a>
		<br> <br>
		<div><h1><?php echo $forum['topic']; ?></h1></div>
		<div>Started by <?php echo $user[$forum['user_created'] - '1']['username'] ?> | <?php echo $forum['created_date']; ?></div>
		
		<div>

			<div class="comment-bar">
					<img class="mr-3" src="<?php echo base_url('assets/img/common/') ?>user.jpg" alt="user image">
					<div class="comment-body">
						<h5 class="mt-0"><?php echo $user[$forum['user_created'] - '1']['username'] ?></h5>
						<p class="comment-date">
							<?php echo $forum['created_date']; ?>
						</p>
						<?php echo $forum['content']; ?>
					</div>
				</div>

			<?php 

			foreach ($info as $info) {   if($info['approved']) { ?>

				<div class="comment-bar">
					<img class="mr-3" src="<?php echo base_url('assets/img/common/') ?>user.jpg" alt="user image">
					<div class="comment-body">
						<h5 class="mt-0"><?php echo $user[$info['user_id'] - '1']['username'] ?></h5>
						<p class="comment-date">
							<?php echo $info['date']; ?>
						</p>
						<?php echo $info['content']; ?>
					</div>
				</div>

			<?php } } ?>

		</div>
		<br>
		<div>
			<?php if ($this->session->userdata('isloggedin')) { ?>
				<h3>
					Leave a Reply
				</h3>
				<form class="form-horizontal" method="post" action="">
					<div class="form-group">
						<textarea class="form-control" rows="3" placeholder="Content" maxlength="3000" name="content"></textarea>
					</div>
					<input type="submit" name="submit" class="btn btn-sm btn-success" value="Submit">
				</form>

			<?php  } else {
				?>  

				<a id="PERSONAL_PROFILE" href="<?php echo site_url('users/login'); ?>">Login</a> to Reply...

			<?php } ?>
		</div>

	</div>

</div>