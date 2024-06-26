<?php
require_once '../app/Model/User.php';
require_once '../app/Model/Student.php';
require_once '../app/Model/Teacher.php';
require_once '../app/Model/Admin.php';
require_once '../app/Model/Center.php';


class UserController {
    private $db;
    private $conn;  

    public function __construct() {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function add($num,$num1)
    {
        return $num+$num1;
    }
    public static function login($email, $pass,$conn)
    {
     
       $sql = "SELECT * FROM user_acc WHERE email='$email' AND pass='$pass'";

       $result = mysqli_query($conn, $sql);
       if ($row = mysqli_fetch_array($result)) {		
           // if (password_verify($pass, $row['pass'])){
           $user = new User($row['uid']);
           $user->email = $row['email'];
           $user->image = $row['image'];
   
           $user->usertype = new Usertype($row['usertype_id']);
           if ($user->usertype->utid == "4") {
               $studentInfoSql = "SELECT * FROM student WHERE uid = " . $row['uid'];
               $studentInfoResult = mysqli_query($conn, $studentInfoSql);
   
               if ($studentRow = mysqli_fetch_array($studentInfoResult)) {
                   $student = new Student($row['uid']);
                   $student->sid = $studentRow['sid'];
                   $student->firstname = $studentRow['firstname'];
                   $student->lastname = $studentRow['lastname'];
                   $student->number = $studentRow['number'];
                   $student->number = $studentRow['number'];
                   $student->image = $user->image;
                   $student->uid = $user->id;
   
   
   
                   
               }
               
               return $student; 
               
           } elseif ($user->usertype->utid=="2") {
               $teacherInfoSql = "SELECT * FROM teacher WHERE uid = " . $row['uid'];
               $teacherInfoResult = mysqli_query($conn, $teacherInfoSql);
   
               if ($teacherRow = mysqli_fetch_array($teacherInfoResult)) {
                   $teacher = new Teacher($row['uid']);
                   $teacher->teacherId = $teacherRow['tid'];
                   $teacher->firstname = $teacherRow['firstname'];
                   $teacher->lastname = $teacherRow['lastname'];
                   $teacher->number = $teacherRow['number'];
                   $teacher->educ = $teacherRow['educ'];
                   $teacher->subject = $teacherRow['subject'];
                   $teacher->image = $user->image;
   
   
               }
   
               return $teacher; 
           }
           elseif ($user->usertype->utid=="1") {
               $adminInfoSql = "SELECT * FROM admin WHERE uid = " . $row['uid'];
               $adminInfoResult = mysqli_query($conn, $adminInfoSql);
           
               if ($adminRow = mysqli_fetch_array($adminInfoResult)) {
                   $admin = new Admin($row['uid']);
                   $admin->aid = $adminRow['aid'];
                   $admin->name = $adminRow['name'];
                   
               }
               
               return $admin; 
           }
   
           elseif ($user->usertype->utid=="3") {
               $centerInfoSql = "SELECT * FROM center WHERE uid = " . $row['uid'];
               $centerInfoResult = mysqli_query($conn, $centerInfoSql);
   
               if ($centerRow = mysqli_fetch_array($centerInfoResult)) {
                   $center = new Center($row['uid']);
                   $center->Cid = $centerRow['Cid'];
                   $center->cname = $centerRow['cname'];
                   $center->cloc = $centerRow['cloc'];
                   $center->cnumber = $centerRow['cnumber'];
               }
   
               return $center; 
           }
       // }
       }
       return NULL;
   
   }

    public static function signupUser($email, $pass, $usertype,$conn) {
        $sql = "INSERT INTO user_acc (email, pass, usertype_id) VALUES ('$email', '$pass', '$usertype')";
        if (mysqli_query($conn, $sql)) {
            return mysqli_insert_id($conn);
        } else {
            return false;
        }
    }

    public static function editUser($email, $id,$conn)
    {
        $sql = "UPDATE user_acc SET email='$email' WHERE uid=$id";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public static function deleteUser($id,$conn)
    {
        $sql = "DELETE FROM user_acc WHERE uid=$id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            return true;
        } else {
            echo "Error deleting from 'student': " . mysqli_error($conn);

            return false;
        }
    }
   
    
}
?>
