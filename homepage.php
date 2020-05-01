<!DOCTYPE html>
<html class="gt-ie8 gt-ie9 not-ie">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?= $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="<?= base_url(); ?>t_pixeladmin/assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>t_pixeladmin/assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>t_pixeladmin/assets/stylesheets/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>t_pixeladmin/assets/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>t_pixeladmin/assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>t_pixeladmin/assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css">

</head>

<body>
<div class="container">
	<div id="header-section">
	<!-- Static navbar -->
	<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Taxibook</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
							<li><a href="<?= base_url('pages') ?>">Booking List</a></li>
              <li><a href="<?= base_url('pages/taxi') ?>">Taxi</a></li>
              <li><a href="<?= base_url('pages/pricing') ?>">Pricing</a></li>
							<?php  
							if(loggedin_tf()){
							?>
							<li><a href="<?= base_url('authr/signout') ?>">Logout</a></li>
							<?php }else{ ?>
							<li><a href="<?= base_url('authr/signin') ?>">Login</a></li>
							<?php } ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>		
	<!----------------------------------------------->		

	</div> 
	<!-- / #header-section -->

	<div id="content-section">
		<?php  
	        require_once('content.php');
	    ?>
	</div>
	<!-- / #content-section -->
</div>

<script src="<?= base_url(); ?>t_pixeladmin/assets/javascripts/jquery-3.3.1.min.js"></script>
<script src="<?= base_url(); ?>t_pixeladmin/assets/javascripts/jquery.transit.js"></script>

<!-- Pixel Admin's javascripts -->
<script src="<?= base_url(); ?>t_pixeladmin/assets/javascripts/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>t_pixeladmin/assets/javascripts/pixel-admin.min.js"></script>

<?php 
	if(isset($local_js)){
		// echo "string";die();
		$this->load->view($local_js); 
	}
?>
<script type="text/javascript">
//----- Base URL:
	const myBaseURL = '<?php echo base_url(); ?>';
</script>
	
</body>
</html>