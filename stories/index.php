<?php
require '../classes/init.php';
require './Story.php';

$main_story = null;
$user_story_count = 0;

$stories = [];
$user_stories = [];
$next_story = null;
$prev_story = null;

if (isset($_GET['story'])) {
    $main_story = Story::findOne((int)$_GET['story']);
    $user_stories = Story::getUserStories($main_story->username);

    foreach ($user_stories as $user_story) {

        if ($user_story->id > $main_story->id && !$next_story) {
            $next_story = $user_story;
        }

        if ($user_story->id < $main_story->id) {
            $prev_story = $user_story;
        }
    }
    // $prev_story = $user_stories;
    // $user_story_count = $user_stories
    Story::viewStory($me->username, (int)$_GET['story']);
}
$stories = Story::getFriendsStories($me->username);

if (!isset($_SESSION['a_user'])) {
    header('location: ../index.php');
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
    <title>Stories</title>
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
    <div class="storyContainer">

        <div class="sideBar">
            <h1 class="sideBarHeader">Stories</h1>
            <div class="myStory">
                <h4 class="mystoryHeader">My story</h4>
                <div class="storyCreate">
                    <a class="btn" href="./story_create.php" class="storyCreateBtn">Create</a class="btn" href="./story_create.html">
                    <div class="createText">
                        <h5 class="createStoryHeader">Create your story</h5>
                        <small class="createStoryDec">Share your moments</small>
                    </div>
                </div>
            </div>
            <h3 class="storiesHeader">All Stories</h3>
            <div class="storyList">
                <?php foreach ($stories as $story) : ?>
                    <?php
                    $user  = ($user_obj->get_user_data($story->username));
                    ?>
                    <div class="storyItem">
                        <div class="storyImg">
                            <img src="../images/<?php echo urlencode($user->profile_pic); ?>" alt="User Pic" />
                        </div>
                        <div class="storyDetails">
                            <a href="#" class="storyName">
                                <?php echo $story->username; ?>
                                <?php echo $story->story_count ? "<span class='dot'></span><span class='storyCount'>{$story->story_count} stories</span>" : ""; ?>
                            </a>
                            <div class="storyData">
                                <span class="storyTime"><?php echo $date_obj->dateDiffStr($story->created_at); ?></span>
                                <span class="dot"></span>
                                <span class="storyViews"><?php echo $story->views; ?> views</span>
                            </div>
                        </div>
                        <a class="storyLink" href="./index.php?story=<?php echo $story->id; ?>" style="display:none;"></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="main">
            <?php if ($main_story) : ?>
                <div class="storyPreviewContainer">
                    <div class="storyPreview">
                        <?php if ($main_story->image) : ?>
                            <?php $user = $user_obj->get_user_data($main_story->username); ?>
                        <img src="./story_uploads/<?php echo $main_story->image; ?>" alt="story Image" class="storyPreviewImg">
                        <?php endif; ?>
                        <?php if ($main_story->description) : ?>
                            <div class="<?php echo !$main_story->image ? 'centered': ""; ?> storyDesc"><?php echo $main_story->description; ?></div>
                        <?php endif; ?>
                        <div class="storyPreviewControls">
                            <div class="storyPreviewProgressContainer">
                                <div class="storyPreviewProgress"></div>
                            </div>
                            <div class="storyPreviewUser">
                                <div class="storyPreviewUserImg">
                                    <img src="../images/<?php echo $user->profile_pic; ?>" alt="user image">
                                </div>
                                <div class="storyPreviewUserInfo">
                                    <a href="#" class="storyPreviewUserName"><?php echo $main_story->username; ?></a>
                                    <span class="dot"></span>
                                    <span class="storyPreviewTime"><?php echo $date_obj->dateDiffStr($main_story->created_at); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($next_story) : ?>
                    <a href="./index.php?story=<?php echo $next_story->id;?>" class="storyPreviewNextButton">Next</a>
                    <?php endif; ?>
                    <div class="storyPreviewReply">
                        <input placeholder="reply..." type="text" name="reply" class="storyPreviewReplyInput">
                        <button class="storyPreviewReplyBtn">Reply</button>
                    </div>
                </div>
            <?php else : ?>
                <div class="centerText">
                    <h2 class="header">Story preview</h2>
                    <p>Select story to preview</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script defer>
        document.addEventListener('DOMContentLoaded', e => {
            const links = document.querySelectorAll('.storyLink');
            links.forEach(link => {
                link.closest('.storyItem').addEventListener('click', e => {
                    link.click()
                })
            })
        })
    </script>
</body>

</html>
