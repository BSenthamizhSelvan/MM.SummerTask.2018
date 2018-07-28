<div class="row">
	<div class="col-sm-8 col-xs-12">
		<h2>Editors pick</h2>
		<div class="col-sm-8 col-xs-12 col-sm-offset-2">

			<div class="image-slider">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<?php $count='1'; foreach ($pick as $pick) { ?>
						
							<div class="item <?php echo $count=='1'?'active':''; ?>">
							<a href="<?php echo site_url('home/article/'.$pick['id']); ?>"><img id="edit-pick" src="assets/img/uploads/<?php echo $pick['img']; ?>" alt="Editors Pick"></a>
							<div class="overlay">
								<h5><?php echo $pick['ctg']; ?></h5>
								<h3><a href="<?php echo site_url('home/article/'.$pick['id']); ?>"><?php echo $pick['title']; ?></a></h3>
								<p><?php echo $pick['summary']; ?></p>
								<p><?php echo $pick['date'] .'|'. $pick['reptr_name']; ?></p>
							</div>
						</div>

						<?php ++$count; } ?>
						

					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<i class="fas fa-angle-left"></i>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<i class="fas fa-angle-right"></i>
					</a>
				</div>
			</div>
		</div>

	</div>
</div>
