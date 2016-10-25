<nav class="navbar navbar-static-top" role="navigation">
	<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
	<div class="navbar-right">
		<ul class="nav navbar-nav">
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span> <?php echo $userName; ?>
					<i class="caret"></i></span> </a>
				<ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header bg-light-blue">
						<p>
							<?php echo $userName; ?>
						</p>
						<p>
							<?php echo $email; ?>
						</p>
						<p>
							<?php echo $company; ?>
						</p>
					</li>
					<li class="user-footer">
						<div class="pull-right">
							<a href="../logout.php" class="btn btn-default btn-flat">Cerrar sesi&oacute;n</a>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>