<?php

require '../classes/init.php';
require './Story.php';

$main_story = null;

// get all friends stories
$stories = Story::getFriendsStories($me->username);
// specific user stories
$user_stories = [];

$prev_user_stories = [];
$next_user_stories = [];
// next story to be played
$next_story = null;
// prev story
$prev_story = null;

// get current story and get prev and next user story if available
if (isset($_GET['story'])) {
    Story::viewStory($me->username, (int)$_GET['story']);
    $main_story = Story::findOne((int)$_GET['story']);

    if (!$main_story) {
        $url = explode('?', $_SERVER['REQUEST_URI'])[0];
        $msg = ("Story was not found! It might be expired.");
        header("location: ../404.php?url=$url&msg=$msg");
        exit;
    }

    $user_stories = Story::getUserStories($main_story->username);

    // pick next and prev story from current story owner
    foreach ($user_stories as $user_story) {

        if ($user_story->id > $main_story->id && !$next_story) {
            $next_story = $user_story;
        }

        if ($user_story->id < $main_story->id) {
            $prev_story = $user_story;
        }
    }
}

// make stories jump to next user
for ($i = 0; $i < count($stories); $i++) {

    // if not story being displayed
    if (!$main_story) {
        break;
    }

    // if there is next and prev stories (no jump needed)
    if ($next_story && $prev_story) {
        break;
    }

    // if no prev story
    // we need to find a story previous to current story
    // from our stories comparing owners
    if (!$prev_story && isset($stories[$i + 1]) && $stories[$i + 1]->username === $main_story->username) {
        $prev_story = $stories[$i];
    }

    // if no next story
    // we need to make sure there is a story next
    // to this and point to it
    if (!$next_story && $stories[$i]->username === $main_story->username && isset($stories[$i + 1])) {
        $next_story = $stories[$i + 1];
    }
}

// get current user latest story
$my_story = Story::findByUser($me->username);

if (!isset($_SESSION['a_user'])) {
    header('location: ../index.php');
}

$main_story_data = $main_story ? json_encode($main_story) : "";

/**
 * Check if story is being played
 *
 * @param Story $story story object
 *
 * @return boolean
 */
