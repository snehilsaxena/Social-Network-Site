<?php session_start(); 
if( !isset($_SESSION['member_id']) ){ header("Location: login.php"); }
include('header.php'); include('includes/config.php'); ?>

	<h1>
		
		<?php

			$name = $_REQUEST['name'];

			$userInfo = mysqli_query($connection, "SELECT * FROM members WHERE name='$name'");

			$rsuserInfo = mysqli_fetch_array($userInfo);


			$friends = mysqli_query($connection, "SELECT * FROM friends WHERE user1='".$rsuserInfo['id']."' or user2='".$rsuserInfo['id']."'");

			$friendsArray = array();
			while( $results = mysqli_fetch_array($friends) ){


				if( $results['user1']==$rsuserInfo['id'] ){
					array_push($friendsArray, $results['user2']);
				}
				if( $results['user2']==$rsuserInfo['id'] ){
					array_push($friendsArray, $results['user1']);
				}
			}


			if( in_array($_SESSION['member_id'], $friendsArray) ){
				$friend = 1;
			}else{
				$friend = 0;
			}


			$userPInfo = mysqli_query($connection, "SELECT * FROM profile WHERE user_id='".$rsuserInfo['id']."'");

			$rsuserPInfo = mysqli_fetch_array($userPInfo);



			$userSettings = mysqli_query($connection, "SELECT * FROM settings WHERE user_id='".$rsuserInfo['id']."'");

			$rsuserSettings = mysqli_fetch_array($userSettings);

		?>

	</h1>

	<div class="userinfo">
		<table width="100%">

			<tr>
				<td width="40%">
				<?php
					if( !isset($rsuserPInfo['ppicture']) ){
						echo 'No profile';
					}else{
					?>
						<img src="uploads/<?=$rsuserPInfo['ppicture']?>" width="100px" height="100px" class="ppicture" />
					<?php
					}
					?>
				
				</td>
				<td width="60%" valign="top"><?=$rsuserInfo['name']?></td>
			</tr>

			<?php

			$canseeprofile = 0;
			if( $_SESSION['member_id']==$rsuserInfo['id'] ){
				$canseeprofile = 1;
			}else if( $rsuserSettings['seeposts']==2 ){ 
				if( $friend==1 ){ 
					$canseeprofile = 1;
				}
			}else if( $rsuserSettings['seeposts']==1 ){
				$canseeprofile = 1;
			}

			
		?>

			<?php
				if( $canseeprofile == 1 ){
			?>


			<tr>
				<td width="40%">Email</td>
				<td width="60%"><?=$rsuserInfo['email']?></td>
			</tr>
			<tr>
				<td width="40%">Country</td>
				<?php
					$country = mysqli_query($connection, "SELECT * FROM countries where id='".$rsuserPInfo['country']."'");
					$rscountry = mysqli_fetch_array($country);
				?>
				<td width="60%"><?=$rscountry['country_name']?></td>
			</tr>
			<tr>
				<?php
					if( isset($rsuserPInfo['gender']) and $rsuserPInfo['gender']=='m' ){
						$gender = "Male";
					}else if( isset($rsuserPInfo['gender']) and $rsuserPInfo['gender']=='f' ){
						$gender = "Female";
					}else{
						$gender = "-";
					}
				?>
				<td width="40%">Gender</td>
				<td width="60%"><?=$gender?></td>
			</tr>
			<tr>
				<td width="40%">About</td>
				<td width="60%"><?=$rsuserPInfo['about']?></td>
			</tr>
			<tr>
				<td width="40%">Date of birth</td>
				<td width="60%"><?=$rsuserPInfo['dob']?></td>
			</tr>
			<?php } ?>


			<tr>
				<td colspan="2">
				<?php
					$cansendmessage = 0;
					if( $_SESSION['member_id']==$rsuserInfo['id'] ){
						$cansendmessage = 1;
					}else if( $rsuserSettings['sendmessage']==2 ){ 
						if( $friend==1 ){ 
							$cansendmessage = 1;
						}
					}else if( $rsuserSettings['sendmessage']==1 ){
						$cansendmessage = 1;
					}

					

					$requested = mysqli_query($connection, "SELECT * FROM requests WHERE sendingto='".$rsuserInfo['id']."' and sendingfrom='".$_SESSION['member_id']."' and accepted='0'");

					if( mysqli_num_rows($requested)>=1 ){
						echo "Friend Request Sent";
					}else{
					?>
						<?php

							



							if( $_SESSION['member_id']!=$rsuserInfo['id'] ){
								?>
								<input type="button" value="Send Friend Request" class="Btn" onclick="SendAction(1, '<?=$name?>')" id="requestBtn" />

								
								<?php
							}

						?>
						
					<?php
					}
					?>

					<?php

						if( $cansendmessage==1 and $_SESSION['member_id']!=$rsuserInfo['id'] ){
							?>
								<input type="button" value="Send Private Message" class="Btn" onclick="SendMessageButton('<?=$name?>')" id="requestBtn" />
							<?php
						}

					
				?>
				</td>
			</tr>
		</table>
	</div>
	<div class="posts">
		<?php
			$canpost = 0;
			if( $_SESSION['member_id']==$rsuserInfo['id'] ){
				$canpost = 1;
			}else if( $rsuserSettings['postwall']==2 ){ 
				if( $friend==1 ){ 
					$canpost = 1;
				}
			}else if( $rsuserSettings['postwall']==1 ){
				$canpost = 1;
			}



			if( $canpost==1 ){
				?>
				<form id="statusFrm" name="statusFrm" method="POST">
	
					<table width="100%">
					
						<tr>
							<td>
								<textarea name="status" class="required" rows="6" style="width:98%;" cols="30"></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" value="POST STATUS" />
							</td>
						</tr>

					</table>

				</form>
				<?php } ?>
		

		<?php

			$canseeposts = 0;
			if( $_SESSION['member_id']==$rsuserInfo['id'] ){
				$canseeposts = 1;
			}else if( $rsuserSettings['seeposts']==2 ){ 
				if( $friend==1 ){ 
					$canseeposts = 1;
				}
			}else if( $rsuserSettings['seeposts']==1 ){
				$canseeposts = 1;
			}

			if( $canseeposts==1 ){ 
			?>
				<div id="allPosts">
					Loading....
				</div>
			<?php
				
			}
		?>

	</div>


