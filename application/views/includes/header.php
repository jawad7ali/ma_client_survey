<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Microagility Survey</title>
	<link rel="shortcut icon" type="image/png" href="<?= base_url('assets/img/'); ?>MA-logo.png"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
	.main-body{
		margin: 100px auto;
		max-width: 900px;
	}
	.rec{
		background-color: #1f1b4f;
		border-top-left-radius: 10px;
    	border-top-right-radius: 10px;
	}	
	.rec h3{
		color:#fff;
		font-size: 18px;
		margin-top: 15px;
		padding-left: 20px;
	}
	.login-form{
		background-color: #efefef;
	}
	.login-form .email [type="email"], .login-form .cli-pos [type="text"],.login-form .can-name [type="text"], .login-form .cli-name [type="text"], .email [type="text"]{
		display: block; 
		width:100%;
		margin: 15px 0px;
		border:none;
    	padding: 10px;
	}
	.bttn input[type="button"]{
	    float: right;
	    margin-right: 15px;
	    border: none;
	    color: #fff;
	    background: #1f1b4f;
	    padding: 7px 30px;
	    font-size: 18px;
	    margin-bottom: 20px;
	}
	
	.login-form .email [type="email"]::placeholder, .login-form .cli-pos [type="text"]::placeholder,.login-form .can-name [type="text"]::placeholder, .login-form .cli-name [type="text"]::placeholder, .email [type="text"]::placeholder{
		color: #c1c1c1;
	}

	.error-email-validation {
	    color: #b70000;
	    font-size: 12px;
	    margin: -10px 0px -10px 0px;
	    padding: 5px;
	    line-height: 1.1em;
	    display: none;
	    border-radius: 2px;
	    width: 25%;
	    background: rgba(239, 0, 0, 0.15);
	    border-left: 5px solid #d40b0b;
	}

	.success-email-validation 
	{
	    color: #237508;
	    font-size: 12px;
	    margin: -10px 0px -10px 0px;
	    padding: 5px;
	    line-height: 1.1em;
	    display: none;
	    border-radius: 2px;
	    width: 15%;
	    background: rgba(34, 136, 1, 0.25);
	    border-left: 5px solid #228801;
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
	</style>
	
</head>
<body>
	<nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url() ?>">Survey</a>
          </div>
          <div id="navbar">
            
         
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url() ?>login/logout">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
      
	 <?php if($this->session->flashdata('success')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('error')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; ?>
      <?php endif; ?>
