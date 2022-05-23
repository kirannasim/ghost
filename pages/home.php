<main class="content">
	<h1>Your favorite Captcha Solution for automation</h1>

	<div class="top-section grow">
		<div class="left">
			<div class="wrap">
				<h2>We solve any complex captcha</h2>
				<p>We're here to provide the best captcha solving solution available on the market. if You have any problem with Your scripts, We have an active community on discord ready to help.</p>
				<a class="btn" href="/checkout">Buy Now</a>
			</div>
		</div>
		<div class="dragon">
			<div class="wrap">
				<div class="circle">
					<video width="460" height="460" autoplay="autoplay" muted loop="loop" poster="/assets/video/dragon-poster.webp" >
						<source src="/assets/video/dragon4.mp4" type="video/mp4">
						Your browser doesn't support HTML5 video tag.
					</video>
				</div>
			</div>
		</div>
		<img width="460px" height="458px" class="re1" 
			src="/assets/img/pages/home/top-rectangle.png"
			srcset="/assets/img/pages/home/top-rectangle@2x.png 2x" alt="background"
			>
	</div>

	<div class="section-2">
		<h2>Solvable Services</h2>
		<div class="sub-sec1">
			<h3>Why Choose <br>GhostCaptcha?</h3>
			<p>We have the most active and helpful community that will satisfy any automation needs You might have</p>
			<div class="sub-sec2">
				<?php 
					foreach(['99% uptime','Easy integration','Pay as you go','Resolve 10,000+ captchas/minute','Cheapest price on the market'] as $item) {?>
						<div>
							<?= G::icon('checked', 28, 26); ?>
							<span><?= $item; ?></span>
						</div> 
					<?php }
				?>
			</div>
		</div>
	</div>


	<div class="section-3 grow">
		<div class="left">
			<h3>Automatic captcha <br>solving service</h3>
			<p>We have the best solvers and cheapest option out there.</p>
			<div class="list">
				<?php 
					foreach(['Cheapest','Community','Most Stable','Support','Incredible'] as $item) {?>
						<div>
						<?= G::icon('checked', 28, 26); ?>
							<span><?= $item; ?></span>
						</div>
					<?php }
				?>
			</div>
			<a href="/registration" class="btn">Check Documentation</a>
		</div>
		<div class="right">
			<img width="681px" height="371px"  class="re1"
				src="/assets/img/pages/home/section-3.webp"
				srcset="/assets/img/pages/home/section-3@2x.webp 2x" alt="background"
			>
		</div>		
	</div>

	<div class="section-4">
		<h3 class="sec-title">Solvable Services</h3>
		<div class="g-list odd a-right">
			<div class="g-item">
				<div class="title">Service </div>
				<div class="title">1000 Requests</div>
				<div class="title">Speed</div> 
				<div class="title">Success Avg</div>
				<div>Status</div>
			</div>
			<?php 
				$list = json_decode(file_get_contents('data/list-log2.json'), 1);
				foreach($list as $item) { ?>
				<div class="g-item">
					<div class="title"><?= $item['service']; ?></div>
					<div class="title"><?= $item['requests']; ?>$</div>
					<div class="title"><?= $item['speed']; ?>/5.00 seconds</div> 
					<div class="title" ><?= $item['success']; ?>%</div>
					<div><?= ($item['status']) ? G::icon('checked', 28, 26) : '-' ?></div>
				</div>
			<?php }?>
		</div>
	</div>

	<div class="section-7">
		<h2 class="sec-title">Automated One-Time and <br> Rented SMS-Verification</h2>
		<div class="grow">
			<div class="left">
				<h3>One API KEY to Rule <br> them all</h3>
				<p>We believe in efficiency and convenience, You are now able to use the same API-Key and Balance to purchase SMS Verification from over 50+ possible Countries.</p>
				<div class="lists">
					<ul class="small-list">
						<?php 
							foreach(['starting 0.03$/sMS','OVER 50+ Countries','All Existing Services','Possibility to Rent Up to 1 Week'] as $item) {?>
								<li>
									<?= G::icon('checked', 22, 20); ?>
									<span><?= $item; ?></span>
								</li>
							<?php }
						?>
					</ul>
					<ul>
						<?php 
							foreach(['No Need to Authenticate to check SMS History', 'Same Balance','Custom Panel (on request) for Rented Phone Numbers (Add Logo/Customize)'] as $item) {?>
								<li>
									<?= G::icon('checked', 22, 20); ?>
									<span><?= $item; ?></span>
								</li>
							<?php }
						?>
					</ul>
				</div>
				<a href="/registration" class="btn">Learn more</a>
			</div>
			<div class="right">
				<img width="502px" class="re1"
					src="/assets/img/pages/home/country-logos.webp"
					srcset="/assets/img/pages/home/country-logos@2x.webp 2x" alt="background"
				>
			</div>		
		</div>
	</div>

	<div class="section-5">
		<h3 class="sec-title">Purchase</h3>
		<p>Credit purchased will be usable not only for captcha, But for all services We offer like Phone Numbers for verifications and Monthly Software Licenses</p>
		<div class="cards">
			<?php 
				foreach([
					['name' => '5$ Balance', 'icon' => 'rubin', 'price' => '5', 'desc' => 'Credit Balance to use all around the shop'],
					['name' => '50$ Balance', 'icon' => 'gold-rubin', 'price' => '50', 'desc' => 'Credit Balance to use all around the shop'],
					['name' => '20$ Balance', 'icon' => 'rubin', 'price' => '20', 'desc' => 'Credit Balance to use all around the shop'],
				] as $prod) { ?>
					<div class="prod-card">
						<h5><?= $prod['name'] ?></h5>
						<?= G::icon($prod['icon']); ?>
						<div class="price">$<?= $prod['price'] ?></div>
						<p><?= $prod['desc'] ?></p>
					</div>
				<?php }
			?>
		</div>
	</div>

	<div class="section-6">
		<h3 class="sec-title">Extras</h3>
		<p>Extra addons You could add to enjoy the best experience from our Service</p>
		<div class="slider-row">
			<?php 
				foreach([
					['name' => 'Discord Role', 'subtitle' => 'For Bot Operators', 'price' => '50<i>/Montly</i>', 'desc' => 'Talk With other Bot Operators Freely to exchange Knowledge'],
					['name' => 'Code for You', 'subtitle' => 'You need code fixed? You need a custom bot?', 'price' => '100', 'desc' => 'Join Discord and Open a Ticket'],
					['name' => 'Faster Speed Upgrade', 'subtitle' => 'You Need Captchas Solved Faster?', 'price' => '25<i>/Montly</i>', 'desc' => 'From 5 Seconds to Instant/1 Second'],
					['name' => 'More Simultaneous', 'subtitle' => 'You Need More Captchas Solved at the same time?', 'price' => '15<i>/Montly</i>', 'desc' => '50, 100, 999'],
					['name' => 'More Simultaneous', 'subtitle' => 'You Need More Captchas Solved at the same time?', 'price' => '15<i>/Montly</i>', 'desc' => '50, 100, 999'],
					['name' => 'More Simultaneous', 'subtitle' => 'You Need More Captchas Solved at the same time?', 'price' => '15<i>/Montly</i>', 'desc' => '50, 100, 999'],
				] as $prod) { ?>
					<div class="slide">
						<h5><?= $prod['name'] ?></h5>
						<span><?= $prod['subtitle'] ?></span>
						<div class="price">$<?= $prod['price'] ?></div>
						<p><?= $prod['desc'] ?></p>
						<a  href="/checkout" class="btn">Subscribe now</a>
					</div>
				<?php }
			?>
		</div>
	</div>


</main>