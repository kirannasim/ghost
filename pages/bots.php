<main class="content">

	<div class="creation-section">
		<div class="title">
			<h1>Account creation</h1>
			<a class="btn sell-script" href="/checkout">+ Sell Script</a>
		</div>
		<div class="wrap-slider">
			<div class="slider-row">
				<?php $list = json_decode(file_get_contents('data/bots.json'), 1);
				foreach($list as $item) { ?>
					<div class="slide">
						<div class="img-wrap">
							<img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>">
						</div>
						<h6><?= $item['title'] ?></h6>
						<div class="attrs">
							<b>Price</b>
							<span>$<?= $item['price'] ?></span>
						</div>
						<div class="attrs">
							<b>Duration</b>
							<span><?= $item['duration'] ?> days</span>
						</div>
						<div class="sep"></div>
						<p><?= $item['about'] ?></p>
						<div class="footer">
							<a href="/checkout?id=<?= $item['_id'] ?>" class="btn">Buy licence</a>
							<a href="#" class="btn download<?= $item['donwload'] ? '' : ' unavailable' ?>">Download</a>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="arrows">
				<?= G::icon('larrow'); ?>
				<?= G::icon('rarrow'); ?>
			</div>
		</div>
	</div>
	
	<div class="creation-section">
		<div class="title">
			<h2>Account Management</h2>
			<a class="btn sell-script" href="/checkout">+ Sell Script</a>
		</div>
		<div class="wrap-slider">
			<div class="slider-row">
				<?php $list = json_decode(file_get_contents('data/bots.json'), 1);
				foreach($list as $item) { ?>
					<div class="slide">
						<div class="img-wrap">
							<img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>">
						</div>
						<h6><?= $item['title'] ?></h6>
						<div class="attrs">
							<b>Price</b>
							<span>$<?= $item['price'] ?></span>
						</div>
						<div class="attrs">
							<b>Duration</b>
							<span><?= $item['duration'] ?> days</span>
						</div>
						<div class="sep"></div>
						<p><?= $item['about'] ?></p>
						<div class="footer">
							<a href="/checkout?id=<?= $item['_id'] ?>" class="btn">Buy licence</a>
							<a href="#" class="btn download<?= $item['donwload'] ? '' : ' unavailable' ?>">Download</a>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="arrows">
				<?= G::icon('larrow'); ?>
				<?= G::icon('rarrow'); ?>
			</div>
		</div>
	</div>






	
</main>