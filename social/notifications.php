<?php session_start(); 
if( !isset($_SESSION['member_id']) ){ header("Location: login.php"); }
include('header.php'); include("includes/config.php"); ?>

	<div class="friendslist">
		<h1>Friends</h1>
		<?php
			$friends = mysqli_query($connection, "SELECT * FROM friends WHERE user1='".$_SESSION['member_id']."' or user2='".$_SESSION['member_id']."'");

			$totalFriends = mysqli_num_rows($friends);

			while( $results = mysqli_fetch_array($friends) ){
				?>
					<div class="notification">
						<?php
							if( $results['user1']!=$_SESSION['member_id'] ){
								
								$UserInfo = mysqli_query($connection, "SELECT name FROM members where id='".$results['user1']."'");
								$rsUserInfo = mysqli_fetch_array($UserInfo);
								

								$UserInfoP = mysqli_query($connection, "SELECT ppicture FROM profile where user_id='".$results['user1']."'");
								$rsUserInfoP = mysqli_fetch_array($UserInfoP);

								if( mysqli_num_rows($UserInfoP)==0 ){
									echo '<img src="images/profile.png" width="100px" height="100px" class="ppicture" />';
								}else{
									$rsUserInfoP = mysqli_fetch_array($UserInfoP);

									echo '<img src="uploads/'.$rsUserInfoP['ppicture'].'" width="100px" height="100px" class="ppicture" />';
								}
								echo $rsUserInfo['name'];

							}
							if( $results['user2']!=$_SESSION['member_id'] ){
								
								$UserInfo1 = mysqli_query($connection, "SELECT name FROM members where id='".$results['user2']."'");

								$rsUserInfo1 = mysqli_fetch_array($UserInfo1);
								

								$UserInfoP1 = mysqli_query($connection, "SELECT ppicture FROM profile where user_id='".$results['user2']."'");
								if( mysqli_num_rows($UserInfoP1)==0 ){
									echo '<img src="images/profile.png" width="100px" height="100px" class="ppicture" />';
								}else{
									$rsUserInfoP1 = mysqli_fetch_array($UserInfoP1);

									echo '<img src="uploads/'.$rsUserInfoP1['ppicture'].'" width="100px" height="100px" class="ppicture" />';
								}
								echo $rsUserInfo1['name'];
								
								
							}
						?>
						( <?=$results['date_added']?> )
					</div>
				<?php
			}

		?>
	</div>

	<div class="notificationslist">
	<?php

		$user_id = $_SESSION['member_id'];

		$notifications = mysqli_query($connection, "SELECT * FROM notifications where noti_to='$user_id'");
		
		while( $results = mysqli_fetch_array($notifications) ){

			$friends = mysqli_query($connection, "SELECT * FROM friends WHERE user1='".$results['noti_from']."' and user2='".$results['noti_to']."' OR user1='".$results['noti_to']."' and user2='".$results['noti_from']."'");

			if( mysqli_num_rows($friends)==0 ){
				?>
				<div class="notification">
					<?=$results['date_added']?>
					-----
					<?=$results['message']?>
				</div>
				<?php
			}

			?>
				
			<?php
		}

	?>
	</div>
	
<script>
	/*
	function ActionRequest(type, from){
		$.post('handler/actions.php?action=RequestHandling&type='+type+'&from='+from, function(response){
			alert(response);
			if( response=='success_accept' ){
				$('.notification').html('You and '+from+' are now friends.');
			}else if( response=='success_reject' ){
				$('.notification').html('You have rejected the friend request.');
			}

		});
	}
	*/


	$('.actionBtn').click(function(){

		CurrentBtn = $(this);

		var type = CurrentBtn.attr('data-type');
		var user = CurrentBtn.attr('data-user');

		$.post('handler/actions.php?action=RequestHandling&type='+type+'&from='+user, function(response){
			
			if( response=='success_accept' ){

				CurrentBtn.parent().html('You and '+user+' are now friends.');

			}else if( response=='success_reject' ){
				CurrentBtn.parent().html('You have rejected the friend request.');
			}

			window.location = 'notifications.php';

		});


	});

</script>
<?php include('footer.php'); ?>