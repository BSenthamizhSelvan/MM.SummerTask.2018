<div class="container-fluid">

	<div class="col-xs-12">
		<?php 
		if(!empty($success_msg)){
			echo '<div class="alert alert-success">'.$success_msg.'</div>';
		}elseif(!empty($error_msg)){
			echo '<div class="alert alert-danger">'.$error_msg.'</div>';
		}
		?>
	</div>

	<a href="<?php echo site_url('Admin_panel/new_poll'); ?>"><button type="button" class="btn btn-warning btn-small">Create New Poll</button></a>
	<br>
	<br>
	<br>

	<div class="row">

		<div class="col-sm-8 col-xs-12">
			<form method="post" action="" class="form">

				<div class="form-group">
					<label for="question">Question</label>
					<textarea name="question" class="form-control" ><?php echo !empty($poll['question'])?$poll['question']:''; ?></textarea>
					<?php echo form_error('question','<p class="text-danger">','</p>'); ?>
				</div>

				<div class="form-group">
					<label for="1">Option 1</label>
					<textarea name="1" class="form-control" ><?php echo !empty($poll['option1'])?$poll['option1']:''; ?></textarea>
					<?php echo form_error('1','<p class="text-danger">','</p>'); ?>
				</div>

				<div class="form-group">
					<label for="2">Option 2</label>
					<textarea name="2" class="form-control" ><?php echo !empty($poll['option2'])?$poll['option2']:''; ?></textarea>
					<?php echo form_error('2','<p class="text-danger">','</p>'); ?>
				</div>

				<div class="form-group">
					<label for="3">Option 3</label>
					<textarea name="3" class="form-control" ><?php echo !empty($poll['option3'])?$poll['option3']:''; ?></textarea>
					<?php echo form_error('3','<p class="text-danger">','</p>'); ?>
				</div>

				<input type="submit" name="pollsubmit" class="btn btn-success" value="Submit"/>

			</form>
		</div>

