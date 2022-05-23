<?php
if ( isset( $_GET['t'] ) && $_GET['t'] !== '' ) {
	email_verification( $db, $_GET['t'] );
?>

<div class="grow">
	<h1>Your Email was successfully verified!</h1>
</div>

<?php
}