<?php 

include_once('init.php');

$phrase = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, error, perspiciatis ab quod quibusdam enim dolor cupiditate eius assumenda consequatur minus tenetur quisquam ut! Ullam.";

echo "original Phrase: $phrase <br>";

echo "limited Phrase: ".Lb_functions::limitWords(10, $phrase);

?>