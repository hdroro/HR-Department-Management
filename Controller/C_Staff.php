<?php 
    include_once("../Model/M_Staff.php");
    include_once("../Model/M_Department.php");
    $mod = isset($_REQUEST['mod']) ? $_REQUEST['mod'] : null;
    
    class Ctrl_Staff {
        public function showList() {
            $modelStaff = new Model_Staff();
            $staffList = $modelStaff->getAllStaffs();
            include_once("../View/StaffList.html");
        }

        public function insert() {
            $modelDepartment = new Model_Department();
            $departmentListID = $modelDepartment->getAllIDDepartments();
    
            include_once("../View/StaffInsert.html");
            if (isset($_POST["IDNV"], $_POST["Hoten"], $_POST["IDPB"], $_POST["Diachi"])) {
                $modelStaff = new Model_Staff($_POST["IDNV"], $_POST["Hoten"], $_POST["IDPB"], $_POST["Diachi"]);
                $modelStaff->insertStaff($_POST["IDNV"], $_POST["Hoten"], $_POST["IDPB"], $_POST["Diachi"]);
                header("Location: C_Staff.php?mod=1");
            }
        }

        public function getAllID(){
            $modelStaff = new Model_Staff();
            $idStaffs = $modelStaff->getAllIDStaff();
            echo json_encode($idStaffs);
        }


        public function delete(){
            $modelStaff = new Model_Staff();
            $staffList = $modelStaff->getAllStaffs();
            include_once("../View/DeleteStaff.html");

            if (isset($_POST['delete'])) {
                $delete_ids = $_POST['delete'];
                foreach ($delete_ids as $id) {
                    $modelStaff->deleteInfoStaff($id);
                }
        
                header("Location: C_Staff.php?mod=1");
            }
        }

        public function search(){
            include_once("../View/SearchStaff.html");
            if(isset($_POST["radionbtn"]) && isset($_POST["text"])){
                $modelStaff = new Model_Staff();
                $searchResults = $modelStaff->searchInfoStaff($_POST["radionbtn"], $_POST["text"]);
                include_once("../View/SearchResultsStaff.html");
            }
        }
    }

    $C_Staff = new Ctrl_Staff();
    
    if ($mod == 1) {
        $C_Staff->showList();
    } 
    else if($mod == 3){
        $C_Staff->search();
    }
    else if($mod == 4){
        $C_Staff->insert();
    }
    else if($mod == 6){
        $C_Staff->delete();
    }
    else{
        $C_Staff->getAllID();
    }
?>