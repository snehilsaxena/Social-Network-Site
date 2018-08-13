<?php 
	session_start();
	if( !isset($_SESSION['member_id']) ){ header("Location: login.php"); }

	include('header.php'); 
	include('includes/config.php'); 
	
	$errors = ''; $success = '';
	$user_id = $_SESSION['member_id'];

	

	$SettingsData = mysqli_query($connection, "SELECT * FROM settings where user_id='".$user_id."'");

	$rsSettingsData = mysqli_fetch_array($SettingsData);


		
	if( isset($_REQUEST['SaveSettingsBtn']) ){

		$s1 = $_REQUEST['wallposts'];
		$s2 = $_REQUEST['seeposts'];
		$s3 = $_REQUEST['seeprofile'];
		$s4 = $_REQUEST['sendmessage'];
		
		$insert = "UPDATE settings SET 
						postwall='$s1',
						seeposts='$s2',
						seeprofile='$s3',
						sendmessage='$s4',
						date_added=NOW()

						where user_id='".$user_id."'
					";

			mysqli_query($connection, $insert);

			echo mysqli_error($connection);

			$success = "Saved";


	}
		

	

?>

	

	<fieldset class="customFrmWrap"><legend>Welcome to my website</legend>
		<?php echo $errors; ?>
		<?php echo $success; ?>
		<form action="" method="POST" enctype="multipart/form-data">

		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			

			<tr>
				<td width="30%">Who can post on my wall</td>
				<td width="70%">
					<select name="wallposts" class="fields">
						<option <?=(($rsSettingsData['postwall']==1)?'selected':'')?> value="1">Public</option>
						<option <?=(($rsSettingsData['postwall']==2)?'selected':'')?> value="2">Friends</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="30%">Who can see my posts</td>
				<td width="70%">
					<select name="seeposts" class="fields">
						<option <?=(($rsSettingsData['seeposts']==1)?'selected':'')?> value="1">Public</option>
						<option <?=(($rsSettingsData['seeposts']==2)?'selected':'')?> value="2">Friends</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="30%">Who can see my profile details</td>
				<td width="70%">
					<select name="seeprofile" class="fields">
						<option <?=(($rsSettingsData['seeprofile']==1)?'selected':'')?> value="1">Public</option>
						<option <?=(($rsSettingsData['seeprofile']==2)?'selected':'')?> value="2">Friends</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="30%">Who can send me private message	</td>
				<td width="70%">
					<select name="sendmessage" class="fields">
						<option <?=(($rsSettingsData['sendmessage']==1)?'selected':'')?> value="1">Public</option>
						<option <?=(($rsSettingsData['sendmessage']==2)?'selected':'')?> value="2">Friends</option>
					</select>
				</td>
			</tr>
			
			
			<tr>
				<td colspan="2">
					<input type="submit" value="Save" class="Btn" name="SaveSettingsBtn" />
				</td>
			</tr>

		</table>

		</form>

	</fieldset>

<?php include('footer.php'); ?>