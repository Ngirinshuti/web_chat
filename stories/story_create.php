<?php

require '../classes/init.php';

$msg = "";
$is_valid = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include "./Story.php";
    $description = $_POST['description'];

    $has_no_video = empty($_FILES['video']['name']);
    $has_no_audio = empty($_FILES['audio']['name']);
    $has_no_media = $has_no_audio && $has_no_video;
    $has_no_image = empty($_FILES['image']['name']);
    $has_no_file = $has_no_image && $has_no_media;
    $has_image_and_video = (!$has_no_image && !$has_no_video);
    $has_audio_and_video = !$has_no_audio && !$has_no_video;
    $has_no_desc = empty($description);
    $has_no_content = ($has_no_file && $has_no_desc);

    if ($has_no_content) {
        $msg = "You have to upoad an image, video, audio or write some text";
    } elseif ($has_image_and_video) {
        $msg = "You can't upload an image and video for the same story.";
    } elseif ($has_audio_and_video) {
        $msg = "You can't upload both audio and video, just choose one";
    } else {
        $image = uploadFile('image', './story_uploads');
        $media = uploadFile('video', './story_uploads') ?: uploadFile('audio', './story_uploads');

        $story = Story::create(
            username: $me->username,
            image: $image,
            description: $description,
            media: $media
        );

        $msg = "Story created successfully!";
        $is_valid = true;
        header("location: ./index.php?story={$story->id}");
        var_dump($_POST, $_FILES['image']);
        $msg = "Something went wrong!";
    }
}


/**
 * File upload function
 *
 * @param string  $field_name  name of form field containing the file
 * @param string  $destination file upload folder
 * @param boolean $uploaded    reference variable true if file was uploaded
 *
 * @return string uploaded file name
 */
function uploadFile(
    string $field_name,
    $destination = "./uploads",
    &$uploaded = false
): string {
    $random_number = strval(rand(100000, 9999999));
    $file_name = $random_number;
    $file_destination = $destination . "/$file_name";

    $uploaded = move_uploaded_file(
        $_FILES[$field_name]['tmp_name'],
        $file_destination
    );

    $file_name = basename(!$uploaded  ? "" : $file_destination);
    return $file_name;
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
            <img src="../images/<?php echo $me->profile_pic; ?>" alt="Image" class="accountImg">
        </div>

    </nav>

    <div class="storyCreateContainer">
        <div class="formContainer">
            <h1 class="header">Create story</h1>
            <?php echo !empty($msg) ? "<p class='" . (!$is_valid ? 'errorMsg' : 'successMsg') . "'>$msg</p>" : "" ?>
            <p class="formText">Start sharing your moments and memories</p>
            <form action="story_create.php" method="post" enctype="multipart/form-data">
                <label for="desc">Write Your story</label>
                <textarea class="storyCreateArea" id="desc" name="description" placeholder="Write you story here"></textarea>
                <label for="img">Image</label>
                <input accept="image/*" type="file" name="image" id="img" />
                <label for="video">Video</label>
                <input accept="video/mp4,video/webm" type="file" name="video" id="video" />
                <label for="audio">Audio</label>
                <input accept="audio/*" type="file" name="audio" id="audio" />
                <button type="submit">Create story</button>
            </form>
        </div>
    </div>

</body>

</html>


<?php
