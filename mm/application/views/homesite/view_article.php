<div class="row">
	<div class="col-sm-9 col-xs-12">
		<div class="col-sm-8 col-xs-12 col-sm-offset-2">
			<img src="assets/img/uploads/<?php echo $select['img']; ?>">
		</div>
		<h1><?php echo $select['title']; ?></h1>

		<div>
			<?php echo $select['date']. '|'.$select['reptr_name']; ?>
			<div>
				<a href=""><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Comment count</a>
			</div>
		</div>
		<div>
			<?php echo $select['content']; ?>
		</div>
		<h4>COMMENTS</h4>
		<div>
			
		</div>
		<div>
			<?php if ($this->session->userdata('isloggedin')) { ?>
				<h3>
					LEAVE A COMMENT
				</h3>
				<form class="form-horizontal">
					<div>
						<textarea class="form-control" rows="5" placeholder="Comment" maxlength="3000" name="comment"></textarea>
					</div>
					<button type="submit" class="btn btn-warning">Submit</button>
				</form>

			<?php  } else {
				?>  
				Please <a id="PERSONAL_PROFILE" href="<?php echo site_url('users/login'); ?>">login</a> to continue...

			<?php } ?>
		</div>
	</div>
