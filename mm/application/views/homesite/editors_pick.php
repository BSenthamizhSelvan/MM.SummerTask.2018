<div class="row">
	<div class="col-sm-9 col-xs-12">
		<h2>Editors pick</h2>
		<div class="col-sm-8 col-xs-12 col-sm-offset-2">
			<div class="overlay">
				<a href="<?php echo site_url('home/article/'.$pick['id']); ?>"><img src="assets/img/uploads/<?php echo $pick['img']; ?>" alt="Editors Pick"></a>
				<div class="content">
					<h5><?php echo $pick['ctg']; ?></h5>
					<h3><a href="<?php echo site_url('home/article/'.$pick['id']); ?>" class="over heading"><?php echo $pick['title']; ?></a></h3>
					<p>
						<?php echo $pick['summary']; ?>
					</p>
					<p><?php echo $pick['date'] .'|'. $pick['reptr_name']; ?></p>
				</div>
			</div>
		</div>
	</div>