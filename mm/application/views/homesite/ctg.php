<div class="row">
	<br>
	<h3><?php echo $ctg; ?></h3>
	<br>
	<?php
	if(!empty($category)):
	foreach($category as $category): ?>
		<div class="col-sm-4 col-xs-12">

			<a href="<?php echo site_url('home/article/'.$category['id']); ?>"><img class="rec_art" src="<?php echo base_url('assets/img/uploads/') ?><?php echo $category['img']; ?>"></a>

			<div>
				<h5><?php echo $category['ctg']; ?></h5>
				<h3><a href="<?php echo site_url('home/article/'.$category['id']); ?>"><?php echo $category['title']; ?></a></h3>
				<p><?php echo $category['date'] .'|'. $category['reptr_name']; ?></p>
				<p>
					<?php echo $category['summary']; ?>
				</p>
			</div>

		</div>

	<?php endforeach; else: ?> 
	<div> <div>
		<h5> Oh Sorry! Article(s) not found.....</h5>
	</div> </div>
	
	<?php endif; ?>
</div>