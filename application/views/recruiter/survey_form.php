
	<div class="container main-body">
	    
	    <div class="main-section">
			<div class="row">
				<img src="<?= base_url('assets/img/'); ?>MA-logo.png" alt="" class="img">
			</div>
		</div>
		<div class="row body-content">
	    
	    
		<div class="row rec">
			<h3>Recruitment Survey</h3>
		</div>
	<form action="recruiter/submit_survey" method="post" id="recruitment-survey-frm">
		<img class="loader" style="display: none; position: absolute; width: 21%; right: 43%; z-index: 99;" src="<?php echo base_url() ?>assets/loader.gif" >
		<div class="row login-form">
			
			<?php 
			if ( isset( $_GET['message'] ) && !empty ( $_GET['message'] ) ) : 
			?>
				<div class="alert alert-success">
					<?= $_GET['message'] ?>
				</div>
			<?php
			endif;
			?>
			<div id="message"></div>
			<div class="col-md-1"></div>
		<div class="col-md-10">

			<div class="can-name">
				 <input type="text" name="poc" id="can-name" placeholder="Point of Contact (Decision Maker)" required="">
			</div>
			<div class="email"> 
				<input type="email" id="candidate_email" name="candidate_email" placeholder="Email ID (Business ID)" required="">
				<span class="error-email-validation"></span>
			</div>
			
			<div class="cli-pos">
				 <input type="text" name="requirment" id="cli-pos" placeholder="Requirment" required="">
			</div>
			<div class="email"> 
				<input type="text" id="candidate_company" name="client_company" placeholder="Client Name (Organization)" required="">
			</div>
		</div>
			<div class="col-md-1"></div>
			<div class="bttn">
				<div class="col-md-5"></div>
				<div class="col-md-6" style="text-align: right;">
					<input type="submit" class="email-sent-btn" value="Send">
				</div>
				
			</div>
		</div>
	</form>
	
	
	
	</div>
	</div>
 
</body>
</html>