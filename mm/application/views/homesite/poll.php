	<?php
	if(($this->uri->segment(1)==''))
	{
		?>
		<div class="col-sm-4 col-xs-12 pool">
			<?php
		}
		else
		{
			?>
			<div class="col-sm-3 col-xs-12 pool">
			<?php } ?>

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

					<div>
						<a href="<?php echo site_url('home/poll'); ?>"> <input type="submit" name="submit" class="btn btn-info" value="Submit"> </a>
					</div>

				</form>


			</div>
		</div>
	</div>
