<?php 
	class G {
		static $settings;
		static $notice;
		static $icons;
		static $templates;
		static $template;
		static $dir;
		static $path;
		static $slug;
		static $user = [];
		static $alias = [];
		static $website = [];
		static $canonical = '';
		static $body_class = [];
	
		static function init() {
			session_start();
			self::$user = $_SESSION["user"] ?? '';

			$pathinfo = pathinfo($_SERVER['REQUEST_URI']);
			if(!empty($pathinfo['extension'])) {
				header("HTTP/1.0 404 Not Found");
				die('hm');
			}

			self::$notice = self::get_notice();

			self::$path = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
			self::$dir = isset(self::$path[2]) ? self::$path[1] : '';

			self::$slug = self::$path[count(self::$path) - 1] ?: 'home';
 
			require_once('snippets/icons.php');
			self::$icons = $icons;

			require_once('settings.php');
			if(empty($settings['templates'])) die('settings file is corapted');

			$alis = self::map_val_to_key($settings['alias']);
			if(!empty($alis[self::$slug])) {
				self::$canonical = self::$slug = $alis[self::$slug];
			}
			self::$settings = ['footer' => false, 'navbar' => true];
			self::$settings = array_merge(self::$settings, ($settings['pages'][self::$slug] ?? []));
			
			self::$templates = self::map_val_to_key($settings['templates']);

			self::$website = $settings['website'];
			return new self();
		}

		static function icon($n, $w = '', $h = '') {			
			return self::$icons[$n] ? '<svg '.($w ? ' width="'.$w.'"' : '').($h ? ' height="'.$h.'"' : '').' class="icon-'.$n.'" '.self::$icons[$n] : '';
		}

		static function map_val_to_key($arr) {
			$r = [];
			foreach($arr as $tmp => $arr2) {
				foreach($arr2 as $slug) {
					$r[$slug] = $tmp;
				}
			}
			return $r;
		}

		static function set_notice($d) {
			setcookie("gnotice", json_encode($d), strtotime( '+1 hours' ), '/');
		}

		static function get_notice() {
			$r = [];
			if(isset($_COOKIE['gnotice'])) {
				$r = json_decode(stripslashes($_COOKIE['gnotice']), 1);
				setcookie("gnotice", "");
			}
			return $r;
		}

		static function if_redirect() {

			if(
				empty(self::$user) && (
				self::$template == 'dashboard' || 
				self::$slug == 'new-password')
			) {
				self::set_notice(['status' => 'warn', 'msg' => 'You need to be logged in to view this page.']);
				header('Location: /login');
			}

			if(
				empty(self::$user) && (
				self::$slug == 'checkout')
			) {
				self::set_notice(['status' => 'warn', 'msg' => 'You need to be logged in to make a purchase']);
				header('Location: /login');
			}

			if(
				!empty(self::$user) && 
				self::$template == 'auth' && 
				(self::$slug == 'login' || self::$slug == 'registration')
			) header('Location: /account');

		}

		static function route($slug) {
			$tmp_path = explode('/', (self::$templates[$slug] ?? $slug));
			self::$template = self::$templates[$slug] ?? $slug;
			if(!empty($tmp_path[1])) {
				self::$dir = $tmp_path[1] ? $tmp_path[0] : '';
				self::$template = $slug = $tmp_path[1];
			}
			self::$template = self::$template ?? 'home';
			$dir = $slug != '404' && self::$dir ? self::$dir.'/' : '';
			if(self::$user) self::$body_class[] = 'login-in';
			return 'pages/'.$dir.$slug.'.php';
		}

		static function if_slug($arr, $def = '') {
			if(isset($arr[self::$slug])) return $arr[self::$slug];

			foreach($arr as $slugs => $v) {
				$slugs = explode(' ', $slugs);
				foreach($slugs as $slug) {
					if ($slug == self::$slug) return $v;
				}
			}
			return $def;
		}

		static function render() {
			if(!file_exists(self::route(self::$slug))) {
				header("HTTP/1.0 404 Not Found");
				self::$slug = 404;
			}
			self::$body_class = ['page-'.self::$slug, 'tmp-'.self::$template];
			
			self::if_redirect();
			require_once('form-receiver.php');
			require_once('header.php');
			require_once(self::route(self::$slug));
			require_once('footer.php');
		}
	}
	G::init()::render();
	
	
?>