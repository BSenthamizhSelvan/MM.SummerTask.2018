<div class="row">
	<br>
	<h3>RECENT ARTICLES</h3>
	<br>
	<?php $count=0;
	foreach($articles as $article): ?>
		<div class="col-sm-4 col-xs-12">

			<a href="<?php echo site_url('home/article/'.$article['id']); ?>"><img class="rec_art" src="<?php echo base_url('assets/img/uploads/') ?><?php echo $article['img']; ?>"></a>

			<div>
				<h5><?php echo $article['ctg']; ?></h5>
				<h3><a href="<?php echo site_url('home/article/'.$article['id']); ?>"><?php echo $article['title']; ?></a></h3>
				<p><?php echo $article['date'] .'|'. $article['reptr_name']; ?></p>
				<p>
					<?php echo $article['summary']; ?>
				</p>
				<a href=""><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Comment count</a>
			</div>

		</div>

		<?php
		if(++$count==3){
			break;
		}
		?>

	<?php endforeach; ?>

</div>