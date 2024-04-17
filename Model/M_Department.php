<?php 
    include_once("E_Department.php");
    
    class Model_Department{
        public function __construct(){}
        public function getAllDepartments(){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");
            $sql = "SELECT * FROM phongban";
            $rs = mysqli_query($link, $sql);
            $departments = array(); 
            $i = 0;
        
            $s = "PB0";
            while($row = mysqli_fetch_array($rs)){
                $id = $row['IDPB'];
                $tenpb = $row['Tenpb'];
                $mota = $row['Mota'];
        
                while(($s.$i ) != $id) {
                    $i++;
                    if($i >= 10) $s = "PB";
                }
        
                $departments[$i++] = new Entity_Department($id, $tenpb, $mota);
            }
        
            return $departments;
        }


        public function getAllIDDepartments(){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");
            $sql = "select IDPB from phongban";
            $rs = mysqli_query($link, $sql);
            $idpbArray = array();

            if ($rs) {
                while ($row = mysqli_fetch_assoc($rs)) {
                    $idpbArray[] = $row['IDPB'];
                }
            }
            return $idpbArray;
        }

        public function getInfoDepartment($idpb){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");
            $sql = "SELECT * FROM phongban where IDPB = '$idpb'";
            $rs = mysqli_query($link, $sql);
            $idpbArray = array();

            if (mysqli_num_rows($rs) > 0) {
                while ($row = mysqli_fetch_assoc($rs)) {
                    $idpbArray['IDPB'] = $row['IDPB'];
                    $idpbArray['Tenpb'] = $row['Tenpb'];
                    $idpbArray['Mota'] = $row['Mota'];
                }
            }
            mysqli_free_result($rs);
            return $idpbArray;
        }

        public function insertDepartment($idpb, $tenpb, $mota){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");
            $sql = "INSERT INTO phongban (IDPB, Tenpb, Mota) VALUES ('$idpb', '$tenpb', '$mota')";
            mysqli_query($link, $sql);
        }

        public function updateInfoDepartment($IDPB, $TenPB, $MotaPB){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");
            $sql = "UPDATE phongban SET TenPB = '$TenPB', Mota = '$MotaPB' WHERE IDPB = '$IDPB'";
            mysqli_query($link, $sql);
        }
    }
?>