<script src="includes/jquery/validate.js"></script>
<script src="includes/jquery/ajaxform.js"></script>
<script>

$(document).ready(function(){
	LoadPosts();


});


	function SendAction(type, name){

		$.post('handler/actions.php?action=SendFriendRequest&name='+name, function(response){
			
			if( response == 'success' ){
				$('#requestBtn').hide();
				$('#requestBtn').parent().html("Friend Request Sent");
			}

		});

	}
	
	$('#statusFrm').validate({
		submitHandler: function(form){
			$.post('handler/actions.php?action=SavePost&user_id='+<?=$rsuserInfo['id']?>, $('#statusFrm').serialize() , function showInfo(responseData){

				if( responseData=='success' ){
					document.getElementById('statusFrm').reset();
					LoadPosts();
				}
				
				
			});
		}
	});



	function LoadPosts(){
		$.post('handler/actions.php?action=FetchPosts&user_id='+<?=$rsuserInfo['id']?>, function(responseData){

			$('#allPosts').html(responseData);
				
		});
	}


	function LoadComment(postid){
		$('#commentsLoading_'+postid).show();
		$.post('handler/actions.php?action=LoadAllComments&post_id='+postid, function(responseData){

			$('#allcomments_'+postid).html(responseData);
			$('#commentsLoading_'+postid).hide();
			$('#viewcomment_'+postid).hide();
				
		});
	}



	function DeletePost(postid){
		$.post('handler/actions.php?action=DeleteAPost&post_id='+postid, function(responseData){
			if( responseData=='success' ){
				LoadPosts();
				DeleteComments(postid);
			}
		});
	}

	function DeleteComments(postid){
		$.post('handler/actions.php?action=DeletePostComments&post_id='+postid);
	}


	function DeleteComment(commentid, postid){
		$.post('handler/actions.php?action=DeleteAComment&comment_id='+commentid, function(responseData){
			if( responseData=='success' ){
				LoadComment(postid);
			}
		});
	}

	function SendMessageButton(username){

		window.location = 'messages.php?user='+username;

	}

</script>

<?php include('footer.php'); ?>