<?php
class AuthModel extends Model {
    private $linkDb;

    public function __construct($linkDb) {
    	$this->linkDb = $linkDb;
    }
    
    public function getData() {
        return [];
    }
    public function login($email, $password) {
        $result['isAuth'] = 0;

        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $sql = "SELECT users.name, users.email, users.phone, users.role AS 'roleId', roles.name as 'roleName'".
                "FROM users ".
                "JOIN roles ON roles.id = users.role ".
                "WHERE users.email = '". $this->linkDb->real_escape_string($email) ."' AND ". 
                    "users.password = '". $this->linkDb->real_escape_string($password) ."'";

        $users = $this->linkDb->query($sql);
        
        if ($users->num_rows == 1) {
            $row = $users->fetch_assoc();
            
            $_SESSION['isAuth'] = $result['isAuth'] = 1;
            $_SESSION['name'] = $result['name'] = $row['name'];
            $_SESSION['email'] = $result['email'] = $row['email'];
            $_SESSION['roleId'] = $row['roleId'];
            $result['roleName'] = $row['roleName'];
        }

        return $result;
	}
}
