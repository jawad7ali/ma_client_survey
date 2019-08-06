<?php 
	$questionsArr = array(
		'1' => 'Did Professional Recruiter and/or Business Relations Specialist understands your business needs/requirements?',
		'2' => 'How was the communication throughout this position?',
		'3' => 'How would you rate the speed of response?',
		'4' => 'How would you rate the quality of profiles received?',
		'5' => 'How would you rate how prepared and briefed the candidate appeared at interview?',
		'6' => 'How do we compare with other consulting companies you have worked in the past?',
		'7' => 'How likely would you be to recommend MicroAgility, Inc. to friends or colleagues in future?'
	);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Microagility Survey</title>
	<link rel="shortcut icon" type="image/png" href="<?= base_url('assets/img/'); ?>MA-logo.png"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/'); ?>bars-square.css">
	<style>
		img.img{
    display: block;
    margin-bottom: 10px;
		}
		.main-body{
			margin-top:50px;
		}
		.unsatisfactory{
				background-color: #1f1b4f;
		}
		.unsatisfactory h3{
			color: #fff;
			margin-top:10px;
			padding-left: 10px;
			font-size: 18px;
		}
		.hiring-process{
				background-color: #1f1b4f;
				margin-top: 30px;
		}
		.hiring-process h3{
			color: #fff;
			margin-top:10px;
			padding-left: 10px;
			font-size: 18px;
		}
		.text-area textarea{
			width:100%;
			background: #f7f7ff;
			resize: none;
			border: none;
		}
		.text-area{
			    background: #f7f7ff;
		}
		.btns{
    		text-align: right;
    		margin-right: -15px;
    		margin-top: 10px;
		}
		.btns .done {
    		background: #1f1b4f;
    		color: #fff;
   		 	border: oldlace;
   		 	width: 80px;
    		padding: 5px;
    	}
    	.btns .skip {
    		background: #555555;
    		color: #fff;
   		 	border: oldlace;
   		 	width: 80px;
    		padding: 5px;
    	}
    	.text-area textarea::placeholder {
    		padding-left: 10px;
    	}
    	.survey-point{
    		    margin-left: 0px;
    		    margin-right:0;
    		    border-bottom: 1px solid #ececf3;
    	}
    	.survey-point .num{
    		    padding: 0 15px;
    			display: inline-block;
   			 	border-right: 1px solid #ececf3;
    			margin-top: 10px;
    			margin-bottom: 10px;
    	}
    	.survey-point .pnt{
    		display: inline-block;
    		padding-left: 10px;
    	}
    	.rating-circle .fa-circle{
    		font-size: 23px;
    		display: inline-block;
   		 	margin-top: 10px;
    		float: right;
    		padding: 0 3px;
    		color:#1f1b4f;
    	}
    	#rating{
    		float:right;
    		margin-top: 6px;
    	}
    	.br-theme-bars-square .br-widget a{
    		height:25px;
    		width:25px;
    		border-radius:50%;
    	}

	</style>
