<?php 
	$settings = [
		"pages" => [
			"admin"  => [
				"navbar" => false
			],
		],
		//folder name / php file name => list of slug which should use this php file like a template
		"templates" => [
			"account/auth" => ["login", "registration", "reset-password", "new-password"],
			"account/dashboard" => ["account"],
			"admin/dashboard" => ["admin"],
		],
		"alias" => [
			"registration" => ["register", "sign-up", "signup"],
			"login" => ["sign-in", "enter", "signin"],
			"account" => ["dasboard", "profile"],
		],
		"website" => [
			"og:image" => "http://$_SERVER[HTTP_HOST]/assets/img/og_image.jpg",
			"site_name" => "GhostCaptcha",
			"title" => "GhostCaptcha. You don't need anything else",
			"description" => "Arkeos FunCaptcha, ReCaptcha Enterprise, SMS - Verification. GhostCaptcha Solves Captchas And More",
		]
	];
?>