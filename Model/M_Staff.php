<?php 
    include_once("E_Staff.php");
    
    class Model_Staff{
        public function __construct(){}
        public function getAllStaffs(){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");
            $sql = "SELECT * FROM nhanvien";
            $rs = mysqli_query($link, $sql);
            $staffs = array(); // Initialize the array to store staff objects
            $i = 0;
        
            $s = "NV0";
            while($row = mysqli_fetch_array($rs)){
                $id = $row['IDNV'];
                $name = $row['Hoten'];
                $idpb = $row['IDPB'];
                $diachi = $row['Diachi'];

                while(($s.$i )!= $id) {
                    $i++;
                    if($i >= 10) $s = "NV";
                }
                $staffs[$i++] = new Entity_Staff($id, $name, $idpb, $diachi);
            }
        
            return $staffs;
        }
        


        public function getAllIDStaff(){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");
            $sql = "select IDNV from nhanvien";
            $rs = mysqli_query($link, $sql);
            $idnvArray = array();

            if ($rs) {
                while ($row = mysqli_fetch_assoc($rs)) {
                    $idnvArray[] = $row['IDNV'];
                }
            }
            return $idnvArray;
        }

        public function insertStaff($idnv, $hoten, $idpb, $diachi){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");
            $IDPB_ = "";
            if($idpb < 10)  $IDPB_ = "PB0".$idpb;
            else $IDPB_ = "PB".$idpb;
            $sql = "INSERT INTO nhanvien (IDNV, Hoten, IDPB, Diachi) VALUES ('$idnv', '$hoten', '$IDPB_', '$diachi')";
            echo $sql;
            mysqli_query($link, $sql);
        }

        public function deleteInfoStaff($id){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");
            $sql = "DELETE from nhanvien WHERE IDNV = '$id'";
            mysqli_query($link, $sql);
        }

        public function searchInfoStaff($option, $searchText){
            $link = mysqli_connect("localhost:3307", "root", "") or die ("Khong the ket noi den CSDL MySQL");
            mysqli_select_db($link, "dulieu");

            if ($option === 'IDNV') {
                $query = "SELECT * FROM nhanvien WHERE IDNV LIKE '%$searchText%'";
            } else if ($option === 'Họ tên') {
                $query = "SELECT * FROM nhanvien WHERE Hoten LIKE '%$searchText%'";
            } else if ($option === 'Địa chỉ') {
                $query = "SELECT * FROM nhanvien WHERE Diachi LIKE '%$searchText%'";
            }
            $searchResults = mysqli_query($link, $query);

            return $searchResults;
        }
    }
?>