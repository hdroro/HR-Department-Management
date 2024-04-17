<?php 
    include_once("../Model/M_Staff.php");
    include_once("../Model/M_Department.php");
    $mod = isset($_REQUEST['mod']) ? $_REQUEST['mod'] : null;
    
    class Ctrl_Department {
        public function showList() {
            $modelDepartment = new Model_Department();
            $departmentList = $modelDepartment->getAllDepartments();
            include_once("../View/DepartmentList.html");
        }

        public function insert() {
            $modelDepartment = new Model_Department();
            $departmentListID = $modelDepartment->getAllIDDepartments();
            include_once("../View/DepartmentInsert.html");
            if (isset($_POST["IDPB"], $_POST["TenPB"], $_POST["MotaPB"])) {
                $departmentList = new Model_Department($_POST["IDPB"], $_POST["TenPB"], $_POST["MotaPB"]);
                $departmentList->insertDepartment($_POST["IDPB"], $_POST["TenPB"], $_POST["MotaPB"]);
                header("Location: C_Department.php?mod=2");
            }
        }

        public function updateDetail(){
            if (isset($_POST["IDPB"], $_POST["Tenpb"], $_POST["Mota"])) {
                $departmentList = new Model_Department($_POST["IDPB"], $_POST["Tenpb"], $_POST["Mota"]);
                $departmentList->updateInfoDepartment($_POST["IDPB"], $_POST["Tenpb"], $_POST["Mota"]);
                header("Location: C_Department.php?mod=2");
            }
        }

        public function update(){
            $modelDepartment = new Model_Department();
            $departmentList = $modelDepartment->getAllDepartments();
            include_once("../View/DepartmentListUpdate.html");

            if (isset($_GET['IDPB'])) {
                $departmentInfo = $modelDepartment->getInfoDepartment($_GET['IDPB']);
                include_once("../View/DepartmentUpdateDetail.html");
            }
        }

        public function getAllID(){
            $modelDepartment = new Model_Department();
            $idDepartments = $modelDepartment->getAllIDDepartments();
            echo json_encode($idDepartments);
        }
    }

    $C_Department = new Ctrl_Department();
    
    if ($mod == 2) {
        $C_Department->showList();
    } 
    else if($mod == 5){
        $C_Department->insert();
    }
    else if($mod == 7){
        $C_Department->update();
        $C_Department->updateDetail();
    }
    else{
        $C_Department->getAllID();
    }
?>