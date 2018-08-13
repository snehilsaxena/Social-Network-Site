<?php 
	session_start();
	if( !isset($_SESSION['member_id']) ){ header("Location: login.php"); }

	include('header.php'); 
	include('includes/config.php'); 
	
	$errors = ''; $success = '';
	$user_id = $_SESSION['member_id'];

	$about = '';
	$gender = '';
	$dob = '';
	$education1 = '';
	$education2 = '';
	$education3 = '';
	$country = '';

	$select = mysqli_query($connection, "SELECT * FROM profile where user_id='$user_id'");

	if( mysqli_num_rows($select)==1 ){

		$result = mysqli_fetch_array($select);

		$about = $result['about'];
		$gender = $result['gender'];
		$dob = $result['dob'];
		$education1 = $result['edu1'];
		$education2 = $result['edu2'];
		$education3 = $result['edu3'];
		$country = $result['country'];

		$ppicture = $result['ppicture'];


		if( !empty($_REQUEST['about']) and !empty($_REQUEST['gender']) and !empty($_REQUEST['dob']) and !empty($_REQUEST['education1']) and !empty($_REQUEST['education2']) and !empty($_REQUEST['education3']) and !empty($_REQUEST['country']) ){

			$filename = $_FILES['ppicture']['name'];
			$tmp_name = $_FILES['ppicture']['tmp_name'];
			$filename = rand(9999,10000).date('Ymdhis').$filename;
			move_uploaded_file($tmp_name, 'uploads/'.$filename);

			$about = $_REQUEST['about'];
			$gender = $_REQUEST['gender'];
			$dob = $_REQUEST['dob'];
			$education1 = $_REQUEST['education1'];
			$education2 = $_REQUEST['education2'];
			$education3 = $_REQUEST['education3'];
			$country = $_REQUEST['country'];
				
			$update = "UPDATE profile SET 
						about='$about',
						gender='$gender',
						dob='$dob',
						ppicture='$filename',
						edu1='$education1',
						edu2='$education2',
						edu3='$education3',
						country='$country'
						where user_id='$user_id'
					";

			mysqli_query($connection, $update);

			$success = "Updated successfully";


		}
		


	}else{

		
		if( isset($_REQUEST['SaveBtn']) ){

			$about = $_REQUEST['about'];
			$gender = $_REQUEST['gender'];
			$dob = $_REQUEST['dob'];
			$education1 = $_REQUEST['education1'];
			$education2 = $_REQUEST['education2'];
			$education3 = $_REQUEST['education3'];
			$country = $_REQUEST['country'];

			

			
			if( !empty($about) and !empty($gender) and !empty($dob) and !empty($education1) and !empty($education2) and !empty($education3) and !empty($country) ){

				$filename = $_FILES['ppicture']['name'];
				$tmp_name = $_FILES['ppicture']['tmp_name'];
				$filename = rand(9999,10000).date('Ymdhis').$filename;
				move_uploaded_file($tmp_name, 'uploads/'.$filename);
				
				$insert = "INSERT INTO profile SET 
							id='',
							user_id='$user_id',
							about='$about',
							gender='$gender',
							dob='$dob',
							ppicture='$filename',
							edu1='$education1',
							edu2='$education2',
							edu3='$education3',
							country='$country',
							date_added=NOW()
						";

				mysqli_query($connection, $insert);

				echo mysqli_error($connection);

				$success = "Saved";


				}else{

					$errors .= "Please fill any one of the field";

				}
			}

	}


	
	

	$options = '';
	$countries = mysqli_query($connection, "SELECT * FROM countries");
	while( $rs = mysqli_fetch_array($countries) ){
		$options .= '<option value="'.$rs['id'].'" '.(( $country == $rs['id'] )?'selected':'').' >'.$rs['country_name'].'</option>';
	}

?>

	

	<fieldset class="customFrmWrap"><legend>Welcome to my website</legend>
		<?php echo $errors; ?>
		<?php echo $success; ?>
		<form action="" method="POST" enctype="multipart/form-data">

		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="2">
					<img src="uploads/<?=$ppicture?>" width="300px" height="240px" />
				</td>
			</tr>

			<tr>
				<td width="30%">Profile Picture</td>
				<td width="70%">
					<input type="file" name="ppicture" class="fields" value="" />
				</td>
			</tr>
			<tr>
				<td width="30%">About</td>
				<td width="70%">
					<textarea name="about" class="fields_textarea"><?=(( isset($about) )?$about:'')?></textarea>
				</td>
			</tr>
			<tr>

				<td width="30%">Gender</td>
				<td width="70%">
					<input type="radio" name="gender" value="m" <?=(( isset($gender) and $gender=='m' )?'checked':'')?> /> Male
					<input type="radio" name="gender" value="f" <?=(( isset($gender) and $gender=='f' )?'checked':'')?> /> Female
				</td>
			</tr>
			<tr>
				<td width="30%">Date of birth</td>
				<td width="70%">
					<input type="date" name="dob" class="fields" value="<?=(( isset($dob) )?$dob:'')?>" />
				</td>
			</tr>
			<tr>
				<td width="30%">Education</td>
				<td width="70%">
					<input type="text" name="education1" class="fields" value="<?=(( isset($education1) )?$education1:'')?>" />
					<input type="text" name="education2" class="fields" value="<?=(( isset($education2) )?$education2:'')?>" />
					<input type="text" name="education3" class="fields" value="<?=(( isset($education3) )?$education3:'')?>" />
				</td>
			</tr>

			<tr>
				<td width="30%">Country</td>
				<td width="70%">
					<select class="fields" name="country">
						
						<?php
							echo $options;
						?>

					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<input type="submit" value="Save" class="Btn" name="SaveBtn" />
				</td>
			</tr>

		</table>

		</form>

	</fieldset>

<?php include('footer.php'); ?>