<?php 
$title = "Feedback | Lebaneseblogs.com";
$description = "Get in touch, tell us what you think";
$page = "feedback";
$root_is_at = "..";

include_once("$root_is_at/includes/top_part.php");
?>

    <div id="entries-main-container">
    	<div class="text_content">

			<?php 
			if (isset($_POST["submit"])) {
				$submitted = $_POST['submittedText'];
				mail("mustapha.hamoui@gmail.com", "[lebaneseblogs.com] FEEDBACK", $submitted);
				echo '<div class="alert alert-success">Your feedback has been submitted! If it requires a response, kindly give us a few hours</div>';

			} else {
				drawform();
			}
			
			?>
	</div>
</div>


<?php 

function drawform($errormessage=NULL){
	?>
		<div class="row">
			<div class="span4">
				<h3>Send us a quick message: </h3>
				<form method ="post" action ="feedback.php" >
			    	<textarea rows="5" cols ="45" class ="span6" placeholder="Example: I just wanted to tell you how awesome/terrible you are - fan@haters.com" name = "submittedText"></textarea>
			    	<p class ="small">Tip: If you want us to respond to you, add your email address somewhere in the body of your feedback</p>
			    	<button type="submit" name ="submit" class="btn btn-large">Submit</button>
				</form>
			</div>
		</div>



	<?php
}


include_once("$root_is_at/includes/bottom_part.php");
 ?>