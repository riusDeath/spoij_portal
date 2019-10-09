<?php include 'header.php'; ?>
		<div class="w3l_banner_nav_right">
			<?php 
			$page = isset($_GET['page']) ? $_GET['page'] : 'workerjob';
			// echo $page;
			include 'views/'.$page.'.php';
			?>
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<?php include 'footer.php'; ?>

