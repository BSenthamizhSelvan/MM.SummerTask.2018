<div class="row">
	<div class="col-xs-12">
		<div class="col-sm-4 col-xs-12 col-sm-offset-4 img">
			<img src="<?php echo base_url('assets/img/uploads/') ?><?php echo $select['img']; ?>">
		</div>
		<div>
			<div class="col-sm-12 col-xs-12">
				<h1><?php echo $select['title']; ?></h1>

				<div class="helpers">
					<span><?php echo $select['date']. '  |  '.$select['reptr_name']; ?></span>
					<span class="navbar-right"><?php echo $select['ctg']; ?></span>
				</div>
				<div>
					<?php echo $select['content']; ?>
				</div>
			</div>
			
		</div>
		
	</div>
</div>