function fromActiveUser(Story $story)
{
    $main_story = $GLOBALS['main_story'];
    return $story->username === $main_story?->username;
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
                <h4 class="myStoryHeader">My story</h4>
                <?php if ($my_story) : ?>
                    <div class="storyList">
                        <div class="storyItem <?php echo fromActiveUser($my_story) ? "active" : ""; ?>">
                            <div class="storyImg">
                                <img src="../images/<?php echo urlencode($me->profile_pic); ?>" alt="User Pic" />
                            </div>
                            <div class="storyDetails">
                                <a href="#" class="storyName">
                                    <?php echo $my_story->username; ?>
                                </a>
                                <div class="storyData">
                                    <?php echo $my_story->story_count ? "</span><span class='storyCount'>{$my_story->story_count} stories</span>" : ""; ?>
                                    <span class="storyTime"><?php echo $date_obj->dateDiffStr($my_story->created_at); ?></span>
                                </div>
                            </div>
                            <a class="storyLink" href="./index.php?story=<?php echo $my_story->id; ?>" style="display:none;"></a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="storyCreate">
                    <a href="./story_create.php" class="storyCreateBtn btn">Create</a class="btn" href="./story_create.html">
                    <div class="createText">
                        <h5 class="createStoryHeader">Create your story</h5>
                        <small class="createStoryDec">Share your moments</small>
                    </div>
                </div>
            </div>
            <div class="friendStories">
                <h3 class="storiesHeader">Friends Stories</h3>
                <div class="storyList">
                    <?php echo empty($stories) ? "<h5>No active stories.</h5>" : ""; ?>
                    <?php foreach ($stories as $story) : ?>
                        <?php
                        $user  = ($user_obj->get_user_data($story->username));
                        ?>
                        <div class="storyItem <?php echo fromActiveUser($story) ? "active" : ""; ?>">
                            <div class="storyImg">
                                <img src="../images/<?php echo urlencode($user->profile_pic); ?>" alt="User Pic" />
                            </div>
                            <a href="#" class="storyName">
                                <?php echo $story->username; ?>
                            </a>
                            <div class="storyDetails">
                                <div class="storyData">
                                    <?php echo $story->story_count ? "</span><span class='storyCount'>{$story->story_count} stories</span>" : ""; ?>
                                    <!-- <span class="dot"></span> -->
                                    <span class="storyTime"><?php echo $date_obj->dateDiffStr($story->created_at); ?></span>
                                </div>
                            </div>
                            <a class="storyLink" href="./index.php?story=<?php echo $story->id; ?>" style="display:none;"></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="main">
            <?php if ($main_story) : ?>
                <?php $user = $user_obj->get_user_data($main_story->username); ?>
                <div class="storyPreviewContainer">

                    <div data-main-story="<?php echo $main_story_data; ?>" class="storyPreview">
                        <?php if ($main_story->image) : ?>
                            <img src="./story_uploads/<?php echo $main_story->image; ?>" alt="story Image" class="storyPreviewImg">
                        <?php endif; ?>
                        <?php if ($main_story->has_media) : ?>
                            <video src="./story_uploads/<?php echo $main_story->media; ?>" autoplay="true" class="storyPreviewVideo"></video>
                        <?php endif; ?>
                        <?php if ($main_story->description) : ?>
                            <div class="<?php echo (!$main_story->image && !$main_story->has_media) ? 'centered' : ""; ?> storyDesc"><?php echo $main_story->description; ?></div>
                        <?php endif; ?>
                        <div class="storyPreviewControls">
                            <div class="storyPreviewProgressBars">
                                <?php foreach ($user_stories as $i => $user_story) : ?>
                                    <?php
                                    $active = $user_story->id === $main_story->id ? "active" : "";
                                    $viewed = $user_story->viewedBy($me->username) ? "viewed" : "";
                                    $done = $user_story->id < $main_story->id ? "done" : "";
                                    ?>
                                    <!-- <a href="./index.php?story={$user_story->id}"> -->
                                    <a href="./index.php?story=<?php echo $user_story->id; ?>" style="width: <?php echo (100 / count($user_stories)); ?>%" class="<?php echo " $active $done $viewed"; ?> storyPreviewProgressContainer">
                                        <div class="storyPreviewProgress"></div>
                                    </a>
                                    <!-- </a> -->
                                <?php endforeach; ?>
                            </div>

                            <div class="storyPreviewUser">
                                <div class="storyPreviewUserImg">
                                    <img src="../images/<?php echo $user->profile_pic; ?>" alt="user image">
                                </div>
                                <div class="storyPreviewUserInfo">
                                    <a href="#" class="storyPreviewUserName"><?php echo $main_story->username; ?></a>
                                    <span class="storyPreviewTime"><?php echo $date_obj->dateDiffStr($main_story->created_at); ?></span>
                                    <span class="storyPreviewViews"><?php echo $main_story->views; ?> view(s)</span>
                                </div>
                            </div>
                            <?php if ($main_story->has_media) : ?>
                                <div class="storyPreviewMediaControls">
                                    <span data-play-icon class="storyPreviewMediaControlIcon">
                                        <img src="../images/play.png" alt="play icon">
                                    </span>
                                    <span data-pause-icon class="hide storyPreviewMediaControlIcon">
                                        <img src="../images/pause.png" alt="pause icon">
                                    </span>
                                    <span data-volume-icon class="storyPreviewMediaControlIcon">
                                        <img src="../images/volume_off.png" alt="volume icon">
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($prev_story) : ?>
                        <a href="./index.php?story=<?php echo $prev_story->id; ?>" class="storyPreviewPrevButton btn">Prev</a>
                    <?php endif; ?>
                    <?php if ($next_story) : ?>
                        <a href="./index.php?story=<?php echo $next_story->id; ?>" class="storyPreviewNextButton btn">Next</a>
                    <?php endif; ?>
                    <form class="storyPreviewReply" action="./story_reply.php" method="post">
                        <?php if ($main_story?->username !== $me->username) :  ?>
                            <input type="hidden" name="sender" value="<?php echo $me->username; ?>">
                            <input type="hidden" name="story_id" value="<?php echo $main_story->id; ?>">
                            <input required placeholder="reply..." type="text" name="reply" class="storyPreviewReplyInput">
                            <button class="storyPreviewReplyBtn">Reply</button>
                        <?php endif; ?>
                    </form>
                </div>
            <?php else : ?>
                <div class="centerText">
                    <h2 class="header">Story preview</h2>
                    <p>Select story to preview</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="./js/story.js" defer></script>
</body>

</html>
