<?php 
	require 'vendor/phpmailer/phpmailer/src/Exception.php';
	require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require 'vendor/phpmailer/phpmailer/src/SMTP.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

	include_once 'db.php';	

	class gForm {
		static $msg;
		static $status;
		
		static function init($data) {
			self::$msg = $data['msg'];
			self::$status = $data['status'];						
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

	function clean_inp( $input ) {
		return htmlspecialchars( stripslashes( trim( $input ) ) );
	}

	function validate_email( $email ) {
		if ( ! preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email ) ) {
			return gForm::init(['status' => 'error', 'msg' => 'Invalid email']);
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
	function sendmail_reset_pwd( $email ) {
		$link = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]/reset-password.php?token=$token";
		$message = "Hello, click on this <a href=\"$link\">link</a> to reset password.";
		$message = wordwrap( $message, 70 );

		$mail = new PHPMailer( true );

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_OFF;                         //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'user@example.com';                     //SMTP username
			$mail->Password   = 'secret';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;

			//Recipients
			$mail->setFrom( 'from@example.com', 'Mailer' );
			$mail->addAddress( $email );

			//Content
			$mail->isHTML( true );
			$mail->Subject = 'Password restoration';
			$mail->Body    = $message;

			$mail->send();
			
			return gForm::init( ['status' => 'success', 'msg' => 'Please check your e-mail and click on the link sent to your e-mail.'] );
		} catch (Exception $e) {
			return gForm::init( ['status' => 'error', 'msg' => 'Something is wrong. Please try again.'] );
		}
	}

	/**
	 * Login
	 * 
	 * $email: Login email
	 * $password: Login password
	 * $remember
	 */
	function login( $conn, $email, $password, $remember ) {
		$email = clean_inp( $email );
		$password = clean_inp( $password );	

		$password_hash = md5( $password );
		$sql = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password_hash'";   
		$result = mysqli_query( $conn, $sql );

		if ( $result ) {
			$user = mysqli_fetch_array( $result );
		
			if ( $user ) {
				if ( ! empty( $remember ) ) {
					setcookie( 'email', $email, time() + ( COOKIE_EXPIRE_DAYS * 24 * 60 * 60 ) );
					setcookie( 'password', $password, time() + ( COOKIE_EXPIRE_DAYS * 24 * 60 * 60 ) );
				} else {
					if ( isset( $_COOKIE['email'] ) ) {
						setcookie( 'email', '' );
					}

					if ( isset( $_COOKIE['password'] ) ) {
						setcookie( 'password', '' );
					}
				}
				
				$_SESSION["user"] = $user;
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

		$sql = "SELECT * FROM users WHERE user_email = '$email'";
		$result = mysqli_query( $conn, $sql );
		$user = mysqli_fetch_array( $result );

		if ( $user ) {
			return gForm::init( ['status' => 'error', 'msg' => 'Email address address already exists.'] );
		} else {
			$password_hash = md5( $password );
			$api_key = generate_api_key();
			$sql = "INSERT INTO users (user_email, user_password, user_api_key) VALUES ('$email', '$password_hash', '$api_key')";
			
			if ( mysqli_query( $conn, $sql ) === true ) {
				
				if ( ! empty( $_POST['remember'] ) ) {
					setcookie( 'email', $email, time() + ( COOKIE_EXPIRE_DAYS * 24 * 60 * 60 ) );
					setcookie( 'password', $password, time() + ( COOKIE_EXPIRE_DAYS * 24 * 60 * 60 ) );
				} else {
					if ( isset( $_COOKIE['email'] ) ) {
						setcookie( 'email', '' );
					}

					if ( isset( $_COOKIE['password'] ) ) {
						setcookie( 'password', '' );
					}
				}

				header( "Location: /login" );
				return gForm::init( ['status' => 'success', 'msg' => 'Successfully signed up.'] );
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
		$email = clean_inp( $email );

		$sql = "SELECT * FROM users WHERE user_email = '$email'";
		$result = mysqli_query( $conn, $sql );
		$user = mysqli_fetch_array( $result );

		if ( $user ) {
			$token = bin2hex( random_bytes( 50 ) );
			$email = $user['user_email'];
			$sql = "INSERT INTO password_resets(email, token) VALUES ('$email', '$token')";
			mysqli_query( $conn, $sql );

			sendmail_reset_pwd( $email );

			header( "Location: /login" );
			return;
		} else {
			return gForm::init( ['status' => 'error', 'msg' => 'E-mail address is not correct.'] );
		}
	}

	/** 
	 * Reset Password
	 * 
	 * $password: New password
	 */
	function reset_password( $conn, $password ) {
		if ( ! isset( $_GET['token'] ) ) {
			header( "Location: /" );
			return;
		}
		
		$token = $_GET['token'];
		$sql = "SELECT email FROM password_resets WHERE token='$token' AND TIME_TO_SEC(TIMEDIFF(created_at, NOW())) < 3600";
		$result = mysqli_query( $conn, $sql );
		$record = mysqli_fetch_array( $result );
		
		if ( ! $record ) {
			header( "Location: /reset-password" );
			return gForm::init( ['status' => 'error', 'msg' => 'Reset password expired. Please try again.'] );
		}
		
		$email = $record['email'];	
		$password = clean_inp( $password );

		$password_hash = md5( $password );
		$sql = "UPDATE users SET user_password = '$password_hash' WHERE user_email = '$email'";
		
		if ( mysqli_query( $conn, $sql ) ) {
			$sql = "DELETE FROM password_resets WHERE email = '$email'";
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

	//tempo solution
	function test_start_session() {
		session_start();
		$_SESSION["user"] = [
			'credit' => 100,
			'username' => 'Eugene',
			'threads_limit' => 100,
			'api_key' => 'KNZXC9890ASD890-ZX-9CAS',
		];
		header('Location: /account');
	}

	$db = new Database();
	$conn = $db->connect();
	
	if ( isset( $_POST['action'] ) ) {
		$action = $_POST['action'];
	
		if ( 'login' === $action ) {			
			if ( isset( $_POST['email'] ) && isset( $_POST['password'] ) ) {
				login( $conn, $_POST['email'], $_POST['password'], 1 );
			}
		} 
		
		if ( 'registration' === $action ) {
			if ( isset ($_POST['email'] ) && isset( $_POST['password'] ) && isset( $_POST['password2'] ) ) {
				signup( $conn, $_POST['email'], $_POST['password'], $_POST['password2'], 1 );
			}			
		} 
		
		if ( 'new-password' === $action ) {
			if ( isset( $_POST['password'] ) ) {
				reset_password( $conn, $_POST['password'] );
			}
		} 
		
		if ( 'reset-password' === $action ) {	
			if ( isset( $_POST['email'] ) ) {
				forgot_password( $conn, $_POST['email'] );
			}
		} 
		
		if ( 'email-verification' === $action ) {

		} 
		
		if ( 'logout' === $action ) {
			session_destroy();
		}

	}

	// if (!empty($_POST['action'])) {
	// 	if($_POST['action'] == 'registration') {
	// 		if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2'])) return;
	// 		if($_POST['password'] != $_POST['password2']) return gForm::init(['status' => 'error', 'msg' => 'Password do not match!']);
	// 		validate_email(clean_inp($_POST['email']));
	// 		// check if usr do not exists
	// 		// test_start_session();
	// 	}
	// 	if($_POST['action'] == 'login') {
	// 		if(empty($_POST['email']) || empty($_POST['password'])) return gForm::init(['status' => 'error', 'msg' => 'Empty Fields!']);
	// 		// if email exists and password_verify();
	// 		$email = clean_inp($_POST['email']);
	// 		if($email == 'test@gmail.com') {
	// 			// test_start_session();
	// 		}
	// 		//for test
			
	// 	}
	// 	if($_POST['action'] == 'email-verification') {

	// 	}
	// 	if($_POST['action'] == 'reset-password') {
			
	// 	}
	// 	if($_POST['action'] == 'new-password') {

	// 	}
		
	// }
	
?>