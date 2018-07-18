<div class="row">

	<div class="col-sm-8 col-xs-12">
		<br>
		<a href="<?php echo site_url('forum'); ?>"><h5>Forum</h5></a><br>
		<h1>Start a new thread</h1>
		<form method="post" action="" class="form">

			<div class="form-group">
				<label for="Topic">Topic</label>
				<input type="text" class="form-control" name="topic" placeholder="Topic of new thread">
				<?php echo form_error('person','<p class="help-block text-danger">','</p>'); ?>
			</div>

			<div class="form-group">
				<label for="content">Description</label>
				<textarea name="content" class="form-control" placeholder="Description of new thread" rows="8"></textarea>
				<?php echo form_error('question','<p class="text-danger">','</p>'); ?>
			</div>

			<div>
				<input type="submit" name="submit" class="btn btn-success" value="Submit">
			</div>

		</form>
	</div>
</div>