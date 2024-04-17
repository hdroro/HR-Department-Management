<?php 
    include_once("E_Admin.php");
    
    class Model_Admin{
        public function __construct(){}
        public function checkUser($username, $password){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");
            $sql = "SELECT * FROM admin where username = '$username' and password = '$password'";
            $rs = mysqli_query($link, $sql);
            
            if ($rs->num_rows === 1) {
                return true;
            } else {
                return false;
            }

        }
    }
?>