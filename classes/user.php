<?php
class User
{
    protected $me;
    protected $db;

    function __construct($conn, $me)
    {
        $this->db = $conn;
        $this->me = $me;
    }

    function get_users($expression)
    {
        try {
            $sql  = "SELECT * FROM users WHERE $expression";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function user_exist($user)
    {
        $sql = "SELECT * FROM users WHERE username  = ?";
        $stmt  = $this->db->prepare($sql);
        $stmt->execute([$user]);
        if ($stmt->rowCount() === 1) {
            return true;
        } else {
            return false;
        }
    }

    function invalid_date($date)
    {
        return ["Error" => "date (" . $date . ") is not valid"];
        exit;
    }

    function register_user($fname, $lname, $email, $dob, $sex, $username, $password)
    {
        try {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
                return ["Error" => "Invalid email address"];
                exit;
            }

            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql1     = "SELECT username FROM users WHERE username = ?";
            $sql2     = "SELECT username FROM users WHERE email = ?";
            $stmt1    = $this->db->prepare($sql1);
            $stmt2    = $this->db->prepare($sql2);
            $stmt1->execute([$username]);
            $stmt2->execute([$email]);

            if ($stmt1->rowCount() > 0 && $stmt2->rowCount() > 0) {
                return ['Error' => 'Username <u>' . $username . '</u> and e-mail <u>' . $email . '</u> are both taken.'];
                exit;
            } elseif ($stmt1->rowCount() > 0 && $stmt2->rowCount() === 0) {
                return ['Error' => 'Username <u>' . $username . '</u> is unavailable.'];
                exit;
            } elseif ($stmt1->rowCount() === 0 && $stmt2->rowCount() > 0) {
                return ['Error' => 'e-mail <u>' . $email . '</u> was taken.'];
                exit;
            }

            $sql = "INSERT INTO users(fname, lname, email, dob, sex, username, password) VALUES(:fname, :lname, :email, :dob, :sex, :username, :password)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":fname", $fname);
            $stmt->bindParam(":lname", $lname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":dob", $dob);
            $stmt->bindParam(":sex", $sex);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return ['Success' => 'Account created successfully'];
            } else {
                return ['Error' => 'Account creation failed please try again!'];
            }
        } catch (PDOException $e) {
            return ['Error' => '<big>' . $e->getMessage() . '</big>'];
        }
    }

    function login_user($identifier, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :id OR username = :id";
            $login = $this->db->prepare($sql);
            $login->bindParam(":id", $identifier);
            $login->execute();

            if ($login->rowCount() === 1) {

                $row = $login->fetch(PDO::FETCH_OBJ);
                $match_pass = password_verify($password, $row->password);

                if ($match_pass) {
                    if ($row->status != "online") {
                        $sql1 = "UPDATE users SET status = 'online' WHERE email = :id OR username = :id";
                        $update = $this->db->prepare($sql1);
                        $update->bindParam(":id", $row->username);
                        $update->execute();

                        if ($update->rowCount() == 1) {
                            $_SESSION["a_user"] = $row->username;
                            return ["Success" => 1];
                        } else {
                            return ["Error" => "Please try again."];
                        }
                    } else {
                        $_SESSION["a_user"] = $row->username;
                        return ["Success" => 1];
                    }
                } else {
                    return ["Error" => "Incorrect e-mail address or Password!"];
                }
            } else {
                return ["Error" => "Incorrect e-mail address or Password!"];
            }
        } catch (PDOException $e) {
            return ["Error" => "Error: " . $e->getMessage()];
            exit;
        }
    }

    function get_all_users($bool)
    {
        try {
            $sql   = "SELECT profile_pic, username, lname, fname FROM users WHERE username != ?";
            $run_query = $this->db->prepare($sql);
            $run_query->execute([$this->me]);

            if ($run_query->rowCount() > 0 && $bool) {
                return $run_query->fetchAll(PDO::FETCH_OBJ);
            } else if (!$run_query->rowCount() && $bool) {
                return ["Error" => "We have problems getting users."];
            } else {
                return $run_query->rowCount();
            }
        } catch (PDOException $e) {
            return ["Error" => "DB_ERROR: <u><i><b>" . $e->getMessage() . "</b></i></u>"];
        }
    }

    function get_user_data($username)
    {
        try {
            $sql  = "SELECT * FROM users WHERE username = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$username]);

            if ($stmt->rowCount() == 1) {
                return $stmt->fetch(PDO::FETCH_OBJ);
            } else {
                return ["Error" => " User data not found."];
            }
        } catch (PDOException $e) {
            return ["Error" => "DB_ERROR: <u><i><b>" . $e->getMessage() . "</b></i></u>"];
        }
    }

    function update_property($property, $value)
    {
        $sql  = "UPDATE users SET $property = :value WHERE username = :user";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":value", $value);
        $stmt->bindParam(":user", $this->me);
        $stmt->execute();
        if ($stmt->rowCount() === 1) {
            return ["Success" => "Successfully updated <u>" . $property . ".</u>"];
        } else {
            return ["Error" => "Error upadating <u>" . $property . ".</u>"];
        }
    }
}