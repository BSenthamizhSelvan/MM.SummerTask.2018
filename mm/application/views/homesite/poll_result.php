<div class="col-sm-4 col-xs-12 pool">

	<h4>POOL OF THE WEEK</h4>

	<p class="form-group">

		Q. <?php echo $poll['question']; ?>

	</p>

	<div id="swap1">

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
			<a href="javascript:swap('swap1','swap2')"><button class="btn btn-info btn-sm" id="select">View Options</button></a>

		</div>
	</div>

	<div id="swap2" style="display: none; ">

		<div style="color: #449d44;">

			<?php echo $poll['option1']; ?>

		</div>

		<div style="color: #ec971f;">

			<?php echo $poll['option2']; ?>

		</div>

		<div style="color: #c9302c;">

			<?php echo $poll['option3']; ?>

		</div>


		<div>
			<a href="javascript:swap('swap1','swap2')"><button class="btn btn-info btn-sm">View Result</button></a>
		</div>

	</div>

</div>
</div>