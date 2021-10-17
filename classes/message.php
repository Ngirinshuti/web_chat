<?php
/*MESSAGE OPERATIONS*/

// if (!class_exists('Story')) {
//     include "../stories/Story.php";
// }
class Message
{
    protected PDO $conn;
    protected $me;

    function __construct($db, $me)
    {
        $this->conn = $db;
        $this->me   = $me;
    }
    function get_all_unread()
    {
        try {
            $sql = "SELECT DISTINCT `sender` FROM messages WHERE `reciever` = ? AND `status` = 'unread'";
            $unread = $this->conn->prepare($sql);
            $unread->execute([$this->me]);

            if ($unread->rowCount() > 0) {
                return $unread->rowCount();
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function read_message($user)
    {
        try {
            $sql = "UPDATE messages SET status = 'read' WHERE sender = :sender AND reciever = :me";
            $read_msg = $this->conn->prepare($sql);
            $read_msg->bindParam(":sender", $user);
            $read_msg->bindParam(":me", $this->me);
            $read_msg->execute();
            if ($read_msg->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function i_sent_message($id)
    {
        $sql = "SELECT * FROM messages WHERE id = ? AND sender = ?";
        $check = $this->conn->prepare($sql);
        $check->execute([$id, $this->me]);
        if ($check->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get a single message
     *
     * @param integer $id message id
     * 
     * @return object
     */
    public function getMessage(int $id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `messages` WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    function get_unread($user)
    {
        try {
            $sql = "SELECT * FROM messages WHERE (sender = :user AND reciever = :me) AND status = 'unread'";
            $unread = $this->conn->prepare($sql);
            $unread->bindParam(":user", $user);
            $unread->bindParam(":me", $this->me);
            $unread->execute();
            if ($unread->rowCount() > 0) {
                return $unread->rowCount();
            } else {
                return "";
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function send_message($reciever, $message, $story_id = null)
    {
        try {
            if ($reciever == $this->me) {
                return ["Error" => "the sender can't  be reciever"];
                exit;
            }

            $sql = "INSERT INTO messages (id, sender, reciever, body, story_id) VALUES (?, ?, ?, ?, ?)";
            $send_msg = $this->conn->prepare($sql);
            $id = rand(10000, 3333999);
            $message = trim($message);
            $message = htmlspecialchars($message);
            $message = stripcslashes($message);

            if ($message == "") {
                return ["Error" => "Can't send empty message!"];
                exit;
            }

            $send_msg->execute([$id, $this->me, $reciever, $message, $story_id]);
            if ($send_msg->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function get_user_messages($user)
    {
        try {
            $sql = 'SELECT messages.*, users.profile_pic, users.status FROM messages JOIN users ON messages.sender = users.username WHERE reciever = ? AND sender = ? ORDER BY date_ DESC';

            $getMessage = $this->conn->prepare($sql);
            $getMessage->execute([$this->me, $user]);

            if ($getMessage->rowCount() > 0) {
                return $getMessage->fetchAll(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function get_recent_messages($limit)
    {
        try {
            $sql = "SELECT messages.*, users.profile_pic, users.status FROM messages JOIN users ON messages.sender = users.username WHERE reciever = ? ORDER BY date_ DESC LIMIT ?";

            $getMessages = $this->conn->prepare($sql);
            $getMessages->execute([$this->me, $limit]);

            if ($getMessages->rowCount() > 0) {
                return $getMessages->fetchAll(PDO::FETCH_OBJ);
            } else {
                return array('infor' => "No messages yet");
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function get_all_messages()
    {
        try {
            $sql = "SELECT messages.*, users.profile_pic, users.status FROM messages JOIN users ON messages.sender = users.username WHERE reciever = ? OR sender = ? ORDER BY date_ DESC";

            $getMessages = $this->conn->prepare($sql);
            $getMessages->execute([$this->me, $this->me]);

            if ($getMessages->rowCount() > 0) {
                return $getMessages->fetchAll(PDO::FETCH_OBJ);
            } else {
                return array('infor' => "No messages yet");
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function get_messages($user, $bool)
    {
        try {
            $sql = "SELECT messages.*, users.profile_pic FROM messages JOIN users ON messages.sender = users.username WHERE (sender = :me AND reciever = :user) OR (sender = :user AND reciever = :me) ORDER BY date_ ASC";
            $get_msg = $this->conn->prepare($sql);
            $get_msg->bindParam(":me", $this->me);
            $get_msg->bindParam(":user", $user);
            $get_msg->execute();

            if ($get_msg->rowCount() > 0 && $bool) {
                $messages = $get_msg->fetchAll(PDO::FETCH_OBJ);
                return $messages;
            } elseif ($bool && $get_msg->rowCount() == 0) {
                return  array('infor' => "You have no conversations yet");
            } else {
                return $get_msg->rowCount();
            }
        } catch (PDOException $e) {
            return ["Error" => $e->getMessage()];
        }
    }

    function delete_message($id)
    {
        try {
            $sql = "DELETE FROM messages WHERE id = ?";
            $dlt_msg = $this->conn->prepare($sql);
            $dlt_msg->execute([$id]);
            if ($dlt_msg->rowCount() > 0) {
                return ["Success" => "Message Deleted"];
            } else {
                return ["Error" => "Some thing went wrong !"];
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get story related to a message
     *
     * @param integer $id story id
     * 
     * @return object
     */
    function getStory(int $id)
    {
        $stmt = $this->conn->prepare(
            "SELECT * from `stories` WHERE `stories`.`id` = ?"
        );

        $stmt->execute([$id]);

        return  $stmt->fetch(PDO::FETCH_OBJ);
    }
}
