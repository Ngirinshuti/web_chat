<?php require "../classes/init.php";
if (isset($_GET["page"]) or isset($_POST["page"])) {

if (isset($_GET["friend"])) {
	$friend = $_GET["friend"];
	if ($_GET["page"] == "/project2/friends/user.php") {
		$page = $_GET["page"]."?us=".$friend;
	}else{
		$page = $_GET["page"];
	}

	if (isset($_GET["un"]) && $_GET["un"]) {
		$result = $friend_obj->delete_friend($friend);
	    throw_result($result, $page."#".$friend);
	}
	if (isset($_GET['ad']) && $_GET['ad']) {
		$result = $friend_obj->send_friend_request($friend);
		throw_result($result, $page."#".$friend);
	}

}

	if (isset($_GET["request"])) {
		$request  = $_GET["request"];
		if ($_GET["page"] == "/project2/friends/user.php") {
			$page = $_GET["page"]."?us=".$request;
		}else{
			$page = $_GET["page"];
	}

	if (isset($_GET["accept"]) && $_GET["accept"]) {
	    $result = $friend_obj->friend_request_aspects($request, true);

	    throw_result($result, $page."#".$request);
	}
	if (isset($_GET["ignore"]) && $_GET["ignore"]) {
	    $result = $friend_obj->friend_request_aspects($request, false);
	    throw_result($result, $page."#".$request);
   }
}


  if (isset($_FILES['image']['name'])) {
    $page = $_POST["page"];
    $separate = explode(".", $_FILES["image"]["name"]);
    $ext = end($separate);
    $rand = rand(100, 888);
    $name = $rand . "." . $ext;
    $location = "../images/" . $name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $location)) {
	    $result = $user_obj->update_property("profile_pic", $name);
	    throw_result($result, $page);

    }else{
	    $result = ["Error" => "Problem uploading image file try again later!"];
	    throw_result($result, $page);
    }
  }

	if (isset($_POST["about"])) {
		$page = $_POST["page"];
		$about = test_input($_POST["about"]);
		$result = $user_obj->update_property("about", $about);
		throw_result($result, $page);
	}

	if (isset($_POST["address"])) {
		$page = $_POST["page"];
		$address = test_input($_POST["address"]);
		$result = $user_obj->update_property("address", $address);
		throw_result($result, $page);
	}

}else{
	echo "Please specify a page!";
}
function throw_result($result, $page){
	if (isset($result["Error"])) {
		header("location: ".$page."?Error=".$result["Error"]. "#error");
	}
	elseif (isset($result["Info"])) {
		header("location: ".$page."?Info=".$result["Info"]. "#info");
	}
	else {
		header("location: ".$page);
	}
}

function test_input($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}

 ?>
