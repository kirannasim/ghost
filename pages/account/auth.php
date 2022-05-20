<?php 
	require_once('snippets/notice.php');
?>

<main class="content fullh <?= isset(gForm::$response['has-error']) ? 'invalid has-error-'.implode(' has-error-', gForm::$response['has-error']) : '' ?>">
	<div class="grow">
		<div class="left">
			<h2>Your all in one automated tasks solution</h2>
			<p>GhostCaptcha Strives to provide everything You need for automation in one place.</p>
			<video width="500" height="500" autoplay="autoplay" muted loop="loop" poster="/assets/video/dragon-poster.webp" >
				<source src="/assets/video/dragon4.mp4" type="video/mp4">
				Your browser doesn't support HTML5 video tag.
			</video>
		</div>
		<div>
			<div class="form-wrap">
				<h1>
					<?= G::if_slug([
						'registration' => 'Sign up',
						'login' => 'Login',
						'reset-password' => 'Password restoration',
						'new-password' => 'Enter new password',
					])?>
				</h1>
				<form class="gform form-<?= G::$slug ?>" method="POST" action="/<?= G::$slug ?>">
					<input type="hidden" name="action" value="<?= G::$slug ?>">

					<?php if(G::$slug == 'registration' || G::$slug == 'login') {?>
						<div class="field">
							<input type="email" name="email" id="email" placeholder="Enter your e-mail address" value="<?= $_POST['email'] ?? '' ?>">
						</div>
						<div class="field">
							<input type="password" name="password" id="password" placeholder="Enter your password">
						</div>
						<?php if (G::$slug == 'registration') {?>
							<div class="field">
								<input type="password" name="password2" id="password2" placeholder="Confirm your password">
							</div>
						<?php } ?>

						<div class="under-form">
							<label class="g_checkbox">
								<input type="checkbox" name="remember" id="remember">
								<b></b>
								<span>Remember me</span>									
							</label>
							<a class="anim" href="/reset-password">Forgot Password ?</a>
						</div>
					<?php } ?>

					<?php if(G::$slug == 'reset-password') {?>
						<div class="field">
							<input type="email" name="email" id="email" placeholder="Enter your e-mail address">
						</div>
					<?php } ?>

					<?php if(G::$slug == 'new-password') {?>
						<div class="field">
							<input type="password" name="password" id="password" placeholder="Enter new password">
						</div>
					<?php } ?>

					<input type="submit" value="<?= G::if_slug([
							'registration' => 'Sign Up',
							'login' => 'Login',
							'reset-password' => 'Restore',
							'new-password' => 'Update password',
					])?>">

					<div class="gform-footer">						
						<?= G::if_slug([
							'registration' => 'Are you a member? <a class="anim-b" href="/login">Sign in</a>',
							'login reset-password new-password' => 'Not a member yet? <a class="anim-b" href="/registration">Sign Up</a>',
						])?>
					</div>

				</form>
			</div>


		</div>
	</div>
</main>