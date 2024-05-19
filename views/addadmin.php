<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..\public\css/addadmin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
</head>
<body>
<?php
include_once '..\includes\navbar.php';
?>

<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100" >
      <div class="row d-flex justify-content-center align-items-center h-100" >
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
          <div class="card-body p-5" style="height: 21cm;">

              <div class="choose">
             <div class="nav"> 
            
             </div>
              
              </div>
              <h2 class="text-uppercase text-center mb-5">Add Admin</h2>
<br><br><br>
              <form  class="mar" name="f1" onsubmit="return validateForm()" method="post">
            

                <div class="form-outline mb-4" style=" margin-top: -100px;">
                  <input type="text" id="fname" name="firstname" class="form-control form-control-lg" /> 
                  <label class="form-label" for="fname">Name</label>  
                </div>

                

                <div class="form-outline mb-4">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" />
                  <label class="form-label" for="email">Email</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="pass" name="pass" class="form-control form-control-lg" />
                  <label class="form-label" for="pass">Password</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="confpass" class="form-control form-control-lg" />
                  <label class="form-label" for="confpass">Confirm password</label>
                </div>
                <!-- <div class="form-outline mb-4">
                  <input type="radio" name="type" id="type" value="teacher"/>
                  <class="form-label" for="userType">Teacher</label><br>
                  <input type="radio" name="type" id="type" value="student" />
                  <label class="form-label" for="userType">Student</label>
                </div> -->
                <button type="submit" class="btn btn-success btn-block btn-lg " style="color: black;">Save</button>
                </div>
            

               
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
      function validateForm() {
  var firstName = document.forms["f1"]["fname"].value;
  var lastName = document.forms["f1"]["lname"].value;
  var email = document.forms["f1"]["email"].value;
  var password = document.forms["f1"]["pass"].value;
  var confirmPassword = document.forms["f1"]["confpass"].value;
  var radioButtons = document.forms["f1"]["userType"];

  if (firstName == "") {
    alert("First name must be filled out");
    return false;
  }

  if (lastName == "") {
    alert("Last name must be filled out");
    return false;
  }

  if (email == "") {
    alert("Email must be filled out");
    return false;
  }

  if (password == "") {
    alert("Password must be filled out");
    return false;
  }

  if (confirmPassword == "") {
    alert("Confirm password must be filled out");
    return false;
  }

  if (password !== confirmPassword) {
    alert("Passwords do not match");
    return false;
  }

  var isChecked = false;
  for (var i = 0; i < radioButtons.length; i++) {
    if (radioButtons[i].checked) {
      isChecked = true;
      break;
    }
  }

  if (!isChecked) {
    alert("Please select a User Type");
    return false;
  }


}
    </script>
    <?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $db = Database::getInstance();
	$conn = $db->getConnection();	
   $firstname = htmlspecialchars($_POST["firstname"]);
  // $lastname = htmlspecialchars($_POST["lastname"]);
  $email = htmlspecialchars($_POST["email"]);

    $pass = htmlspecialchars($_POST["pass"]);
    // $type = htmlspecialchars($_POST["type"]);
   
      $sql_user_acc = "INSERT INTO user_acc (email, pass, usertype_id,image) VALUES ('$email', '$pass', 1,'')";
    
   
    // else if($type=='center')
    // {
    //   $sql_user_acc = "INSERT INTO user_acc (email, pass, usertype_id) VALUES ('$email', '$pass', 3)";
    // }
    

    $result_user_acc = mysqli_query($conn, $sql_user_acc);


    if ($result_user_acc) {
        $last_uid = mysqli_insert_id($conn);

     
            $sql_student = "INSERT INTO admin (name, uid) VALUES ('$firstname', $last_uid)";
            $result_student = mysqli_query($conn, $sql_student);

           
          }
    //     } elseif ($type == 'teacher') {
    //         // Insert into teacher table
    //         $sql_teacher = "INSERT INTO teacher (firstname, lastname, uid) VALUES ('$firstname', '$lastname', $last_uid)";
    //         $result_teacher = mysqli_query($conn, $sql_teacher);

    //         if (!$result_teacher) {
    //             echo "Error inserting data into the teacher table: " . mysqli_error($conn);
    //         }
    //     } else {
    //     }
    // } else {
    //     echo "Error inserting data into the user_acc table: " . mysqli_error($conn);
    // }
    
}
?>

</body>
</html>