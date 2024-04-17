<?php 
    include_once("../Model/M_Admin.php");
    $mod = isset($_REQUEST['mod']) ? $_REQUEST['mod'] : null;
    
    class C_Admin {
        public function invoke() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            include_once("../View/Login.html");
            if(isset($_POST["username"], $_POST["password"])){
                $modelAdmin = new Model_Admin($_POST["username"],$_POST["password"]);
                $adminCheck = $modelAdmin->checkUser($_POST["username"],$_POST["password"]);

                if ($adminCheck == 1) {
                    session_regenerate_id(true);                    
                    $_SESSION['username'] = $_POST['username'];
                    header("Location: ../index.php");
                    exit(); 
                }
            }
        }

        public function destroy(){
            session_start();
            session_destroy();
            header("Location: ../index.php");
            exit(); 
        }
    }

    $C_Admin = new C_Admin();
    if($mod == 1){
        $C_Admin->destroy();
    } else {
        $C_Admin->invoke();
    }
    
?>