<div class="container-fluid">


	<a href="<?php echo site_url('Admin_panel/poll'); ?>"><button type="button" class="btn btn-warning btn-small">Edit Existing poll</button></a>
	<br>
	<br>
	<br>

	<div class="row">

		<div class="col-sm-8 col-xs-12">
			<form method="post" action="" class="form">

				<div class="form-group">
					<label for="question">Question</label>
					<textarea name="question" class="form-control" ></textarea>
					<?php echo form_error('question','<p class="text-danger">','</p>'); ?>
				</div>

				<div class="form-group">
					<label for="1">Option 1</label>
					<textarea name="1" class="form-control" ></textarea>
					<?php echo form_error('1','<p class="text-danger">','</p>'); ?>
				</div>

				<div class="form-group">
					<label for="2">Option 2</label>
					<textarea name="2" class="form-control" ></textarea>
					<?php echo form_error('2','<p class="text-danger">','</p>'); ?>
				</div>

				<div class="form-group">
					<label for="3">Option 3</label>
					<textarea name="3" class="form-control" ></textarea>
					<?php echo form_error('3','<p class="text-danger">','</p>'); ?>
				</div>

				<input type="submit" name="pollsubmit" class="btn btn-success" value="Submit"/>

			</form>
		</div>


	</div>

</div>