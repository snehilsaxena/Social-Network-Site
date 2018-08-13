<?php 
	session_start();
	if( isset($_SESSION['member_id']) ){ header("Location: index.php"); }
	include('header.php'); 

	include("includes/config.php");
	$errors='';
	$success='';

	if( isset($_POST['registerBtn']) ){
		

		$name = $_REQUEST['name'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];

		if( empty($name) or empty($email) or empty($password) ){
			$errors .= 'Please fill out all fields';
		}else{

			$select = mysqli_query($connection, "SELECT * FROM members WHERE email='$email'");
			if( mysqli_num_rows($select)>=1 ){
				$errors .= 'Sorry This email already exists. Please signup with another email.';
			}else{

				$token = md5($name);

				$query = "INSERT INTO members SET 
							id='',
							name='$name',
							email='$email',
							password='$password',
							token='$token',
							date_added=NOW()
							";

				/*$to = $email;
				$subject = "Verification Email";
				$message = "Please click on the below link in order to activate your account";
				$message .= "<a href='http://localhost/social/activate.php?token=".$token."'>Click here</a>";

				$headers = "From: test@gmail.com\n";
				$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";

				mail($to, $subject, $message, $headers);*/

				if( mysqli_query($connection, $query) ){

					$user_id = mysqli_insert_id($connection);

					$settings = "INSERT INTO settings SET 
						id='',
						user_id='$user_id',
						postwall='1',
						seeposts='1',
						seeprofile='1',
						sendmessage='1',
						date_added=NOW()
					";

					mysqli_query($connection, $settings);

					$success = 'You have successfully registered in the system';
				}

				$name='';
				$email='';
				$password='';
			}

			

		}

	}

?>

	<fieldset class="regFieldset"><legend>SignUp from here</legend>
	<?php echo $errors; ?>
	<?php echo $success; ?>
		<form method="POST" action="" id="" autocomplete="0">

			<table width="100%" cellpadding="0" cellpadding="0">
				<tr>
					<td width="30%">Name</td>
					<td width="70%">
						<input type="text" name="name" class="fields" value="<?=(( isset($name) )?$name:'')?>" />
					</td>
				</tr>
				<tr>
					<td width="30%">Email</td>
					<td width="70%">
						<input type="text" name="email" class="fields" value="<?=(( isset($email) )?$email:'')?>" />
					</td>
				</tr>
				<tr>
					<td width="30%">Password</td>
					<td width="70%">
						<input type="password" name="password" class="fields" value="<?=(( isset($password) )?$password:'')?>" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="SignUp" class="Btn" name="registerBtn" />
					</td>
				</tr>
			</table>


		</form>

	</fieldset>

<?php include('footer.php'); ?>