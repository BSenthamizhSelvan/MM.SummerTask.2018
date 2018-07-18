</head>
<body>



	<div class="wrapper">

		<nav id="sidebar">
			<div class="sidebar-header">
				<h1>ADMIN PANEL</h1>
			</div>

			<ul class="list-unstyled components">
				<p>
					<?php
				echo '<b>Logged in as:</b> ' . $this->session->userdata('username');
				?>
				</p>
				
				<li>
					<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Articles</a>
					<ul class="collapse list-unstyled" id="homeSubmenu">
						<li><a href="<?php echo site_url('articles/add'); ?>">Add Article</a></li>
						<li><a href="<?php echo site_url('articles'); ?>">View Articles</a></li>
					</ul>
					<a href="<?php echo site_url('admin_panel/users'); ?>">Users</a>
					<a href="<?php echo site_url('admin_panel/poll'); ?>">Poll</a>
					<a href="<?php echo site_url('admin_panel/question_final'); ?>">Question</a>
					<a href="<?php echo site_url('admin_panel/forum'); ?>">Forum</a>
					<a href="#commentsSubmenu" data-toggle="collapse" aria-expanded="false">Comments</a>
					<ul class="collapse list-unstyled" id="commentsSubmenu">
						<li><a href="<?php echo site_url('admin_panel/article_comment'); ?>">Article Comments</a></li>
						<li><a href="<?php echo site_url('admin_panel/question'); ?>">Ask a Question</a></li>
						<li><a href="<?php echo site_url('admin_panel/reply'); ?>">Forum Comments</a></li>
					</ul>
				</li>
			</ul>
		</nav>

		<div id="content">

			<nav role="navigation" class="navbar navbar-default">
				<div class="container-fluid">
					<button type="button" data-target="#navbarCollapse1" data-toggle="collapse" class="navbar-toggle">
						<span class="sr-only">Toggle navigation</span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
					</button>

					<div class="navbar-header">

						<div type="button" id="sidebarCollapse" class="btn btn-info navbar-btn" data-text-swap=" Show">							<span>Hide</span>
						</div>
					</div>

					<div id="navbarCollapse1" class="collapse navbar-collapse navbar-right">
						<ul class="nav navbar-nav">
							<li><a href="<?php echo site_url(); ?>">Homepage</a></li>
							<li><a href="<?php echo site_url('users/logout'); ?>">Logout</a></li>
						</ul>
					</div>
				</div>
			</nav>