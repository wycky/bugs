<?php
class Mail {
	/**
	 * Send the requested message
	 *
	 * @param   string  $message
	 * @param   string  $to
	 * @param   string  $subject
	 * @return  int
	 */
	public static function send_email($message, $to, $subject) {
		require_once  path('app') .  'libraries/PHPmailer/class.phpmailer.php';
		$options = Config::get('application.mail');

		$mail = new PHPMailer();
		$mail->Mailer = $options['transport'];
		switch ($options['transport']) {
			case 'smtp':												//If you correct the smtp part, please correct ALSO the default part
				require_once  path('app') .  'libraries/PHPmailer/class.smtp.php';
				$mail->SMTPDebug = 0;								// 0 = no output, 1 = errors and messages, 2 = messages only.
				if ($options['smtp']['encryption'] == '') {
				} else {
					$mail->SMTPAuth = true;							// enable SMTP authentication
					$mail->SMTPSecure = $options['smtp']['encryption'];	// sets the prefix to the server
					$mail->Host = $options['smtp']['server'];
					$mail->Port = $options['smtp']['port'];
					$mail->Username = $options['smtp']['username'];
					$mail->Password = $options['smtp']['password'];
				}
				break;
			case 'mail':
				//Please submit your code
				//On March 14th, 2017 I had no time to go further on this
				break;
			case 'sendmail':
				//Please submit your code
				//On March 14th, 2017 I had no time to go further on this
				break;
			default:															//If you correct the default part, please correct ALSO the smtp part
				require_once path('app') .  'libraries/PHPmailer/class.smtp.php';
				$mail->SMTPDebug = 1;									// 0 = no output, 1 = errors and messages, 2 = messages only.
				if ($options['smtp']['encryption'] == '') {
				} else {
					$mail->SMTPAuth = true;								// enable SMTP authentication
					$mail->SMTPSecure = $options['smtp']['encryption'];	// sets the prefix to the server
					$mail->Host = $options['smtp']['server'];
					$mail->Port = $options['smtp']['port'];
					$mail->Username = $options['smtp']['username'];
					$mail->Password = $options['smtp']['password'];
				}
				break;
		}

		$mail->CharSet = (isset($options['encoding'])) ? $options['encoding'] : 'windows-1250';
		$mail->SetFrom ($options['from']['email'], $options['from']['name']);
		$mail->Subject = $subject;
		$mail->ContentType = 'text/plain';
		$mail->IsHTML(false);

		$mail->Body = $message;
		$mail->AddAddress ($to);

		$result = $mail->Send() ? "Successfully sent!" : "Mailer Error: " . $mail->ErrorInfo;
		return $result;
	}
}