</head>

	<div class="container main-body">
	<form id="email-survey-form" method="post" action="client/saveReviews">
		<div class="main-section">
		<div class="row">
			<img src="<?= base_url('assets/img/'); ?>MA-logo.png" alt="" class="img">
		</div>
		<input type="hidden" name="selected_rate" value="<php echo $this->uri->segment('3'); ?>" >
		<input type="hidden" name="user_id" value="<php echo $this->uri->segment('4'); ?>" >
		<input type="hidden" name="review_id" value="<php echo $this->uri->segment('5'); ?>" >
			
		<?php 
			if($this->uri->segment('3') == 'Very%20satisfied' || $this->uri->segment('3') == 'Satisfied' || $this->uri->segment('3') == 'Neutral' ){
		?>
		<input type="hidden" name="form_type" value="satisfaction">
		<div class="row unsatisfactory">
			<h3>Recruitment Satisfaction Survey</h3>
		</div>
		<div class="row text-area">
			 
			<?php 
				for ($i=1; $i < count($questionsArr); $i++) { 
					 
			?>
					<div class="survey-point row">
						<div class="col-md-9">
							<span class="num"><?= $i; ?></span>
							<input type="hidden" name="message[]" value="<?= $i; ?>">
							<span class="pnt"><?= $questionsArr[$i] ?></span>
						</div>
						<div class="col-md-3">
							<div id="rating">
								<select class="example-square" id="firstRating" name="rating[]" autocomplete="off">
								<option value=""></option>
								<option value="1"></option>
								<option value="2"></option>
								<option value="3"></option>
								<option value="4"></option>
								<option value="5"></option>
								</select>
							</div>
						</div>
					</div>
			

			<?php } ?>
			 
		</div>
		<div class="main-section">
			<div class="row hiring-process">
				<h3>Is there anything else that you would like to tell us about the service you received from MicroAgility?</h3>
			</div>
			<div class="row text-area">
				<div>
					<textarea name="description" id="" cols="30" rows="5" placeholder="Type your feedback here"></textarea>
				</div>
			</div>
		</div>

		<?php 
			}else{
		?>
		<input type="hidden" name="form_type" value="unsatisfactory">
			<div class="main-section">
			<div class="row hiring-process">
				<h3>Unsatisfactory / Very unsatisfactory</h3>
			</div>
			<div class="row text-area">
				<div>
					<textarea name="description" id="" cols="30" rows="5" placeholder="Type your feedback here"></textarea>
				</div>
			</div>
		</div>
		<div class="main-section">
			<div class="row hiring-process">
				<h3>Please let us know how can we improve our services?</h3>
			</div>
			<div class="row text-area">
				<div>
					<textarea name="description" id="" cols="30" rows="5" placeholder="Type your feedback here"></textarea>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-9"></div>
			<div class="col-md-3">
				<div class="btns"> 
					<input type="submit" value="Done" class="done" id='done-btn'>
					<input type="button" value="Skip" class="skip" id="skip-btn">
				</div>
			</div>
		</div>
		</form>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets/js/'); ?>jquery.barrating.min.js"></script>
	<script src="<?= base_url('assets/js/'); ?>examples.js"></script>
	<script>
		var base_url = "<?= base_url(); ?>";

		var userId = "<?= $userId ?>";
		var ratingId = "<?= $ratingId ?>";
		var candidate_name = "<?= $candidate_name ?>";

		$('#firstRating').on('change', function (){
			$('#skip-btn').prop('disabled', true).css({'opacity' : '0.6'})
			$('#done-btn').prop('disabled', false).css({'opacity' : '1'});
		})

		$(function (){
			$('#done-btn').prop('disabled', true).css({'opacity' : '0.6'});

			$.ajax({
				'url'    : base_url + 'check/user/' + userId,
				'method' : 'POST',
				success : function (res) {
					
					let data = JSON.parse(res)
					
					if ( data.status == 1 ) 
					{
						$('#done-btn').prop('disabled', true).css({'opacity' : '0.6'});
						$('#skip-btn').prop('disabled', true).css({'opacity' : '0.6'})
					}
					else if ( data.status == 0) 
					{
						$('#skip-btn').prop('disabled', true).css({'opacity' : '0.6'})
						$('#done-btn').prop('disabled', true).css({'opacity' : '0.6'});
					}
					// console.log(data.message)
				}
			});
			$('#email-survey-form').on('submit', function (e){
				e.preventDefault();
				// console.log( $(this).serializeArray() );

				$.ajax({
					'url'    : base_url + 'save/email/review/' + ratingId + '/' + userId + '/' + candidate_name,
					'method' : 'POST',
					'data'	 : $(this).serializeArray(),
					success  : function ( res ) {
						let data = JSON.parse( res );
						// console.log(data);
						if ( data.status == 1 )
						{
							$('#done-btn').prop('disabled', true).css({'opacity' : '0.6'});
						}
						else
						{
							$('#done-btn').prop('disabled', false).css({'opacity' : '1'});
						}

						window.location = base_url + 'survey/end/' + userId;
					}
				});
                
			});

			$('#skip-btn').on('click', function (e) {
				e.preventDefault();
				
				$formData = $('#email-survey-form').serializeArray()
				// console.log($('#email-survey-form').serializeArray());

				$.ajax({
					'url'    : base_url + 'skip/email/review/' + ratingId + '/' + userId + '/' + candidate_name,
					'method' : 'POST',
					'data'	 : $formData,
					success  : function ( res ) 
					{

						let data = JSON.parse( res );
						console.log(data);
						if ( data.status == 0 )
						{
							$('#done-btn').prop('disabled', true).css({'opacity' : '0.6'});
							$('#skip-btn').prop('disabled', true).css({'opacity' : '0.6'});
						}
						window.location = base_url + 'survey/end/' + userId;
					}
				});
				
			});
		});
		// $('#firstRating').on('change', function () {
		// 	console.log( $(this).val() );
		// });
	</script>
</body>
</html>