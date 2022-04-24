<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
 
//Code for student ID
$count_my_page = ("studentid.txt");
$hits = file($count_my_page);
$hits[0] ++;
$fp = fopen($count_my_page , "w");
fputs($fp , "$hits[0]");
fclose($fp); 
$StudentId= $hits[0];   
$fname=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];
$email=$_POST['email']; 
$password=md5($_POST['password']); 
$status=1;

$Highets_School_level_Education=$_POST['Highets_School_level_Education'];
$Subjects=$_POST['Subjects'];
$School_Name=$_POST['School_Name'];
$College_Name=$_POST['College_Name'];
$Course_Name=$_POST['Course_Name'];
$Stream=$_POST['Stream'];
$Specialization=$_POST['Specialization'];
$Academic_Skills=$_POST['Academic_Skills'];
$Platforms=$_POST['Platforms'];
$Github_ID=$_POST['Github_ID'];
$Notes=$_POST['Notes'];




//$sql="INSERT INTO  tblstudents(StudentId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:StudentId,:fname,:mobileno,:email,:password,:status)";
$sql="INSERT INTO  tblstudents(StudentId,FullName,MobileNumber,EmailId,Password,Status,Highets_School_level_Education,Subjects,School_Name,College_Name,Course_Name,Stream,Specialization,Academic_Skills,Platforms,Github_ID,Notes) VALUES(:StudentId,:fname,:mobileno,:email,:password,:status,:Highets_School_level_Education,:Subjects,:School_Name,:College_Name,:Course_Name,:Stream,:Specialization,:Academic_Skills,:Platforms,:Github_ID,:Notes)";

$query = $dbh->prepare($sql);
$query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);

$query->bindParam(':Highets_School_level_Education',$Highets_School_level_Education,PDO::PARAM_STR);
$query->bindParam(':Subjects',$Subjects,PDO::PARAM_STR);
$query->bindParam(':School_Name',$School_Name,PDO::PARAM_STR);
$query->bindParam(':College_Name',$College_Name,PDO::PARAM_STR);
$query->bindParam(':Course_Name',$Course_Name,PDO::PARAM_STR);
$query->bindParam(':Stream',$Stream,PDO::PARAM_STR);
$query->bindParam(':Specialization',$Specialization,PDO::PARAM_STR);
$query->bindParam(':Academic_Skills',$Academic_Skills,PDO::PARAM_STR);
$query->bindParam(':Platforms',$Platforms,PDO::PARAM_STR);
$query->bindParam(':Github_ID',$Github_ID,PDO::PARAM_STR);
$query->bindParam(':Notes',$Notes,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script>alert("Your Registration successfull and your student id is  "+"'.$StudentId.'")</script>';
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}

}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>My Profile</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>    

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">User Signup</h4>
                
                            </div>

        </div>
             <div class="row">
           
<div class="col-md-9 col-md-offset-1">
               <div class="panel panel-danger">
                        <div class="panel-heading">
                           SINGUP FORM
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post" onSubmit="return valid();">
<div class="form-group">
<label>Enter Full Name</label>
<input class="form-control" type="text" name="fullanme" autocomplete="off" required />
</div>


<div class="form-group">
<label>Mobile Number :</label>
<input class="form-control" type="text" name="mobileno" maxlength="10" autocomplete="off" required />
</div>
                                        
<div class="form-group">
<label>Enter Email</label>
<input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()"  autocomplete="off" required  />
   <span id="user-availability-status" style="font-size:12px;"></span> 
</div>

<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Confirm Password </label>
<input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Highest Secondary Education :</label>
<input list="Highets_School_level_Education">
  <datalist id="Highets_School_level_Education">
    <option value="12th">
    <option value="10th">
  </datalist>
</input>
</div>

<!--
<div class="form-group">
<label>Highest Secondary Education :</label>
<input class="form-control" type="text" name="Highets_School_level_Education" maxlength="10" autocomplete="off" required />
</div>
-->

<div class="form-group">
<label>Subjects :</label>
<input class="form-control" type="text" name="Subjects" maxlength="10" autocomplete="off" required />
</div>

<div class="form-group">
<label>School Name :</label>
<input class="form-control" type="text" name="School_Name" maxlength="10" autocomplete="off" required />
</div>

<div class="form-group">
<label>College Name :</label>
<input class="form-control" type="text" name="College_Name" maxlength="10" autocomplete="off" required />
</div>


<div class="form-group">
<label>Course Name :</label>
<input class="form-control" type="text" name="Course_Name" maxlength="10" autocomplete="off" required />
</div>



<div class="form-group">
<label>Course Stream (Mchanical, Electrical Engineering, CSE...) :</label>
<input class="form-control" type="text" name="Stream" maxlength="10" autocomplete="off" required />
</div>

<div class="form-group">
<label>Specialization :</label>
<input class="form-control" type="text" name="Specialization" maxlength="10" autocomplete="off" required />
</div>


<div class="form-group">
<label>Academic Skills :</label>
<input class="form-control" type="text" name="Academic_Skills" maxlength="10" autocomplete="off" required />
</div>

<div class="form-group">
<label>Platforms :</label>
<input class="form-control" type="text" name="Platforms" maxlength="10" autocomplete="off" required />
</div>

<div class="form-group">
<label>Github_ID :</label>
<input class="form-control" type="text" name="Github_ID" maxlength="10" autocomplete="off" required />
</div>


<div class="form-group">
<label>Additional Notes :</label>
<input class="form-control" type="textarea" name="Notes" maxlength="10" height="50" autocomplete="off" required />
</div>

                             
<button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now </button>

                                    </form>
                            </div>
                        </div>
                            </div>
        </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
