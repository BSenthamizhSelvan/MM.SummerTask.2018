<div class="row">
	<br>
	<div>
		<h5> Search results for <?php echo $check; ?></h5>
	</div>
	<br>
	<?php
	if(!empty($search)):
	foreach($search as $search): ?>
		<div class="col-sm-4 col-xs-12">

			<a href="<?php echo site_url('home/article/'.$search['id']); ?>"><img class="rec_art" src="<?php echo base_url('assets/img/uploads/') ?><?php echo $search['img']; ?>"></a>

			<div>
				<h5><?php echo $search['ctg']; ?></h5>
				<h3><a href="<?php echo site_url('home/article/'.$search['id']); ?>"><?php echo $search['title']; ?></a></h3>
				<p><?php echo $search['date'] .'|'. $search['reptr_name']; ?></p>
				<p>
					<?php echo $search['summary']; ?>
				</p>
			</div>

		</div>

	<?php endforeach; else: ?> 
	<div> <div>
		<h5> Article(s) not found.....</h5>
	</div> </div>
	
	<?php endif; ?>
</div>