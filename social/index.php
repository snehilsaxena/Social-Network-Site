<?php session_start(); include('header.php'); include("includes/config.php"); ?>

	<br />
	<br />
	<h1>Social Media Network</h1>
	<br />
	<hr />
	<br />
	<br />
	<br />
	<br />
	<?php

		$allmembers = mysqli_query($connection, "SELECT * FROM members WHERE id>'0'");

		echo '<h1>'.mysqli_num_rows($allmembers).' Members</h1>';

		$MembersList='';
		while( $rsallmembers = mysqli_fetch_array($allmembers) ){

			$userPInfo = mysqli_query($connection, "SELECT * FROM profile WHERE user_id='".$rsallmembers['id']."'");

			$rsuserPInfo = mysqli_fetch_array($userPInfo);


			$CountryName = mysqli_query($connection, "SELECT * FROM countries WHERE id='".$rsuserPInfo['country']."'");

			$rsCountryName = mysqli_fetch_array($CountryName);

			
			if( !isset($rsuserPInfo['ppicture']) ){
				$dp = '<img src="images/profile.png" width="150px" height="150px" class="ppicture" />';
			}else{
				$dp = '<img src="uploads/'.$rsuserPInfo['ppicture'].'" width="150px" height="150px" class="ppicture" />';
			
			}
				

			$MembersList .= '<div class="memberBox">

								<div class="">
									'.$dp.'
								</div>
								<h3 class="">
									<a href="user.php?name='.$rsallmembers['name'].'">'.ucfirst($rsallmembers['name']).'</a>'. ((isset($rsCountryName['country_name']))?' from '.$rsCountryName['country_name']:'') .'
								</h3>

							</div>';

		}

		echo $MembersList;

	?>

		

<?php include('footer.php'); ?>