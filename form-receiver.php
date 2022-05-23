<?php 
	include_once __DIR__ . '/config.php';
	include_once __DIR__ . '/db.php';		

	class gForm {
		static $response;

		static function init($data) {
			self::$response = $data;
		}
	}

	function answer_json($data) {
		header('Content-type: text/javascript');
		echo json_encode($data);
		exit;
	}

	function answer($data) {
		header('Content-type: text/javascript');
		echo json_encode($data);
		exit;
	}

	function clean_inp($input) {
		return htmlspecialchars(stripslashes(trim($input)));
	}

	function validate_email($email) {
		if(!preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email)){
			return gForm::init(['status' => 'error', 'msg' => 'Invalid email, please try again', 'has-error' => 'email']);
		}
	}

	/**
	 * Generate API Key
	 */
	function generate_api_key() {
		$block = explode( '.', microtime() ); 
		$block = explode( ' ', $block[1] ); 
		$block = sha1( base_convert( $block[0] . $block[1], 10, 16 ) ); 

		return strtoupper( substr( $block, 0, 15 ) . '-' . substr( $block, 15, 2 ) . '-' . substr( $block, 17, 4 ) );
	}

	/**
	 * Send email to reset password
	 * 
	 * $email: Sender email
	 */
	function sendmail_reset_pwd( $email, $token ) {		
		$link = Config::DOMAIN_URL . '/new-password?t=' . $token;

		$subject = 'Password restoration';
		$message = "Hello, click on this <a href=\"$link\">link</a> to reset password.";
		$message = wordwrap( $message, 70 );

		return $message;

		$sender = 'admin@ghost.com';
		$senderName = 'Admin';

		require_once __DIR__ . '/lib/Mail.php';

		$mail = new Mail();
		$result = $mail->sendMail( $subject, $message, $sender, $senderName, $email );

		return gForm::init( ['status' => $result['status'], 'msg' => $result['message']] );
	}

	/**
	 * Send email to verify email
	 * 
	 * $email: Sender email
	 */
	function sendmail_verify_email( $email, $token ) {
		$link = Config::DOMAIN_URL . '/email-verification?t=' . $token;

		$subject = 'Email verification';
		$message = "Successfully signed up. Please verify your email. click on this <a href=\"$link\">link</a> to verify your email.";
		$message = wordwrap( $message, 70 );
		
		return $message;


		$sender = 'admin@ghost.com';
		$senderName = 'Admin';

		require_once __DIR__ . '/lib/Mail.php';

		$mail = new Mail();
		$result = $mail->sendMail( $subject, $message, $sender, $senderName, $email );

		return gForm::init( ['status' => $result['status'], 'msg' => $result['message']] );
	}

	/**
	 * Login
	 * 
	 * $email: Login email
	 * $password: Login password
	 * $remember
	 */
	function login( $conn, $email, $password, $remember ) {
		if ( $email == '' ) {
			return gForm::init( ['status' => 'error', 'msg' => 'Email address is required.'] );
		}

		validate_email( $email );

		if ( $password == '' ) {
			return gForm::init( ['status' => 'error', 'msg' => 'Password is required.'] );
		}

		$email = clean_inp( $email );
		$password = clean_inp( $password );	

		$password_hash = md5( $password );
		$sql = "SELECT * FROM tbl_users WHERE user_email = '$email' AND user_password = '$password_hash'";   
		$result = mysqli_query( $conn, $sql );

		if ( $result ) {
			$user = mysqli_fetch_array( $result );
		
			if ( $user ) {
				if ( ! empty( $remember ) ) {
					setcookie( 'email', $email, time() + ( Config::COOKIE_EXPIRE_DAYS * 24 * 60 * 60 ) );
					setcookie( 'password', $password, time() + ( Config::COOKIE_EXPIRE_DAYS * 24 * 60 * 60 ) );
				} else {
					if ( isset( $_COOKIE['email'] ) ) {
						setcookie( 'email', '' );
					}

					if ( isset( $_COOKIE['password'] ) ) {
						setcookie( 'password', '' );
					}
				}

				if ( $user['verified'] == '0' ) {
					return gForm::init( ['status' => 'error', 'msg' => 'Please verify you email first.'] );
				}
				
				$_SESSION['user']['user_id'] = $user['user_id'];
				$_SESSION['user']['user_email'] = $user['user_email'];
				$_SESSION['user']['user_role'] = $user['user_role'];

				G::$user = $_SESSION["user"];

				if ( $user['user_role'] == '1' )
					header('Location: /admin');
				else
					header('Location: /account');

				return;
			} else {
				return gForm::init( ['status' => 'error', 'msg' => 'Email address or password is not correct.'] );
			}
		} else {
			return gForm::init( ['status' => 'error', 'msg' => 'Email address or password is not correct.'] );
		}    
	}

	/**
	 * Signup
	 * 
	 * $email: Register email
	 * $password: Password
	 * $password2: Confirm Password
	 * $remember
	 */
	function signup( $conn, $email, $password, $password2, $remember ) {
		// $email = clean_inp( $email );
		// $password = clean_inp( $password );	

		if ( $email == '' ) {
			return gForm::init( ['status' => 'error', 'msg' => 'Email address is required.'] );
		}

		validate_email( $email );

		if ( $password == '' ) {
			return gForm::init( ['status' => 'error', 'msg' => 'Password is required.'] );
		}

		if ( $password !== $password2 ) {
			return gForm::init( ['status' => 'error', 'msg' => 'Password is not matched.'] );
		}

		$sql = "SELECT * FROM tbl_users WHERE user_email = '$email'";
		$result = mysqli_query( $conn, $sql );
		$user = mysqli_fetch_array( $result );

		if ( $user ) {
			return gForm::init( ['status' => 'error', 'msg' => 'Email address already exists.'] );
		} else {
			$token = bin2hex( random_bytes( 50 ) );
			$password_hash = md5( $password );
			$api_key = generate_api_key();
			$sql = "INSERT INTO tbl_users (user_email, user_password, user_api_key, token) VALUES ('$email', '$password_hash', '$api_key', '$token')";

			if ( mysqli_query( $conn, $sql ) === true ) {
				
				if ( ! empty( $remember ) ) {
					setcookie( 'email', $email, time() + ( Config::COOKIE_EXPIRE_DAYS * 24 * 60 * 60 ) );
					setcookie( 'password', $password, time() + ( Config::COOKIE_EXPIRE_DAYS * 24 * 60 * 60 ) );
				} else {
					if ( isset( $_COOKIE['email'] ) ) {
						setcookie( 'email', '' );
					}

					if ( isset( $_COOKIE['password'] ) ) {
						setcookie( 'password', '' );
					}
				}

				// sendmail_verify_email( $email, $token );

				return gForm::init( ['status' => 'warn', 'msg' => 'Successfully signed up. Please verify your email ' . sendmail_verify_email( $email, $token )] );

				// header( "Location: /login" );
				// return gForm::init( ['status' => 'success', 'msg' => 'Successfully signed up. Please verify your email'] );
			} else {
				return gForm::init( ['status' => 'error', 'msg' => 'Sign up failed. Please try again later.'] );
			}
		}
	}

	/**
	 * Forgot Password
	 * 
	 * $email: sender email 
	 */
	function forgot_password( $conn, $email ) {
		if ( $email == '' ) {
			return gForm::init( ['status' => 'error', 'msg' => 'Email address is required.'] );
		}

		validate_email( $email );

		$email = clean_inp( $email );

		$sql = "SELECT * FROM tbl_users WHERE user_email = '$email'";
		$result = mysqli_query( $conn, $sql );
		$user = mysqli_fetch_array( $result );

		if ( $user ) {
			$token = bin2hex( random_bytes( 50 ) );
			$email = $user['user_email'];			
			$sql = "INSERT INTO tbl_password_resets(email, token) VALUES ('$email', '$token')";
			mysqli_query( $conn, $sql );

			return gForm::init( ['status' => 'warn', 'msg' => 'Please check your email inbox.' . sendmail_reset_pwd( $email, $token )] );

			// sendmail_reset_pwd( $email, $token );

			// return gForm::init( ['status' => 'success', 'msg' => 'Please check your email inbox.'] );

			// header( "Location: /login" );
		} else {
			return gForm::init( ['status' => 'error', 'msg' => 'E-mail address is not correct.'] );
		}
	}

	/**
	 * Email verification
	 * 
	 * $token: token
	 */
	function email_verification( $db, $token ) {		
		$query = "SELECT * FROM tbl_users WHERE token = ?";
		$paramValue = array(
			$token
		);
		$paramType = "s";
		$result = $db->select( $query, $paramType, $paramValue );

		if ( $result ) {
			$query = "UPDATE tbl_users SET verified = 1 WHERE token = ?";
			$paramValue = array(
				$token
			);
			$paramType = "s";
			$db->execute( $query, $paramType, $paramValue );			
		}
	}

	/** 
	 * Reset Password
	 * 
	 * $password: New password
	 */
	function new_password( $conn, $password ) {
		if ( $password == '' ) {
			return gForm::init( ['status' => 'error', 'msg' => 'Password is required.'] );
		}
		
		$token = $_POST['token'];
		$sql = "SELECT email FROM tbl_password_resets WHERE token='$token' AND TIME_TO_SEC(TIMEDIFF(created_at, NOW())) < 3600";
		$result = mysqli_query( $conn, $sql );
		$record = mysqli_fetch_array( $result );
		
		if ( ! $record ) {
			header( "Location: /reset-password" );
			return gForm::init( ['status' => 'error', 'msg' => 'Reset password expired. Please try again.'] );
		}
		
		$email = $record['email'];	
		$password = clean_inp( $password );

		$password_hash = md5( $password );
		$sql = "UPDATE tbl_users SET user_password = '$password_hash' WHERE user_email = '$email'";
		
		if ( mysqli_query( $conn, $sql ) ) {
			$sql = "DELETE FROM tbl_password_resets WHERE email = '$email'";
			mysqli_query( $conn, $sql );
		
			header( "Location: /login" );
			return gForm::init( ['status' => 'success', 'msg' => 'Successfully reset password.'] );
		} else {
			return gForm::init( ['status' => 'error', 'msg' => 'Something is wrong. Please try again.'] );
		}
	}
	
	if (G::$template == 'logout') {
		session_destroy();
		header('Location: /login');
	}	

	$db = new Database();
	$conn = $db->getConnect();
	
	//tempo solution
	function test_start_session($e) {
		session_start();
		$_SESSION["user"] = [
			'user_credit' => 0,
			'user_email' => $e,
			'user_api_key' => 0,
			'user_threads_limit' => 0,
		];
		header('Location: /account');
	}
	
	if ( isset( $_POST['action'] ) ) {
		$action = $_POST['action'];
	
		if ( 'login' === $action ) {			
			if ( isset( $_POST['email'] ) && isset( $_POST['password'] ) ) {
				// test_start_session($_POST['email']);
				login( $conn, $_POST['email'], $_POST['password'], 1 );
			}
		} 
		
		if ( 'registration' === $action ) {
			if ( isset ( $_POST['email'] ) && isset( $_POST['password'] ) && isset( $_POST['password2'] ) ) {
				signup( $conn, $_POST['email'], $_POST['password'], $_POST['password2'], 1 );
			}			
		} 
		
		if ( 'new-password' === $action ) {
			if ( isset( $_POST['password'] ) ) {
				new_password( $conn, $_POST['password'] );
			}
		} 
		
		if ( 'reset-password' === $action ) {	
			if ( isset( $_POST['email'] ) ) {
				forgot_password( $conn, $_POST['email'] );
			}
		} 		
		
		if ( 'logout' === $action ) {
			session_destroy();
		}
		
		if($_POST['action'] == 'checkout-card') {
			if(empty($_POST['name'])) return gForm::init(['status' => 'error', 'msg' => 'Invalid data etered, please try again', 'has-error' => ['name']]);
			if(empty($_POST['card'])) return gForm::init(['status' => 'error', 'msg' => 'Invalid data etered, please try again', 'has-error' => ['card']]);
			if(empty($_POST['expiry'])) return gForm::init(['status' => 'error', 'msg' => 'Invalid data etered, please try again', 'has-error' => ['expiry']]);
			if(empty($_POST['cvv'])) return gForm::init(['status' => 'error', 'msg' => 'Invalid data etered, please try again', 'has-error' => ['cvv']]);


			return gForm::init(['status' => 'well', 'msg' => 'Your payment was completed successfully']);
		}

	}
	
?>