</head>
<body>


	<div class="container-fluid">
		<header>
			<nav role="navigation" class="navbar lgn">
				<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
					<span class="sr-only">Toggle navigation</span> 
					<span class="icon-bar headerbar"></span> 
					<span class="icon-bar headerbar"></span> 
					<span class="icon-bar headerbar"></span> 
				</button>
				<div id="navbarCollapse" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">

						<?php if ($this->session->userdata('isloggedin')) { 
							echo '<b>Logged in as:</b> ' . $this->session->userdata('username');
							if ($this->session->userdata('privilege')){
								echo ' | ' . "<a href=" . site_url('admin_panel') . ">Admin Panel</a>";
							}
							echo ' | ' . "<a href=" . site_url('users/logout') . ">Logout</a>";
						} else {
							?>  
							<li><a id="PERSONAL_PROFILE" href="<?php echo site_url('users/login'); ?>">LOGIN</a></li>
							<li><a id="PERSONAL_PROFILE" href="<?php echo site_url('users/register'); ?>">SIGNUP</a></li>
						<?php } ?>
					</ul>
					<form class="navbar-form navbar-right" role="search" method="post" action="">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search" name="search">
						</div>
						<input type="submit" name="check" class="btn btn-default btn-search" value="Submit">
					</form>
				</div>
			</nav>
		</header>
	</div>




	<div class="container-fluid">
		<nav role="navigation" class="navbar navbar-default">
			<button type="button" data-target="#navbarCollapse1" data-toggle="collapse" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
			</button>
			<div id="navbarCollapse1" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a id="PERSONAL_PROFILE" href="<?php echo site_url(); ?>">HOME</a></li>
					<li><a id="PERSONAL_PROFILE" href="<?php echo site_url('home/category/'.'Interview'); ?>">INTERVIEW</a></li>
					<li><a id="PERSONAL_PROFILE" href="<?php echo site_url('home/category/'.'Forum'); ?>">FORUM</a></li>
					<li><a id="PERSONAL_PROFILE" href="<?php echo site_url('home/category/'.'Featured'); ?>">FEATURED</a></li>
				</ul>
			</div>
		</nav>

		