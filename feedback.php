<?php 
$title = "Feedback | Lebaneseblogs.com";
$description = "Get in touch, tell us what you think";
$page = "feedback";

include_once("includes/top_part.php");
?>

<div class ="page_wrapper">
	<div class="container">
		<div class="preset2 offset2 span8">
		
		<h2>Feedback</h2>


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
</div>


<?php 

function drawform($errormessage=NULL){
	?>

		<form method ="post" action ="feedback.php" >
		  <legend>Send us a quick message: </legend>
		  <fieldset>
		    <textarea rows="5" class ="span6" placeholder="Example: I just wanted to tell you how awesome/terrible you are - fan@haters.com" name = "submittedText"></textarea>
		    <span class="help-block">Tip: If you want us to respond to you, add your email address somewhere in the body of your feedback</span>
		    <button type="submit" name ="submit" class="btn btn-large">Submit</button>
		  </fieldset>
		</form>



	<?php
}


include_once("includes/bottom_part.php");
 ?>