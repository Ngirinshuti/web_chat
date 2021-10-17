<?php
require '../classes/init.php';

$msg = "";
$is_valid = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include "./Story.php";

    $description = $_POST['description'];
    $image_file_name = $_FILES['image']['name'];
    $file_destination = "./story_uploads/".$image_file_name;

    if (empty($description) && empty($image_file_name)) {
        $msg = "You have to upoad an image or write some text";
    } else {

        $uploaded = !empty($image_file_name) && move_uploaded_file(
            $_FILES['image']['tmp_name'], $file_destination
        );

        if (!empty($description) || $uploaded) {
            $image_name = basename(!$uploaded  ? "" : $file_destination);
            $story = Story::create($me->username, $image_name, $description);
            $msg = "Story created successfully!";
            $is_valid = true;
            header("location: ./index.php?story={$story->id}");

        } else {
            var_dump($_POST, $_FILES['image']);
            $msg = "Something went wrong!";
        }
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/stories.css">
    <link rel="stylesheet" href="./css/form.css">
    <title>Create Story</title>
</head>

<body>
    <nav>
        <div class="logo">MeetUp</div>
        <ul>
            <li><a href="../friends/profile.php">Profile</a></li>
            <li><a href="./index.php">All Stories</a></li>
            <li><a href="../friends/friends.php">Friends</a></li>
        </ul>
        <div class="account">
            <img src="../images/<?php  echo $me->profile_pic; ?>" alt="Image" class="accountImg">
        </div>

    </nav>

    <div class="storyCreateContainer">
        <div class="formContainer">
            <h1 class="header">Create story</h1>
            <?php echo !empty($msg) ? "<p class='". (!$is_valid ? 'errorMsg' : 'successMsg') ."'>$msg</p>" : "" ?>
            <p class="formText">Start sharing your moments and memories</p>
            <form action="story_create.php" method="post" enctype="multipart/form-data">
                <label for="desc">Write Your story</label>
                <textarea class="storyCreateArea" id="desc" name="description" placeholder="Write you story here"></textarea>
                <label for="img">Image</label>
                <input type="file" name="image" id="img" />
                <button type="submit">Create story</button>
            </form>
        </div>
    </div>

</body>

</html>


<?php


