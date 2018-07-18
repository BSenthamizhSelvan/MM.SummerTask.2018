<div class="col-sm-4 col-xs-12 pool">

	<div class="col-xs-12">
		<?php 
		if(!empty($success_msg)){
			echo '<div class="alert alert-success">'.$success_msg.'</div>';
		}elseif(!empty($error_msg)){
			echo '<div class="alert alert-danger">'.$error_msg.'</div>';
		}
		?>
	</div>

	<h4>POOL OF THE WEEK</h4>

	<p class="form-group">

		Q. <?php echo $poll['question']; ?>

	</p>

	<div id="swap1">

		<form method="post" action="" class="form">

			<input type="radio" name="poll" value="1">

			<span style="color: #449d44;"> <?php echo $poll['option1']; ?> </span>
			
			<br>
			<input type="radio" name="poll" value="2">

			<span style="color: #ec971f;"> <?php echo $poll['option2']; ?> </span>

			<br>
			<input type="radio" name="poll" value="3"> 

			<span style="color: #c9302c;"> <?php echo $poll['option3']; ?> </span>

			<br>
			<br>
			<div>
				<input type="submit" name="submit" class="btn btn-info btn-sm" value="Submit">
			</div>

		</form>

		<a href="javascript:swap('swap1','swap2')"><button class="btn btn-info btn-sm">View Result</button></a>

	</div>

	<div id="swap2">

		<div class="progress">

			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($a);?>%">

				<?php echo round($a); ?>%

			</div>
		</div>

		<div class="progress">
			<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($b);?>%">

				<?php echo round($b); ?>%

			</div>
		</div>

		<div class="progress">
			<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($c);?>%">

				<?php echo round($c); ?>%

			</div>
		</div>

		<div>
			<a href="javascript:swap('swap1','swap2')"><button class="btn btn-info btn-sm">View Options</button></a>

		</div>
	</div>
</div>
</div>
