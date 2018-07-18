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

		<h1>Forum</h1>

		<?php if ($this->session->userdata('isloggedin')) { ?>

			<a href="<?php echo site_url('forum/new_thread'); ?>"><button class="btn btn-info btn-sm new">New Thread</button></a>

		<?php  } else {
			?>  

			Please <a id="PERSONAL_PROFILE" href="<?php echo site_url('users/login'); ?>">login</a> to start a new thread...

		<?php } ?>

		<br>
		<br>

		<table class="table table-striped">
			<thead>
				<tr>
					<th width="60%">Topic</th>
					<th width="10%">Replies</th>
					<th width="5%">Views</th>
					<th width="25%">Last Post</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($forum)): foreach($forum as $forum): ?>
					<tr>
						<td>
							<a href="<?php echo site_url('forum/view/'.$forum['id']); ?>"><h5><?php echo $forum['topic']; ?></h5></a>
							Started by <?php echo $user[$forum['user_created'] - '1']['username'] ?> <br>
							at <?php echo $forum['created_date']; ?>
							
						</td>
						<td><?php echo $forum['replies']; ?></td>
						<td><?php echo $forum['views']; ?></td>
						<td>
							By <?php echo $user[$forum['last_id'] - '1']['username'] ?> <br>
							at <?php echo $forum['last_date']; ?>
						</td>
					</tr>
				<?php endforeach; else: ?> <tr><td colspan="4">Thread(s) not found......</td></tr> <?php endif; ?>
			</tbody>
		</table>

	</div>
</div>