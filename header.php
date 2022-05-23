<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= G::$website['title'] ?></title>
	<meta name="description" content="<?= G::$website['description'] ?>"/>
	<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

	<link rel="icon" type="image/svg+xml" href="/assets/favicon/favicon.svg">
	<link rel="icon" type="image/png" href="/assets/favicon/favicon.png">

	<meta property="og:locale" content="en_US">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?= G::$website['title'] ?>">
	<meta property="og:description" content="<?= G::$website['description'] ?>">
	<meta property="og:site_name" content="<?= G::$website['site_name'] ?>">
	<meta property="og:image" content="<?= G::$website['og:image'] ?>">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?= G::$website['title'] ?>">
	<meta name="twitter:description" content="<?= G::$website['description'] ?>">
	<meta name="twitter:image" content="<?= G::$website['og:image'] ?>">
	<meta name="twitter:site" content="@<?= G::$website['site_name'] ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />


	<?php if(G::$canonical) echo '<link rel="canonical" href="https://example.com/'.G::$canonical.'" />'; ?>	

	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Corporation",
		"name": "GhostCaptcha",
		"url": "https://ghostcaptcha.net",
		"logo": "https://transfer.sh/LdOU7x/GhostCaptcha.png",
		"sameAs": "https://ghostcaptcha.net"
	}
	</script>

	<link rel="stylesheet" type="text/css" href="/assets/min/critical.min.css">	
	<link rel="stylesheet" type="text/css" href="/assets/min/defer.min.css" media="print" onload="this.onload=null;this.media='all'">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" media="print" onload="this.onload=null;this.media='all'">


	<link rel="preload" href="/assets/fonts/Gilroy-Medium.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/assets/fonts/Gilroy-Regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/assets/fonts/MonumentExtended-Regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/assets/fonts/MonumentExtended-Ultrabold.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/assets/fonts/Poppins-Light.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/assets/fonts/DMSans-Regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/assets/fonts/DMSans-Medium.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/assets/fonts/DMSans-Bold.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/assets/fonts/OpenSans-ExtraBold.woff2" as="font" type="font/woff2" crossorigin>

	<script src="https://js.stripe.com/v3/"></script>
	
	<script defer
		src="https://code.jquery.com/jquery-3.6.0.min.js"
		integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
		crossorigin="anonymous"></script>
	<script defer src="/assets/main.js"></script>	
	<script defer src="/payments/stripe/stripe-elements.js"></script>
	
</head>
<body class="<?= implode(' ', G::$body_class) ?>">

	<?php if(G::$settings['navbar']) require_once('snippets/navbar.php');?>
