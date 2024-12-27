<?php include("connection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Bloomify</title>
</head>
<body>
    <div class="container">
        <form action="#" method="POST">
        <div class="title">
            SIGN UP
       </div>
       <div class="form">
        <div class="input_field">
            <label>First Name</label>
            <input type="text" class="input" name="fname">
        </div>
       
        <div class="input_field">
            <label>Last Name</label>
            <input type="text" class="input" name="lname">
        </div>
     
      
        <div class="input_field">
            <label>Password</label>
            <input type="password" class="input" name="pw">
        </div>
       
        <div class="input_field">
            <label>Confirm Password</label>
            <input type="password" class="input" name="conpw">
        </div>
      
        <div class="input_field">
            <label>Gender</label>
            <div class="custom_select">
          <select name="gender">
          <option value="not selected">Select</option>
          <option value="female" >Female</option>
          <option value="male">Male</option>
          <option value="other">Other</option>
</select>
</div>
        </div>
       
       
        <div class="input_field">
            <label>Email</label>
            <input type="text" class="input" name="email">
        </div>
      
        <div class="input_field">
            <label>Phone</label>
            <input type="text" class="input" name="phone">
        </div>
       
        <div class="input_field">
            <label>Address</label>
            <textarea class="textarea" name="address"></textarea>
        </div>
        
        <div class="input_field terms">
            <label class="check">
            <input type="checkbox" >
            <span class="checkmark"></span>
            
    </label>  
        <p> I Agree to terms and conditions</p>
        </div>
        <div class="input_field">
            <input type="submit" value="Register" class="btn" name="register">
</div>
</form>
</div>
       
    </div>
</body>
</html>

<?php
 if($_POST['register'])
 {
   $fname  = $_POST['fname'];
   $lname      = $_POST['lname'];
   $pw         = $_POST['pw'];
   $conpw      = $_POST['conpw'];
   $gender     = $_POST['gender'];
   $email      = $_POST['email'];
   $phone      = $_POST['phone'];
   $address    = $_POST['address'];
    
   if($fname != "" && $lname !="" && $pw !="" && $conpw !="" && $gender !="" && $email !="" && $phone !="" && $address !="")
   {
   $query = "INSERT INTO FORM values('$fname','$lname','$pw','$conpw','$gender','$email','$phone','$address')";
   
   $data = mysqli_query($conn,$query);

   if($data)
   {
     echo "Data inserted into Database";
   }
   else
   {
     echo "Failed";
   }
}
   else {
   echo "Please fill the form";
   }
}
?>
