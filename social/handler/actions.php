<?php
	session_start();
	include("../includes/config.php");

	if( $_REQUEST['action']=='SendFriendRequest' ){

		$sendingTo = $_REQUEST['name'];

		$userInfo = mysqli_query($connection, "SELECT * FROM members WHERE name='$sendingTo'");
		$rsuserInfo = mysqli_fetch_array($userInfo);

		$sendingTo = $rsuserInfo['id'];

		$sendingBy = $_SESSION['member_id'];

		$Requests = mysqli_query($connection, "INSERT INTO requests SET id='', sendingto='$sendingTo', sendingfrom='$sendingBy', date_added=NOW()");

		

		$message = $_SESSION['name']." sent you friend request. 
					<input type='button' value='Accept' class='actionBtn accept' data-type='1' data-user='".$_SESSION['member_id']."' /> 

					<input type='button' value='Reject' class='actionBtn reject' data-type='2' data-user='".$_SESSION['member_id']."' />
					";


		$Notifications = mysqli_query($connection, "INSERT INTO notifications 
									SET 
									id='', 
									noti_from='".$_SESSION['member_id']."',
									noti_to='".$sendingTo."', 
									message='".addslashes($message)."',
									date_added=NOW()");

		//echo mysqli_error($connection);
		echo 'success';

	}


	else if( $_REQUEST['action']=='RequestHandling' ){

		if( $_REQUEST['type']==1 ){
			$requestsUpdate = mysqli_query($connection, "UPDATE requests SET accepted='1' where sendingto='".$_SESSION['member_id']."' and sendingfrom='".$_REQUEST['from']."'");

			//friends table
			$friends = mysqli_query($connection, "INSERT INTO friends 
										SET 
										id='', 
										user1='".$_SESSION['member_id']."',
										user2='".$_REQUEST['from']."',
										date_added=NOW()");

			if( $requestsUpdate and $friends ){
				echo 'success_accept';
			}
		}else{
			$requestsUpdate = mysqli_query($connection, "UPDATE requests SET accepted='2' where sendingto='".$_SESSION['member_id']."' and sendingfrom='".$_REQUEST['from']."'");

			if( $requestsUpdate ){
				echo 'success_reject';
			}
		}

		

	}


	else if( $_REQUEST['action']=='SavePost' ){

		if( $_SESSION['member_id']!=$_REQUEST['user_id'] ){
			$posts = mysqli_query($connection, "INSERT INTO posts SET id='', user_id='".$_SESSION['member_id']."', post_to='".$_REQUEST['user_id']."', status='".$_REQUEST['status']."', date_added=NOW()");
		}else{
			$posts = mysqli_query($connection, "INSERT INTO posts SET id='', user_id='".$_SESSION['member_id']."', status='".$_REQUEST['status']."', date_added=NOW()");
		}

		

		echo 'success';

	}

	else if( $_REQUEST['action']=='FetchPosts' ){

		if( $_SESSION['member_id']==$_REQUEST['user_id'] ){
			$query = "SELECT * FROM posts WHERE 
						user_id='".$_SESSION['member_id']."' 
						or
						post_to='".$_SESSION['member_id']."' 
						order by id desc";
		}else{
			$query = "SELECT * FROM posts WHERE 
						user_id='".$_REQUEST['user_id']."' 
						or
						post_to='".$_REQUEST['user_id']."' 
						order by id desc";
		}


		


		$posts = mysqli_query($connection, $query);

		$Post='';
		while( $post = mysqli_fetch_array($posts) ){

			$userInfo = mysqli_query($connection, "SELECT * FROM members where id='".$post['user_id']."'");
			$rsuserInfo = mysqli_fetch_array($userInfo);



			$profile = mysqli_query($connection, "SELECT * FROM profile where user_id='".$post['user_id']."'");
			$rsprofile = mysqli_fetch_array($profile);

			if( isset($rsprofile['ppicture']) and $rsprofile['ppicture']!='' ){
				$img = '<img src="uploads/'.$rsprofile['ppicture'].'" height="30px" width="30px" class="ppicture" />';
			}else{
				$img = '<img src="images/profile.png" height="30px" width="30px" class="ppicture" />';
			}

			$postingTo = '';
			if( $post['post_to']!=0 ){
				$userToInfo = mysqli_query($connection, "SELECT * FROM members where id='".$post['post_to']."'");
				$rsuserToInfo = mysqli_fetch_array($userToInfo);

				$postingTo = ' > <a href="user.php?name='.$rsuserToInfo['name'].'">'.$rsuserToInfo['name'].'</a>';
			}

			if( $_SESSION['member_id']==$post['user_id'] ){
				$deleteIcon = '<a href="javascript:void(0)" onclick="DeletePost('.$post['id'].')">&#x2716;</a>';
			}else{
				$deleteIcon = '';
			}

			$Post .= '<div class="single-post">
						<table width="100%">

							<tr>
								<td width="5%">
									'.$img.'
								</td>
								<td width="90%" align="left">
									<a href="user.php?name='.$rsuserInfo['name'].'">'.$rsuserInfo['name'].'</a> '. $postingTo .'
								</td>
								<td width="5%" align="left">
									'.$deleteIcon.'
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="post-message">'.$post['status'].'</div>
								</td>
							</tr>
							<tr>
								<td colspan="3" align="right">
									Posted On: '.date('d-m-Y h:i a', strtotime($post['date_added'])).'
								</td>
							</tr>


							<tr>
								<td colspan="3" align="right">
									<form id="CommentFrm_'.$post['id'].'" method="POST">
										<input type="text" name="comment_'.$post['id'].'" class="commentfield" />
										<input type="submit" value="Submit" />
									</form>
								</td>
							</tr>

							<tr>
								<td colspan="3" align="left">
									<a href="javascipt:void(0)" id="viewcomment_'.$post['id'].'" onclick="LoadComment('.$post['id'].')">View Comments</a>
								</td>
							</tr>
							<tr>
								<td colspan="3" align="left">
									<div id="allcomments_'.$post['id'].'" class="allcomments">

										<img src="images/loading.gif" class="hidden" id="commentsLoading_'.$post['id'].'" />
									</div>
								</td>
							</tr>

						</table>

						<hr />
					</div>

					<script>
						$("#CommentFrm_'.$post['id'].'").validate({
							submitHandler: function(form){
								$.post("handler/actions.php?action=CommentPost&post_id='.$post['id'].'", $("#CommentFrm_'.$post['id'].'").serialize() , function showInfo(responseData){

										if( responseData=="success" ){
											document.getElementById("CommentFrm_'.$post['id'].'").reset();
											LoadComment('.$post['id'].');
										}
									
								});
							}
						});
						
					</script>
					';

		}

		echo $Post;

	}else if( $_REQUEST['action']=='CommentPost' ){

		$post_id = $_REQUEST['post_id'];

		$comment = "INSERT INTO comments SET id='', user_id='".$_SESSION['member_id']."', post_id='".$post_id."', comment='".$_REQUEST["comment_$post_id"]."', date_added=NOW()";

		mysqli_query($connection, $comment);

		echo 'success';



	}else if( $_REQUEST['action']=='LoadAllComments' ){

		$comments = mysqli_query($connection, "SELECT * FROM comments WHERE post_id='".$_REQUEST['post_id']."' order by id desc");

		$Strcomments='';
		while( $comment = mysqli_fetch_array($comments) ){


			$userInfo = mysqli_query($connection, "SELECT * FROM members where id='".$comment['user_id']."'");
			$rsuserInfo = mysqli_fetch_array($userInfo);



			$profile = mysqli_query($connection, "SELECT * FROM profile where user_id='".$comment['user_id']."'");
			$rsprofile = mysqli_fetch_array($profile);

			if( isset($rsprofile['ppicture']) and $rsprofile['ppicture']!='' ){
				$img = '<img src="uploads/'.$rsprofile['ppicture'].'" height="30px" width="30px" class="ppicture" />';
			}else{
				$img = '<img src="images/profile.png" height="30px" width="30px" class="ppicture" />';
			}

			if( $_SESSION['member_id']==$comment['user_id'] ){
				$deleteIcon = '<a href="javascript:void(0)" onclick="DeleteComment('.$comment['id'].', '.$comment['post_id'].')">&#x2716;</a>';
			}else{
				$deleteIcon = '';
			}


			$Strcomments .= '<div class="single-comment">
								
								<table width="100%">

									<tr>
										<td width="5%" valign="top">
											'.$img.'
										</td>
										<td width="90%" align="left">
											<a href="user.php?name='.$rsuserInfo['name'].'">'.$rsuserInfo['name'].'</a>
											<div class="comment-message">'.$comment['comment'].'</div>
										</td>
										<td width="5%" align="left">
											'.$deleteIcon.'
										</td>
									</tr>
									<tr>
										<td colspan="3" align="right">
											<div class="postedon">Posted On: '.date('d-m-Y h:i a', strtotime($comment['date_added'])).'</div>
										</td>
									</tr>



								</table>
								
							</div>';

		}

		echo $Strcomments;
		exit;

	}else if( $_REQUEST['action']=='DeleteAPost' ){

		$deletePost = mysqli_query($connection, "DELETE from posts where id='".$_REQUEST['post_id']."'");

		if( $deletePost ){
			echo 'success';
			exit;
		}

	}else if( $_REQUEST['action']=='DeletePostComments' ){

		$deletePost = mysqli_query($connection, "DELETE from comments where post_id='".$_REQUEST['post_id']."'");

		if( $deletePost ){
			echo 'success';
			exit;
		}

	}else if( $_REQUEST['action']=='DeleteAComment' ){

		$deleteComment = mysqli_query($connection, "DELETE from comments where id='".$_REQUEST['comment_id']."'");

		if( $deleteComment ){
			echo 'success';
			exit;
		}

	}else if( $_REQUEST['action']=='sendMessage' ){

		$inboxUsers = mysqli_query($connection, "SELECT * FROM inbox_user WHERE

										(user1='".$_SESSION['member_id']."' and user2='".$_REQUEST['user_id']."')

										OR

										(user2='".$_SESSION['member_id']."' and user1='".$_REQUEST['user_id']."')

									");
		
		if( mysqli_num_rows($inboxUsers)==0 ){

			$insertInbox = mysqli_query($connection, "INSERT INTO inbox_user SET id='',
											user1='".$_SESSION['member_id']."',
											user2='".$_REQUEST['user_id']."',
											date_added=NOW();
										");

		}

		$user_id = $_REQUEST['user_id'];

		$message = mysqli_query($connection, "INSERT INTO messages SET id='',
									sendingfrom='".$_SESSION['member_id']."',
									sendingto='".$_REQUEST['user_id']."',
									message='".$_REQUEST["message_$user_id"]."',
									date_added=NOW()
									");

		echo 'success';


	}else if( $_REQUEST['action']=='GetMessages' ){

		$messages = mysqli_query($connection, "SELECT * FROM messages WHERE 
									(sendingfrom='".$_SESSION['member_id']."' and sendingto='".$_REQUEST['user_id']."')
									OR 
									(sendingto='".$_SESSION['member_id']."' and sendingfrom='".$_REQUEST['user_id']."')
									");

		$messageList='';
		while( $message = mysqli_fetch_array($messages) ){

			$userInfo = mysqli_query($connection, "SELECT * FROM members where id='".$message['sendingfrom']."'");
			$rsuserInfo = mysqli_fetch_array($userInfo);



			$profile = mysqli_query($connection, "SELECT * FROM profile where user_id='".$message['sendingfrom']."'");
			$rsprofile = mysqli_fetch_array($profile);

			if( isset($rsprofile['ppicture']) and $rsprofile['ppicture']!='' ){
				$img = '<img src="uploads/'.$rsprofile['ppicture'].'" height="30px" width="30px" class="ppicture" />';
			}else{
				$img = '<img src="images/profile.png" height="30px" width="30px" class="ppicture" />';
			}

			$messageList .= '<div class="single-comment">
								
								<table width="100%">

									<tr>
										<td width="5%" valign="top">
											'.$img.'
										</td>
										<td width="95%" align="left">
											'.$rsuserInfo['name'].'
											<div class="comment-message">'.$message['message'].'</div>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right">
											<div class="postedon">'.date('d-m-Y h:i a', strtotime($message['date_added'])).'</div>
										</td>
									</tr>



								</table>
								
							</div>';

			

		}


		echo $messageList;
		exit;

	}else if( $_REQUEST['action']=='GetInboxUsers' ){

		$inboxUsers = mysqli_query($connection, "SELECT * FROM inbox_user WHERE

										user1='".$_SESSION['member_id']."' 
										or 
										user2='".$_SESSION['member_id']."'
									");

		$inboxUsers1='<ul class="UsersList">';
		while( $result = mysqli_fetch_array($inboxUsers) ){
			
			if( $result['user1']!=$_SESSION['member_id'] ){
				$userName = $result['user1'];
			}
			if( $result['user2']!=$_SESSION['member_id'] ){
				$userName = $result['user2'];
			}
			
			$userInfo = mysqli_query($connection, "SELECT * FROM members where id='".$userName."'");
			$rsuserInfo = mysqli_fetch_array($userInfo);

			$inboxUsers1 .= '<li><a href="messages.php?user='.$rsuserInfo['name'].'">'.$rsuserInfo['name'].'</a></li>';

		}

		$inboxUsers1 .= '</ul>';

		echo $inboxUsers1;
		exit;

	}


?>