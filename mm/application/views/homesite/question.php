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


		<div>
			<h1>Ask a Question</h1>
			<br>
			<br>
			<p>Ask a question anonymously with the person you want to ask and we will get the answers to all your questions in an Article</p>
		</div>
		
		<form method="post" action="" class="form">

			<div class="form-group">
				<label for="question">Your Question</label>
				<textarea name="question" class="form-control" placeholder="How do I start a club?"><?php echo !empty($question['question'])?$question['question']:''; ?></textarea>
				<?php echo form_error('question','<p class="text-danger">','</p>'); ?>
			</div>

			<div class="form-group">
				<label for="title">Person you want to ask</label>
				<input type="text" class="form-control" name="person" placeholder="Eg. Dean(Academic), Director , Chief warden" value="<?php echo !empty($question['person'])?$question['person']:''; ?>">
				<?php echo form_error('person','<p class="help-block text-danger">','</p>'); ?>
			</div>
			
			<div>
				<input type="submit" name="submit" class="btn btn-success" value="Submit">
			</div>
			
		</form>
	</div>

</div>
