<?php
	class Friends
	{
		protected $me;
		protected $db;

		 function __construct($conn, $me)
		{
			$this->me = $me;
			$this->db = $conn;
		}

		 function current_status($user){
			if ($this->request_sent($user)) {
				if ($this->i_sent_request($user)) {
					return 2;
				}else{
					return 3;
				}
			}elseif ($this->is_friends($user)) {
				return 1;
			}else{
				return 0;
			}
		}

		function active_friends()
		{
			if ($this->get_all_friends($this->me, false) == 0) {
				return 0;
				exit;
			}
			$active = [];
			$friends = $this->get_all_friends($this->me, true);

			foreach ($friends as $friend) {
				if ($friend->status == "online") {
					array_push($active, $friend);
				}
			}
			if (count($active) > 0) {
				return $active;
			}else{
				return count($active);
			}
		}

		function request_sent($user){
			try{
				$sql = "SELECT * FROM friendrequest WHERE (sender = :me AND reciever = :friend) OR (sender = :friend AND reciever = :me)";
				$check = $this->db->prepare($sql);
				$check->bindParam(":me", $this->me);
				$check->bindParam(":friend", $user);
				$check->execute();

				if ($check->rowCount() > 0) {
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				return["Error" => $e->getMessage()];
			}
		}

		function i_sent_request($friend){
			$sql  = "SELECT * FROM friendrequest WHERE sender = :me AND reciever = :friend";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(":me", $this->me);
			$stmt->bindParam(":friend", $friend);
			$stmt->execute();
			if ($stmt->rowCount() === 1) {
				return true;
			}else{
				return false;
			}
		}

		 function is_friends($friend)
		{
			$sql = "SELECT * FROM friends WHERE (friend = :friend AND partener = :me) OR (partener = :friend AND friend = :me)";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(":friend", $friend);
			$stmt->bindParam(":me", $this->me);
			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		}

		function send_friend_request($reciever)
		{
			try{
				$sql = "INSERT INTO friendrequest(sender, reciever) VALUES(:sender, :reciever)";
				$send_request = $this->db->prepare($sql);
				$send_request->bindParam(":sender", $this->me);
				$send_request->bindParam(":reciever", $reciever);
				$send_request->execute();

				if ($send_request->rowCount() === 1) {
					return["Success" => "Friend request sent."];
				}else{
					return["Error" => "Error Sending Freind Request!"];
				}
			}
			catch(PDOException $e){
				return["Error" => "DB_ERROR: <u><i><b>".$e->getMessage()."</b></i></u>"];
			}
		}

		function friend_request_aspects($reciever, $bool)
		{
			try
			{
				$sql1 = "DELETE FROM friendrequest WHERE (sender = :sender AND reciever = :reciever) OR (reciever = :sender AND sender = :reciever)";
				$stmt1 = $this->db->prepare($sql1);
				$stmt1->bindParam(":sender", $this->me);
				$stmt1->bindParam(":reciever", $reciever);
				$stmt1->execute();

				if ($stmt1->rowCount() > 0 && $bool)
				{
					$sql = "INSERT INTO friends(friend, partener) VALUES(:friend, :partener)";
					$confirm = $this->db->prepare($sql);
					$confirm->bindParam(":friend", $reciever);
					$confirm->bindParam(":partener", $this->me);
					$confirm->execute();

					if ($confirm->rowCount() > 0) {
						return["Success" => "You are now friends."];
					}else{
						return["Error" => "Unable to make Friend."];
					}
				}else if($stmt1->rowCount() > 0 && !$bool){
						return["Success" => "Friend request removed."];
					}else{
						return["Error" => "Error With Friend request!"];
					}
			}catch(PDOException $e){
				return["Error" => "DB_ERROR: <u><i><b>".$e->getMessage()."</b></i></u>"];
			}
		}

		function get_friend_requests($bool)
		{
			try
			{
				$sql = "SELECT profile_pic, fname, lname FROM friendrequest JOIN users ON users.username = friendrequest.sender WHERE reciever = ?";
				$stmt = $this->db->prepare($sql);
				$stmt->execute([$this->me]);

				if ($bool && $stmt->rowCount() > 0) {
					return $stmt->fetchAll(PDO::FETCH_ASSOC);
				}else if($stmt->rowCount() == 0 && $bool){
					return["Info" => "You have no friend requests"];
				}else{
					return $stmt->rowCount();
				}
			}
			catch(PDOException $e)
			{
				return["Error" => "DB_ERROR: <u><i><b>".$e->getMessage()."</b></i></u>"];
			}
		}

		function get_all_friends($user, $bool)
		{
			try
			{
				$sql = "SELECT users.dob, users.profile_pic, users.fname, users.lname, users.address, users.status, users.username FROM friends JOIN users ON (CASE WHEN friends.friend = :user THEN friends.partener ELSE friends.friend END) = users.username WHERE friends.friend = :user OR friends.partener = :user";
				$stmt = $this->db->prepare($sql);
				$stmt->bindParam(":user", $user);
				$stmt->execute();

				if ($stmt->rowCount() > 0 && $bool) {
					return $stmt->fetchAll(PDO::FETCH_OBJ);
				}
				elseif ($stmt->rowCount() > 0 && !$bool) {
					return $stmt->rowCount();
				}
				elseif ($stmt->rowCount() === 0 && $bool) {
					return "You have no friends";
				}
				else{
					return 0;
				}
			}
			catch(PDOException $e)
			{
				return["Error" => "DB_ERROR: <u><i><b>".$e->getMessage()."</b></i></u>"];
			}
		}

		function delete_friend($friend)
		{
			try
			{
				$sql = "DELETE FROM friends WHERE (friend = :friend AND partener = :partener) OR (partener = :friend AND friend = :partener)";
				$delete_friend = $this->db->prepare($sql);
				$delete_friend->bindParam(":friend", $this->me);
				$delete_friend->bindParam(":partener", $friend);
				$delete_friend->execute();

				if ($delete_friend->rowCount() > 0) {
					return["Success" => "Friend Deleted Successfully."];
				}else{return["Error" => "Friend was not found."];}
			}
			catch(PDOException $e){
				return["Error" => "DB_ERROR: <u><i><b>".$e->getMessage()."</b></i></u>"];
			}
		}

		function get_mutual_friends($user, $bool)
		{
			if ($this->get_all_friends($user, false) > 0 && $this->get_all_friends($this->me, false) > 0)
			{
				$mutual_friends = [];
				$my_friends = $this->get_all_friends($this->me, true);
				$user_friends = $this->get_all_friends($user, true);
				$mutuals = 0;
				foreach ($user_friends as $user_friend) {
					foreach ($my_friends as $my_friend) {
						if ($user_friend->username == $my_friend->username) {
							array_push($mutual_friends, $user_friend->username);
							$mutuals += 1;
						}
					}
				}
				if ($bool){
					return $mutual_friends;
				}else{
					return $mutuals;
				}
			}else{
				return 0;
			}
		}
	}