<link rel="stylesheet" href="/assets/min/admin.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

<main class="content">
	<div class="grow">
		<div class="left">
			<div class="banner">
				<div class="wrap">
					<h2>Hi Lucky Luke </h2>
					<h3>Welcome! Manage your all tasks & daily work here.</h3>
				</div>
			</div>
			<h1>Dashboard</h1>
			<div class="shart-tabs">
				<a href="#" data-target="earned_amount" class="active">Earned Amount</a>
				<a href="#" data-target="amount_of_sales">Amount of Sales</a>
				<a href="#" data-target="amount_of_signups">Amount of Signups</a>
				<a href="#" data-target="daily_active_users">Daily Active Users</a>
				<a href="#" data-target="captcha_requests">Captcha Requests</a>
			</div>
			<div class="sharts-wrap">
				<div class="chart" id="earned_amount"></div>
				<div class="chart" id="amount_of_sales"></div>
				<div class="chart" id="amount_of_signups"></div>
				<div class="chart" id="daily_active_users"></div>
				<div class="chart" id="captcha_requests"></div>
			</div>
		</div>
		<div class="right">
			<div class="top">
				<?= G::icon('bell'); ?>
				<div class="account-nav">
					<?= G::icon('account'); ?> Admin
				</div>
			</div>
			<div class="calendar-wrap">

			</div>
			<div class="form-wrap">
				<form action="" class="gform">

				</form>
			</div>
		</div>
	</div>
</main>