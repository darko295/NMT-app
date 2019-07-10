<?php
include(dirname(__FILE__) . "/../public/connection.php");

class prodavac
{

    function get_user($username,$password)
    {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT * FROM prodavac WHERE Username = ? AND Password = ?");
        $stmt->bind_param("ss", $username,$password);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) == 1) {
                return 1;
            } else {
                return 0;
            }
        } else {
            echo "Greska prilikom konektovanja sa bazom";
        }
        $mysqli->close();
    }

    function get_user_id($username)
    {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT * FROM prodavac WHERE Username = ?");
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) == 0) {
                exit();
            } else {
                return $result;
            }
        } else {
            echo "Greska prilikom konektovanja sa bazom";
        }
        $mysqli->close();
    }

    public function login($username, $password)
    {
        //if (!$this->isValidUsername($username)) return false;
        if (strlen($password) < 5) return false;
        $exist = $this->get_user($username,$password);

        if($exist === 1) {
        if (!$this->setToActive($username)) return false;
            return true;
        }
        return false;

    }

    public function logout($username)
    {
        $this->setToInactive($username);
        session_destroy();
        header("Location: ../login_page.php");
    }

    public function setToActive($username)
    {
        global $mysqli;
        $sql = "UPDATE prodavac SET Active = '1'  WHERE Username = '" . $username . "'";
        if($mysqli->query($sql)){
            if ($mysqli->affected_rows == 1) {
                return true;
            }
        }
        return false;
    }
    public function setToInactive($username)
    {
        global $mysqli;
        $upit = "UPDATE prodavac SET Active = '0' WHERE Username = '" . $username . "'";
        if ($mysqli->query($upit)) {
            if ($mysqli->affected_rows == 1) {
                return true;
            }
        }
        return false;
    }

}