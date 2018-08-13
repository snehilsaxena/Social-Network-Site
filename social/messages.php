<?php session_start(); 
	
if( !isset($_SESSION['member_id']) ){ header("Location: login.php"); }

include('header.php'); include("includes/config.php"); ?>
<script src="includes/jquery/validate.js"></script>
<script src="includes/jquery/ajaxform.js"></script>
	<?php

		if( isset($_REQUEST['user']) and $_REQUEST['user']!='' ){
			$name = $_REQUEST['user'];

			$userInfo = mysqli_query($connection, "SELECT * FROM members WHERE name='$name'");
			$rsuserInfo = mysqli_fetch_array($userInfo);
		}
		

	?>
	
	<div class="allusers">

	</div>

	<div class="messages">
		
		<div id="message"></div>
		<?php if( isset($_REQUEST['user']) and $_REQUEST['user']!='' ){ ?>
			<form id="MessageFrm_<?=$rsuserInfo['id']?>" method="POST">
				
				<textarea name="message_<?=$rsuserInfo['id']?>" class="required fields_textarea" style="height:100px;"></textarea>
				<input type="submit" value="send" class="Btn" />

			</form>
		<?php } ?>
	</div>

	<script>
		<?php if( isset($_REQUEST['user']) and $_REQUEST['user']!='' ){ ?>
			LoadMessages(<?=$rsuserInfo['id']?>);
		<?php } ?>
		LoadInboxUsers();

		<?php if( isset($_REQUEST['user']) and $_REQUEST['user']!='' ){ ?>
			$('#MessageFrm_<?=$rsuserInfo['id']?>').validate({
				submitHandler: function(form){
					$.post('handler/actions.php?action=sendMessage&user_id=<?=$rsuserInfo['id']?>', $('#MessageFrm_<?=$rsuserInfo['id']?>').serialize() , function showInfo(responseData){
							
							if( responseData=='success' ){
								document.getElementById('MessageFrm_<?=$rsuserInfo['id']?>').reset();
								LoadMessages(<?=$rsuserInfo['id']?>);
							}
							
							

					});
				}
			});
		<?php } ?>


		function LoadMessages(userid){
			$.post('handler/actions.php?action=GetMessages&user_id='+userid,  function(responseData){
					
					
					$('#message').html(responseData);
					$('#message').scrollTop(
						$('#message').height()
					);

					

			});
		}


		function LoadInboxUsers(){
			$.post('handler/actions.php?action=GetInboxUsers',  function(responseData){
					
					
					$('.allusers').html(responseData);
					

			});
		}

	</script>
<?php include('footer.php'); ?>