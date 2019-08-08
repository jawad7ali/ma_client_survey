<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Survey completed</title>
	<link rel="shortcut icon" type="image/png" href="<?= base_url('assets/img/'); ?>MA-logo.png"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		img.img{
    display: block;
    margin-bottom: 10px;
		}
		.main-body{
			    margin: 0 auto;
   				max-width: 992px;
    			margin-top: 50px;
		}
		.footer{
			    text-align: center;
    			margin-bottom: 50px;
    			/*margin-left: -100px;*/
		}
		.footer .social{
    		width: 22px;
    		height: 22px;
    		background: #1f1b4f;
    		color: #fff;
   		 	display: inline-block;
    		padding: 3px 2px 2px 5px;
    		box-sizing: border-box;
    		margin-right:10px;
		}
		.footer .links{
			margin-right:40px;
		}
		.empty{
			height: 400px;
		}
		.email-sent-btn 
		{
		    padding: 10px 20px;
		    border: transparent;
		    background: #1f1b4f;
		    color: #fff;
		    margin-bottom: 10px;
		    margin-left: 20px;
		}
		.email-sent-btn:hover{
			text-decoration: none;
			color: white;
		}
		.iagility-details{
			text-align: center; 
			padding-top: 50px; 
			width: 46%; 
			margin: auto;

		}

	</style>
</head>
<body>
	<div class="container main-body">
		<div style="padding-bottom: 20px;">
			<img src="<?= base_url('assets/img/'); ?>MA-logo.png" alt="" class="img">
		</div>
		<div class="body-content">
			<p style="margin-left: 22px;"> <?php if($this->session->flashdata('success')): ?>
        <?php echo $this->session->flashdata('success'); ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('error')): ?>
        <?php echo $this->session->flashdata('error'); ?>
      <?php endif; ?>
</p>
		</div>
		<div class="row iagility-details">
			<img width="165" height="90" style="display: initial;" src="<?= base_url('assets/'); ?>iAgilitylogo.png" alt="" class="img">
			<p style="padding-top: 20px;">Bring you an innovative consulting platform equipped with the latest tools and technology with a quick and simple job search.</p>
			<a href="https://iagility.com/signup" class="email-sent-btn" style="margin-top: 20px; display: inline-block; margin: 10px;">
				Sign up now
			</a>
			<p>as Consultant</p>
			<p>Visit: <a href="https://iagility.com/jobsearch">iagility.com/jobsearch</a> for latest jobs</p>
		</div>
		<!-- <div class="empty">
			<div class="row"></div>
		</div> -->
		<div class="footer" style="padding-top: 50px">
			<div class="row">
				<a href="https://www.facebook.com/microagility" target="_blank">
					<span class="links"><i class="fa fa-facebook social"></i>Facebook</span>
				</a>
				<a href="https://twitter.com/MicroAgility" target="_blank">
					<span class="links"><i class="fa fa-twitter social"></i>Twitter</span>
				</a>
				<a href="https://www.linkedin.com/company/microagility" target="_blank">
					<span class="links"><i class="fa fa-linkedin social"></i>LinkedIn</span>
				</a>
				<a href="https://www.microagility.com" target="_blank">
					<span class="links"><i class="fa fa-globe social"></i>MicroAgility</span>
				</a>
			</div>
		</div>
	</div>
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>