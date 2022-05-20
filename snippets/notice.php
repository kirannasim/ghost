
<?php 
	if(!empty(gForm::$response)) {

	$titles = [
		'error' => 'Oh snap!',
		'warn' => 'Warning!',
		'well' => 'Well done!',
	];
	$icon = [
		'error' => '<svg class="close" width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M47.8056 67.6794C48.1345 67.4706 48.4934 67.3124 48.8666 67.2006C63.0119 62.9621 73.3201 49.8448 73.3201 34.32C73.3201 15.3656 57.9545 0 39.0001 0C20.0456 0 4.68005 15.3656 4.68005 34.32C4.68005 47.8227 12.4779 59.5042 23.8159 65.1068C23.8287 65.1132 23.8235 65.1326 23.8092 65.1315C23.8001 65.1308 23.7931 65.1396 23.7958 65.1483L26.9038 74.9903C27.6948 77.4949 30.6439 78.5705 32.8615 77.1631L47.8056 67.6794Z" fill="#C81912"/>
						<path d="M48.8134 27.6381C49.6418 26.8097 49.6418 25.4666 48.8134 24.6382L48.362 24.1867C47.5336 23.3583 46.1904 23.3583 45.362 24.1867L39 30.5488L32.6379 24.1867C31.8095 23.3583 30.4664 23.3583 29.638 24.1867L29.1865 24.6382C28.3581 25.4666 28.3581 26.8097 29.1865 27.6381L35.5486 34.0002L29.1865 40.3623C28.3581 41.1907 28.3581 42.5338 29.1865 43.3622L29.638 43.8137C30.4664 44.6421 31.8095 44.6421 32.6379 43.8137L39 37.4516L45.362 43.8137C46.1904 44.6421 47.5336 44.6421 48.362 43.8137L48.8134 43.3622C49.6419 42.5338 49.6418 41.1907 48.8134 40.3623L42.4514 34.0002L48.8134 27.6381Z" fill="white"/>
					</svg>',
		'warn' => '<svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M38.9999 68.64C57.9543 68.64 73.3199 53.2744 73.3199 34.32C73.3199 15.3656 57.9543 0 38.9999 0C20.0455 0 4.67993 15.3656 4.67993 34.32C4.67993 43.2429 8.08512 51.3705 13.6669 57.4741C14.3862 58.2607 14.8199 59.2749 14.8199 60.3408V73.1872C14.8199 76.1365 17.9029 78.0717 20.5589 76.7894L37.4152 68.6519C37.425 68.6472 37.4248 68.6332 37.4149 68.6288V68.6288C37.402 68.623 37.4066 68.6037 37.4207 68.6043C37.9442 68.628 38.4706 68.64 38.9999 68.64Z" fill="#CC561E"/>
					<path fill-rule="evenodd" clip-rule="evenodd" d="M35.8696 36.5652C35.8696 38.222 37.2128 39.5652 38.8696 39.5652H39.1305C40.7874 39.5652 42.1305 38.222 42.1305 36.5652L42.1305 23.0869C42.1305 21.4301 40.7874 20.0869 39.1305 20.0869H38.8696C37.2128 20.0869 35.8696 21.4301 35.8696 23.0869V36.5652ZM39.0001 47.913C40.729 47.913 42.1305 46.5115 42.1305 44.7826C42.1305 43.0537 40.729 41.6521 39.0001 41.6521C37.2712 41.6521 35.8696 43.0537 35.8696 44.7826C35.8696 46.5115 37.2712 47.913 39.0001 47.913Z" fill="white"/>
				</svg>',
		'well' => '<svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M39.0001 68.64C57.9545 68.64 73.3201 53.2744 73.3201 34.32C73.3201 15.3656 57.9545 0 39.0001 0C20.0456 0 4.68005 15.3656 4.68005 34.32C4.68005 44.9926 9.55162 54.5274 17.1924 60.822C17.2046 60.832 17.1937 60.8515 17.1788 60.8464C17.1696 60.8433 17.1601 60.8501 17.1601 60.8598V74.7521C17.1601 76.2417 18.7302 77.2085 20.0604 76.538L35.4795 68.7654C35.8112 68.5981 36.1829 68.528 36.5534 68.5541C37.3616 68.6111 38.1774 68.64 39.0001 68.64Z" fill="#3D046A"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M50.3011 24.3464C51.3602 25.1585 51.5623 26.6745 50.753 27.7357L38.7426 43.4829C38.3191 44.0382 37.6773 44.3832 36.9816 44.4295C36.286 44.4758 35.6042 44.2189 35.1113 43.7246L27.4883 36.0815C26.5455 35.1363 26.5455 33.6064 27.4883 32.6612C28.4345 31.7124 29.9713 31.7124 30.9176 32.6612L36.5783 38.3368L46.9031 24.7994C47.7154 23.7344 49.2381 23.5314 50.3011 24.3464Z" fill="white"/>
					</svg>',
	];?>

	<div class="notice status-<?= gForm::$response['status'] ?>">
		<h6><?= ($titles[gForm::$response['status']] ?? 'Notice') ?></h6>
		<p><?= gForm::$response['msg'] ?></p>	
		<?= ($icon[gForm::$response['status']] ?? $icon[gForm::$response['warn']]) ?></h6>
	</div>


<?php 
	}
?>