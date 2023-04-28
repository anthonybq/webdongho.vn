<?php
class userModelad
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new userModelad();
        }

        return self::$instance;
    }

    public function getAll()
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM users";
        $result = $db->query($sql);
        return $result;
    }

    public function getById($id)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM users WHERE id='$id' AND status=1";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    public function getByUsername($fullName)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM users WHERE fullName='$fullName' AND status=1";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    public function changeStatus($id)
    {
        $db = DB::getInstance();
        $sql = "UPDATE users SET status = !status WHERE id='$id'";
        $result = $db->query($sql);
        return $result;
    }

    public function insert($data)
    {
        $db = DB::getInstance();
        $sql = "INSERT INTO users (fullName, password, email, status) VALUES ('$data[fullName]', '$data[password]', '$data[email]', 1)";
        $result = $db->query($sql);
        return $result;
    }

    public function check($fullName, $password)
    {
        $user = $this->getByUsername($fullName);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    public function delete($id)
    {
        $db = DB::getInstance();
        $sql = "DELETE FROM `users` WHERE id = " . $id . "";
        $result = mysqli_query($db->con, $sql);
        return $result;
        
    }
    
}
