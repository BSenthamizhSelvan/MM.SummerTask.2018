<div class="col-sm-4 col-xs-12 pool">

	<h4>POOL OF THE WEEK</h4>

	<p class="form-group">
		Q. <?php 

		echo $poll['question'];

		?>

	</p>


	<div>
		<form method="post" action="" class="form">

			<input type="radio" name="poll" value="1">
			<?php 

			echo $poll['option1'];

			?> 
			<br>

			<input type="radio" name="poll" value="2">

			<?php 

			echo $poll['option2'];

			?>

			<br>
			<input type="radio" name="poll" value="3"> 

			<?php 

			echo $poll['option3'];

			?>

			<br>
			<br>

			<div>
				<input type="submit" name="submit" class="btn btn-info btn-sm" value="Submit" />
			</div>

		</form>


	</div>
</div>
</div>
