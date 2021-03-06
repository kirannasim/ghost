<?php 
	require_once('snippets/notice.php');
?>
<script defer src="https://js.stripe.com/v3/"></script>
<script defer src="/payments/stripe/stripe-elements.js"></script>

<main class="content <?= isset(gForm::$response['has-error']) ? 'invalid has-error-'.implode(' has-error-', gForm::$response['has-error']) : '' ?>">
	<div class="grow">
		<div class="bg"></div>
		<div class="left">			
			<h1>Accepted Payment Methods</h1>
			<div class="sep"></div>
			<div class="p-methods">
				<div class="pm active" data-target="p1">
					<div class="wrap">
						<svg width="36" height="24" viewBox="0 0 36 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M1.3251 0.147242C0.831931 0.336759 0.331034 0.844552 0.143862 1.34476C0.000413796 1.72828 0 1.75648 0 12C0 22.2435 0.000413796 22.2717 0.143862 22.6552C0.335862 23.1684 0.831586 23.6641 1.34476 23.8561L1.72931 24H17.6552H33.581L33.9656 23.8561C34.4788 23.6641 34.9745 23.1684 35.1665 22.6552C35.3099 22.2717 35.3103 22.2435 35.3103 12C35.3103 1.75648 35.3099 1.72828 35.1665 1.34476C34.9745 0.831586 34.4788 0.335862 33.9656 0.143862L33.581 0L17.6353 0.00358634C1.77841 0.00717255 1.68766 0.00800014 1.3251 0.147242ZM33.6605 1.64986L33.8621 1.85145V3.75331V5.65517H17.6552H1.44828V3.75331V1.85145L1.64986 1.64986L1.85145 1.44828H17.6552H33.4589L33.6605 1.64986ZM33.8621 16.0398V22.1486L33.6605 22.3501L33.4589 22.5517H17.6552H1.85145L1.64986 22.3501L1.44828 22.1486V16.0398V9.93103H17.6552H33.8621V16.0398ZM6.15952 14.1443C5.6469 14.2943 5.48021 14.9391 5.85676 15.3157L6.05834 15.5172H12.7094H19.3605L19.5355 15.3423C19.6317 15.246 19.7304 15.0877 19.7548 14.9905C19.8182 14.7381 19.6793 14.3772 19.462 14.2298C19.2852 14.1097 18.954 14.1029 12.8276 14.0917C9.00593 14.0848 6.28979 14.1062 6.15952 14.1443ZM6.15952 16.9726C5.64717 17.1208 5.48014 17.7666 5.85676 18.1432L6.05834 18.3448H9.88117H13.704L13.8837 18.1783C14.3309 17.7639 14.1177 17.0614 13.5077 16.9394C13.1677 16.8714 6.40359 16.902 6.15952 16.9726Z" fill="white"/>
						</svg>
					</div>
					<span>Pay with Credit card</span>
				</div>
				<div class="pm" data-target="p2">
					<div class="wrap">
						<svg width="74" height="20" viewBox="0 0 74 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12.4855 0.954128C11.5609 0.318556 10.3545 0 8.86619 0H3.1042C2.64794 0 2.39587 0.228185 2.34798 0.684114L0.00734721 15.3769C-0.0169794 15.5212 0.0191251 15.6532 0.115331 15.7732C0.210986 15.8934 0.331298 15.9531 0.475386 15.9531H3.21229C3.69233 15.9531 3.95618 15.7255 4.00461 15.269L4.65274 11.3079C4.6764 11.1159 4.76083 10.9598 4.90492 10.8396C5.0489 10.7196 5.22898 10.6412 5.44506 10.6053C5.66113 10.5696 5.86488 10.5515 6.05729 10.5515C6.24916 10.5515 6.47712 10.5638 6.74163 10.5877C7.00548 10.6115 7.17368 10.6233 7.24578 10.6233C9.31034 10.6233 10.9309 10.0416 12.1075 8.87676C13.2835 7.71261 13.8722 6.09825 13.8722 4.03303C13.8722 2.61659 13.4095 1.59036 12.4855 0.953797V0.954128ZM9.51464 5.36592C9.39422 6.20634 9.08249 6.75826 8.57834 7.02244C8.07409 7.28695 7.35387 7.4186 6.41768 7.4186L5.2292 7.45448L5.84155 3.6011C5.88932 3.33725 6.0453 3.20516 6.30959 3.20516H6.99403C7.95389 3.20516 8.65055 3.34352 9.08271 3.61915C9.51464 3.89544 9.65873 4.47784 9.51464 5.36592Z" fill="#0041B8"/>
							<path d="M73.2915 0H70.627C70.3621 0 70.2062 0.132091 70.1587 0.396381L67.8178 15.3776L67.7817 15.4495C67.7817 15.5702 67.8297 15.6837 67.9261 15.7918C68.0215 15.8996 68.1421 15.9537 68.286 15.9537H70.6632C71.1185 15.9537 71.3707 15.7261 71.4195 15.2696L73.7601 0.540468V0.504694C73.76 0.168415 73.6035 0.000441737 73.2915 0.000441737V0Z" fill="#009CDE"/>
							<path d="M41.0961 5.79858C41.0961 5.67881 41.0479 5.56456 40.9524 5.45679C40.8561 5.34881 40.748 5.29443 40.6283 5.29443H37.8554C37.5907 5.29443 37.3747 5.41508 37.2069 5.65449L33.3897 11.2726L31.8052 5.87079C31.6845 5.48696 31.4208 5.29443 31.0129 5.29443H28.3116C28.1913 5.29443 28.0833 5.34859 27.9878 5.45679C27.8915 5.56456 27.8438 5.67904 27.8438 5.79858C27.8438 5.8469 28.0779 6.5549 28.5459 7.92335C29.014 9.29224 29.5181 10.7688 30.0584 12.3534C30.5986 13.9377 30.8805 14.7785 30.9046 14.8737C28.9358 17.563 27.9518 19.0035 27.9518 19.1952C27.9518 19.5076 28.1076 19.6635 28.42 19.6635H31.1929C31.4569 19.6635 31.6728 19.5437 31.8413 19.3035L41.0245 6.05054C41.0722 6.00299 41.0961 5.91933 41.0961 5.79847V5.79858Z" fill="#0041B8"/>
							<path d="M66.9195 5.29431H64.1825C63.846 5.29431 63.6427 5.69058 63.5706 6.48301C62.9456 5.52293 61.806 5.04224 60.149 5.04224C58.4206 5.04224 56.9499 5.69058 55.7377 6.98705C54.5252 8.28351 53.9192 9.8085 53.9192 11.5609C53.9192 12.9777 54.3333 14.1059 55.1614 14.9459C55.9897 15.7868 57.0999 16.2064 58.4929 16.2064C59.189 16.2064 59.8972 16.0621 60.6174 15.7742C61.3376 15.4862 61.9013 15.1022 62.3102 14.6219C62.3102 14.646 62.2857 14.7536 62.2382 14.9456C62.1897 15.138 62.166 15.2825 62.166 15.3778C62.166 15.7624 62.3217 15.9539 62.6343 15.9539H65.1193C65.5749 15.9539 65.8393 15.7263 65.9111 15.2698L67.3878 5.87044C67.4115 5.72624 67.3756 5.59448 67.2797 5.47428C67.1832 5.35452 67.0634 5.29431 66.9195 5.29431ZM62.22 12.3891C61.6077 12.9893 60.8694 13.2893 60.0052 13.2893C59.3086 13.2893 58.7449 13.0975 58.3126 12.7132C57.8802 12.3299 57.6641 11.8016 57.6641 11.1286C57.6641 10.241 57.9643 9.49005 58.5647 8.87792C59.1641 8.26568 59.9091 7.95967 60.7974 7.95967C61.469 7.95967 62.0273 8.1577 62.4719 8.55364C62.9156 8.94991 63.1384 9.4961 63.1384 10.1925C63.1382 11.0568 62.8321 11.7892 62.22 12.3891Z" fill="#009CDE"/>
							<path d="M26.0097 5.29431H23.2727C22.9361 5.29431 22.7325 5.69058 22.6604 6.48301C22.0121 5.52293 20.8716 5.04224 19.2391 5.04224C17.5105 5.04224 16.0398 5.69058 14.8276 6.98705C13.615 8.28351 13.009 9.8085 13.009 11.5609C13.009 12.9777 13.4232 14.1059 14.2516 14.9459C15.0799 15.7868 16.19 16.2064 17.5826 16.2064C18.2545 16.2064 18.9512 16.0621 19.6713 15.7742C20.3915 15.4862 20.9677 15.1022 21.3999 14.6219C21.3036 14.9097 21.2558 15.1619 21.2558 15.3778C21.2558 15.7624 21.4118 15.9539 21.724 15.9539H24.2088C24.6646 15.9539 24.929 15.7263 25.0011 15.2698L26.4775 5.87044C26.5012 5.72624 26.4653 5.59448 26.3695 5.47428C26.2734 5.35452 26.1536 5.29431 26.0097 5.29431ZM21.3101 12.4069C20.6977 12.9958 19.9471 13.2893 19.0594 13.2893C18.3627 13.2893 17.8045 13.0975 17.3847 12.7132C16.9643 12.3299 16.7544 11.8016 16.7544 11.1286C16.7544 10.241 17.0544 9.49005 17.6548 8.87792C18.2546 8.26568 18.999 7.95956 19.8876 7.95956C20.5595 7.95956 21.1177 8.1577 21.5623 8.55364C22.0061 8.94991 22.2284 9.4961 22.2284 10.1925C22.2283 11.0809 21.9223 11.8194 21.3101 12.4069Z" fill="#0041B8"/>
							<path d="M53.396 0.954128C52.4716 0.318556 51.2655 0 49.7769 0H44.0508C43.5705 0 43.3063 0.228185 43.2586 0.684114L40.9177 15.3769C40.8934 15.5212 40.9295 15.6532 41.0258 15.7732C41.1211 15.8934 41.2417 15.9531 41.3858 15.9531H44.3387C44.6267 15.9531 44.8187 15.7973 44.915 15.4851L45.5632 11.3079C45.5871 11.1159 45.6711 10.9598 45.8154 10.8396C45.9595 10.7196 46.1394 10.6412 46.3557 10.6053C46.5715 10.5696 46.7753 10.5515 46.9678 10.5515C47.1598 10.5515 47.3876 10.5638 47.6519 10.5877C47.9159 10.6115 48.0845 10.6233 48.156 10.6233C50.221 10.6233 51.8412 10.0416 53.0178 8.87676C54.1943 7.71261 54.7824 6.09825 54.7824 4.03303C54.7825 2.61659 54.3201 1.59025 53.396 0.953797V0.954128ZM49.7049 6.87824C49.1767 7.2383 48.3842 7.41827 47.3282 7.41827L46.1756 7.45437L46.7878 3.60088C46.8354 3.33714 46.9915 3.20483 47.2558 3.20483H47.9039C48.4321 3.20483 48.8522 3.22893 49.1648 3.27682C49.4763 3.32503 49.7769 3.47484 50.065 3.7268C50.3532 3.97898 50.4971 4.34531 50.4971 4.82524C50.4971 5.83396 50.2327 6.51786 49.7049 6.87824Z" fill="#009CDE"/>
						</svg>
					</div>
					<span>Pay with PayPal</span>
				</div>
				<div class="pm" data-target="p3">
					<div class="wrap">
						<svg class="bitpay" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M28 14.0059C27.997 21.7383 21.7257 28.0037 13.9941 28C6.26246 27.997 -0.00296097 21.7264 1.04981e-06 13.9941C0.00296307 6.26468 6.26912 0.000740571 13.9985 6.56021e-08C21.7309 -0.00074044 27.9993 6.26764 28 14V14.0059Z" fill="#F7931A"/>
							<path d="M16.5513 11.2849C16.5513 13.074 13.7426 12.8652 12.8488 12.8652V9.7032C13.7426 9.70172 16.5476 9.41737 16.5476 11.2834L16.5513 11.2849ZM17.2874 16.2034C17.2874 18.1694 13.9218 17.9458 12.8481 17.9465V14.4602C13.9218 14.4595 17.2881 14.1507 17.2881 16.2019L17.2874 16.2034ZM19.503 10.5755C19.323 8.69982 17.7036 8.07113 15.6598 7.89192V5.29053H14.0766V7.8238C13.6604 7.8238 13.2346 7.83194 12.8118 7.84083V5.29127H11.2293V7.89192C10.8865 7.89859 10.5495 7.90525 10.2215 7.90525V7.89711H8.03699V9.59064C8.03699 9.59064 9.20625 9.56843 9.18699 9.59064C9.62908 9.53363 10.0356 9.84316 10.0978 10.2845V13.2465C10.1534 13.2465 10.2096 13.2502 10.2652 13.2576H10.0978V17.4096C10.0793 17.7184 9.81494 17.9532 9.50689 17.9347H9.50541C9.5254 17.9524 8.35466 17.9347 8.35466 17.9347L8.03995 19.8259H10.1008C10.4844 19.8259 10.8613 19.8326 11.2315 19.8355V22.4666H12.8132V19.8629C13.2472 19.8718 13.6678 19.8755 14.078 19.8755V22.4673H15.659V19.8407C18.3248 19.6882 20.185 19.0173 20.416 16.5173C20.6026 14.5039 19.6555 13.6057 18.1449 13.2428C19.1512 12.7659 19.7088 11.67 19.503 10.5755Z" fill="white"/>
						</svg>
					</div>
					<span>Pay with Crypto</span>
				</div>
				<div class="pm" data-target="p4">
					<div class="wrap gaa-p">
						<img class="" src="/assets/icons/p-cions/a-pay.png" alt="a-pay">
						<img class="problem" src="/assets/icons/p-cions/g-pay_old.png" alt="g-pay">
						<img class="" src="/assets/icons/p-cions/z-pay.png" alt="z-pay">
					</div>
					<span>Other payment methods</span>
				</div>
			</div>

			<div class="pay-tabs">				

				<form class="p1 active gform form-<?= G::$slug ?>" method="POST" action="/<?= G::$slug ?>" id="form-card">
					<input type="hidden" name="action" value="<?= G::$slug ?>-card">
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'] ?? ''; ?>">
					<input type="hidden" name="user_email" value="<?php echo $_SESSION['user']['user_email'] ?? ''; ?>">
					<input type="hidden" name="prod" value="50">

					<div class="field">
						<label for="name">Card Holder Name</label>
						<input type="text" name="name" id="name" placeholder="Enter your name" value="<?= $_POST['name'] ?? '' ?>" required="" autocomplete="name">						
					</div>
					<div class="field">
						<label for="card">Card Number</label>
						<!-- <input name="card" id="card" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx" value="<?= $_POST['card'] ?? '' ?>"> -->
						<div id="card-number"></div>
					</div>
					<div class="grow">
						<div class="field">
							<label for="expiry">Data</label>
							<!-- <input name="expiry" id="expiry" type="text" required placeholder="xx/xx" value="<?= $_POST['expiry'] ?? '' ?>"/> -->
							<div id="card-expiry"></div>
						</div>
						<div class="field">
							<label for="cvv">CVV</label>
							<!-- <input type="tel" name="cvv" id="cvv" placeholder="xxx" value="<?= $_POST['cvv'] ?? '' ?>"> -->
							<div id="card-cvv"></div>
						</div>
					</div>
					<p>*You are agreeing to no refunds in any case once the payment is completed</p>
					<div class="error"><span class="message"></span></div>
				</form>	


				<form class="p2 gform form-<?= G::$slug ?>" method="POST" action="/payments/paypal/create-order.php" id="form-paypal">
					<input type="hidden" name="action" value="<?= G::$slug ?>-paypal">
					<input type="hidden" name="cmd" value="_xclick" />
                    <input type="hidden" name="no_note" value="1" />
                    <input type="hidden" name="lc" value="USA" />
                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                    <input type="hidden" name="first_name" value="Kiran" />
                    <input type="hidden" name="last_name" value="Nasim" />                
					<input type="hidden" name="prod" value="50">

					<div class="field">
						<label for="name">Please enter your PayPal email</label>
						<input type="text" name="payer_email" id="payer_email" placeholder="Enter your Paypal email" value="<?= $_POST['name'] ?? '' ?>">
					</div>
					<p>*You are agreeing to no refunds in any case once the payment is completed</p>
				</form>	


				<form class="p3 gform form-<?= G::$slug ?>" method="POST" action="/<?= G::$slug ?>">
					<input type="hidden" name="action" value="<?= G::$slug ?>-crypto">
					<input type="hidden" name="prod" value="">

					<div class="grow">
						<div class="cryptos">
							<ul>
								<li>
									<span>
										<img src="/assets/icons/cryptos/bitcoin.svg" alt="bitcoin">
										<i>Bitcoin</i>
									</span>
									<b>$50 = 0,00013 BTC</b>
								</li>
								<li class="active">
									<span>
										<img src="/assets/icons/cryptos/litecoin.svg" alt="litecoin">
										<i>Litecoin</i>
									</span>
									<b>$50 = 0,71 LTC</b>
								</li>
								<li>
									<span>
										<img src="/assets/icons/cryptos/bitcoin.svg" alt="litecoin">
										<i>USDT</i>
									</span>
									<b></b>
								</li>
								<li>
									<span>
										<img src="/assets/icons/cryptos/litecoin.svg" alt="litecoin">
										<i>XRP</i>
									</span>
									<b></b>
								</li>
								<li>
									<span>
										<img src="/assets/icons/cryptos/bitcoin.svg" alt="litecoin">
										<i>Dogecoin</i>
									</span>
									<b></b>
								</li>
								<li>
									<span>
										<img src="/assets/icons/cryptos/litecoin.svg" alt="litecoin">
										<i>Monero</i>
									</span>
									<b></b>
								</li>
								<li>
									<span>
										<img src="/assets/icons/cryptos/bitcoin.svg" alt="litecoin">
										<i>BUSD</i>
									</span>
									<b></b>
								</li>
							</ul>
						</div>
						<div class="wallet">
							<div class="field">
								<label for="wallet">Copy wallet address</label>
								<input type="text" name="wallet" id="wallet" placeholder="35bSzXvRKLpHsHMrzb82f617cV4Srnt7hS" value="<?= $_POST['wallet'] ?? '' ?>">
							</div>
							<div class="field">
								<input type="text" name="exchange" id="exchange" disabled value="$50 = 0,71 LTC" value="<?= $_POST['exchange'] ?? '' ?>">
							</div>
							<div class="qr-code">
								<img src="/assets/icons/qrcode.svg" alt="qrcode">
							</div>
						</div>
					</div>

				</form>	
				<form class="p4 gform form-<?= G::$slug ?>" method="POST" action="/<?= G::$slug ?>">
					<input type="hidden" name="action" value="<?= G::$slug ?>-gpay">
					<input type="hidden" name="prod" value="">

					
					<label for="apply-pay">
						<input type="radio" name="agz-pay" id="apply-pay" value="a-pay" <?= !empty($_POST['agz-pay']) && $_POST['agz-pay'] == 'a-pay' ? 'checked' : '' ?>>
						<div class="wrap">
							<div>Apple Pay</div>
							<p>Unlimited users and unlimited individual data.</p>
						</div>
						<img src="/assets/icons/p-cions/a-pay2.png" alt="a-pay">
					</label>
					<label for="google-pay">
						<input type="radio" name="agz-pay" id="google-pay" value="g-pay" <?= !empty($_POST['agz-pay']) && $_POST['agz-pay'] == 'g-pay' ? 'checked' : '' ?>>
						<div class="wrap">
							<div>Google Pay</div>
							<p>You will be redirected to the Google pay website after submitting your order</p>
						</div>
						<img src="/assets/icons/p-cions/g-pay2.png" alt="g-pay">
					</label>
					<label for="amazone-pay">
						<input type="radio" name="agz-pay" id="amazone-pay" value="z-pay" <?= !empty($_POST['agz-pay']) && $_POST['agz-pay'] == 'z-pay' ? 'checked' : '' ?>>
						<div class="wrap">
							<div>Amazon Pay</div>
							<p>You will be redirected to the Amazonwebsite after submitting your order</p>
						</div>
						<img src="/assets/icons/p-cions/z-pay2.png" alt="z-pay">
					</label>
				</form>	

			</div>

			<div class="footer">
				<div class="btn buy">Buy</div>
			</div>

		</div>

		<div class="right">
			<div class="slider">
				<div class="arrows ar-left">
					<?= G::icon('larrow'); ?>
				</div>
				<div class="prod-cards">
					<?php foreach([
						['name' => '50$ Balance', 'class' => 'active', 'icon' => 'gold-rubin', 'price' => '50', 'desc' => 'Add credit do Your balance, Balance can be used to solve captchas or purchase licenses for Bots in Our "Bots Gallery"'],
						['name' => '5$ Balance', 'icon' => 'rubin', 'price' => '5', 'desc' => 'Add credit do Your balance, Balance can be used to solve captchas or purchase licenses for Bots in Our "Bots Gallery"'],
						['name' => '20$ Balance', 'icon' => 'rubin2', 'price' => '20', 'desc' => 'Add credit do Your balance, Balance can be used to solve captchas or purchase licenses for Bots in Our "Bots Gallery"'],
					] as $prod) { ?>
						<div class="slide prod animate__animated <?= $prod['class'] ?? '' ?>" data-price="<?= $prod['price'] ?>">
							<h5>Credit</h5>
							<div class="wrap">
								<!-- some one please kill designer -->
								<?= G::icon($prod['icon']); ?>
							</div>
							<div class="price">$<?= $prod['price'] ?><i>/Credit</i></div>
							<p>Buying this option will add <?= $prod['price'] ?>$ to Your balance</p>
						</div>
					<?php } ?>
				</div>
				<div class="arrows ar-right">
				<?= G::icon('rarrow'); ?>
				<div>
			</div>
		</div>


	</div>
</main>