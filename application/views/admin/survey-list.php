		<style>
			.main-body{
				margin: 100px auto;
				max-width: 900px;
			}
			.main-body .logo{
				margin-bottom: 20px;
			}
			.t-title{ 
				background: #211d62;
		    	color: #fff;
		   	 	padding: 0 15px;
		   	 }
		   	 .t-title h4{
		   	     font-size:1.2rem;
		   	 }
		   	 .clrr{
		   	 	color:#555555;
		   	 	font-weight: bold;
		   	 }
		   	 .feed {
		   	 	padding:15px;
		   	 	color:#555555;
		   	 	
		   	 }
		   	 .caname{
		   	 	    padding: 15px 0 0 15px;
		   	 		color:#211d62;
		   	 }
		   	 .cname{
		   	 	color:#211d62;
		   	 	font-weight: bold;
		   	 }
		   	 .resurvy{
		   	 	color:#211d62;
		   	 	margin-top:15px;
		   	 	font-size: 16px;
		    	font-weight: bold;
			}
		   	 .survey-point{
	    		    margin-left: 0px;
	    		    margin-right:0;
	    		    border-bottom: 1px solid #ececf3;
	    	}
	    	.survey-point .num{
	    		    padding: 0 15px 0 0;
	    			display: inline-block;
	   			 	border-right: 1px solid #ececf3;
	    			margin-top: 10px;
	    			margin-bottom: 10px;
	    			color:#211d62;
	    			font-weight: bold;
	    	}
	    	.survey-point .pnt{
	    		display: inline-block;
	    		padding-left: 10px;
	    	}
	    	.percen span{
	    		display: block;
	    		margin-top: 10px;
	    		float: right;
	    		font-size: 16px;
	    		font-weight: bold;
	    		color:#211d62;
	    	}
	    	.sur-block{
	    		display: inline-block;
	    	}
	    	.t-title span.sur-perc{
	    		float: right;
	    		background: #fff;
	    		color: #211d62;
	    		border-radius: 20px;
	    		width: 50px;
	    		text-align: center;
	    		margin-top: 10px;
	    		font-weight: bold;
			}
			.modal-dialog2{
			    max-width:768px;
			}
			.modal-header .close {
                margin-top: -20px;
            }
            .modal-body {
                padding: 0 15px;
            }
            .modal-dialog {
                width: 700px;
                margin: 30px auto;
            }
	</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


	<div class="container">
		<h2 class="text-uppercase text-center">List of Reviews</h2>
		<div class="row table-responsive">
			<table class="table table-dark table-hover">
				<?php
				if ( !empty( $survey_list ) ) {
				?>
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">NAME</th>
			      <th scope="col">REVIEW</th>
			      <th scope="col">EMAIL</th>
			      <th scope="col">DATE</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
				<?php 
				$i = 1;
					foreach ( $survey_list as $row){
						$user =$this->common_model->get_data_row('submited_survey','id',$row->u_id);
				?>
						
				    <tr>
						<th scope="row"><?= $i ?></th>
						<td><?= $user->client_name; ?></td>
						<td><?= $row->type; ?></td>
						<td><?= $user->email; ?></td>
						<td><?= $row->date; ?></td>
				      	<td>
				      		<!-- <a href="#" title="View Result" data-toggle="modal" data-target="#exampleModal"> -->
				      		<a href="#" title="View Result" class="viewResult">
				      			<button class="btn btn-warning">
				      				<i class="fas fa-eye"></i>
				      			</button>
				      			<input type="hidden" name="userId" value="<?= $row->u_id; ?>">
			      			</a>
				      	</td>
				    </tr>
		  		<?php 
				  	$i++;
				  	};
				}else{
				?>
					<thead>
				      <th scope="col">No Record found</th>
				    </thead>
				<?php
			  	}
			  	?>
			  </tbody>
			</table>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="showSatisfactoryResult" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog2" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Satisfactory Result</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
				<div class="row">
					<p class="caname ">Candidate's Name: <span class="cname scname"></span> </p>
				</div>
				<div class="row t-title">
					<h4>How was your recent interaction with MicroAgility?</h4>
				</div>
				<div class="row">
					<p class="feed"> <span class="feedback"></span></p>
				</div>
				<div class="row t-title">
					<h4 class="sur-block">Recruitment Satisfaction Survey</h4>
					<span id="sur-perc" class="sur-perc"></span>
				</div>
				<div class="row text-area"></div><!-- end of row text area  -->
				<div class="row t-title">
					<h4>Other comment regarding our hiring process</h4>
				</div>
				<div class="row ">
					<p class="feed description"></p>
				</div>
			</div> <!-- end of modal body -->
			 <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	      </div>
	     
	    </div>
	  </div>

	  	<!-- Unsatisfactory Modal -->
		<div class="modal fade" id="showUnsatisfactoryResult" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog2" role="document">
	   	 		<div class="modal-content">
			      	<div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Unsatisfactory Result</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
			      	</div>
			      	<!-- MODAL BODY -->
			      	<div class="modal-body">
						<div class="row">
							<p class="caname">Candidate's Name: <span class="cname usname"></span> </p>
						</div>
						<div class="row t-title">
							<h4>How was your recent interaction with MicroAgility?</h4>
						</div>
						<div class="row">
							<p class="feed"> <span class="rating"></span></p>
						</div>
						<div class="row t-title">
							<h4 class="sur-block">Unsatisfactory/Very unsatisfactory</h4>
						</div>
						<div class="row text-area">
							
						</div><!-- end of row text area  -->
						<div class="row t-title">
							<h4>Other comment regarding our hiring process</h4>
						</div>
						<div class="row ">
							<p class="feed description"></p>
						</div>
					</div> <!-- end of modal body -->
					<!-- MODAL FOOTER -->
					<div class="modal-footer">
			        	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			      	</div>
		      	</div><!-- END OF MODAL CONTENT -->
		     
    		</div><!-- END OF MODAL DIALOG -->
	  	</div>
	

	<script type="text/javascript">
		// GET BASE URL
		var base_url = "<?= base_url(); ?>"

		// INITIALIZE JQUERY READY FUNCTION
		$(function() {
			// ON CLICK CLASS OF `viewResult` BUTTON
	        $('.viewResult').on('click', function( e ) {
	            e.preventDefault();

	            // GET USER ID
	            let userId = $(this).children('input[name="userId"]').val()

	            // AJAX CALL FOR REVIEW DATA
	            $.ajax({
			        url : base_url + "admin/GetReviewData/"+userId,
			        method : "GET",
			        dataType : "JSON",
			        success : function (data) 
			        {
			        	// if ( data.code == 200 ) 
			        	// {
			        		/*****************************
							CHEKCS FOR SATISFACTORY RECORD
			        		*****************************/
			        		if(data.type == 'Very satisfied' || data.type == 'Satisfied' || data.type == 'Neutral' ){
			        		//if(data.type == 'satisfaction' ){
			        		// if ( data.reviewId < 4 )
			        		// {
			        			// CANDIDATE NAME
					        	$('.cname').html(data.client_name)
					        	// AVERAGE RATING
					        	$('.sur-perc').html(data.rating_perc+'%')
					        	// DISPLAY RATING LIST
					        	$(".scname").html('jkhan');
								$('.text-area').html(data.html);
								$('.feedback').html(data.type);
								// DESCRIPTION
								$('.description').html(data.description)
								$('#showSatisfactoryResult').modal('show');
			        		} 
			        		else
			        		{
			        			/************************************
			        			SHOW MODAL FOR UNSATISFACTORY RECORDS
			        			************************************/

			        			// CANDIDATE NAME
					        	//$('.cname').html( data.record.display_name )
					        	$('.cname').html(data.client_name)
					        	// FEEDBACK
					        	$('.feedback').html(data.type);
					        	$('.rating').html(data.rating_perc+'%')

					        	/*******************************
					        	CHEKCS WHERE DATA IS NULL OR NOT
					        	*******************************/ 
					        	if (data.unsatisfac_feedback)
					        	{
					        		$('.text-area').html( '<p class="feed feedback"></p>' )
					        	}
					        	else
					        	{
					        		$('.text-area').html( '<p class="feed feedback">' + data.unsatisfac_feedback + '</p>' )
					        	}
					        	$('.description').html( data.description )

			        			$('#showUnsatisfactoryResult').modal('show');
			        		} // END OF IF-ELSE CONDITION FOR REVIEW ID 

			        	} // END OF IF-CONDITION

			       // } // END OF SUCCESS FUNCTION

			    }); // END OF AJAX CALL

	        }); // END OF ON CLICK FUNCTION
	        /****************************
	        END OF MODAL CHECKS CONDITION
	        ****************************/

	    }); // END OF DOCUMENT GET READY FUNCITON
	</script>
</body>
</html>