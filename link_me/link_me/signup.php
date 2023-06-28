
<?php 
session_start();
//------ PHP code for User registration form---
$error = "";
if (array_key_exists("signUp", $_POST)) {
 
     // Database Link
    include('db_connect.php');  
 
    //Taking HTML Form Data from User
    $username = mysqli_real_escape_string($db_connect, $_POST['username']);
    $email = mysqli_real_escape_string($db_connect, $_POST['email']);
    $password = mysqli_real_escape_string($db_connect,  $_POST['password']); 
    $cpassword = mysqli_real_escape_string($db_connect,  $_POST['cpassword']); 


    // PHP form validation PHP code
    if (!$username) {
      $error .= "Name is required <br>";
     }
    if (!$email) {
        $error .= "Email is required <br>";
     }
    if (!$password) {
        $error .= "Password is required <br>";
     } 
     if ($password !== $cpassword) {
        $error .= "Password does not match <br>";
     }
     if ($error) {
        $error = "<b>There were error(s) in your form!</b> <br>".$error;
     }  else {
       
        //Check if email is already exist in the Database
 
        $query = "SELECT id FROM users WHERE email = '$email'";
        $result = mysqli_query($db_connect, $query);
        if (mysqli_num_rows($result) > 0) {
            $error .="<p>Your email has taken already!</p>";
        } else {
 
            //Password encryption or Password Hashing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
             
            if (!mysqli_query($db_connect, $query)){
                $error ="<p>Could not sign you up - please try again.</p>";
                } else {
 
                    //session variables to keep user logged in
                $_SESSION['id'] = mysqli_insert_id($db_connect);  
                $_SESSION['name'] = $username;
 
                //Setcookie function to keep user logged in for long time
                if ($_POST['stayLoggedIn'] == '1') {
                setcookie('id', mysqli_insert_id($db_connect), time() + 60*60*365);
                //echo "<p>The cookie id is :". $_COOKIE['id']."</P>";
                }
                  
                //Redirecting user to home page after successfully logged in 
                header("Location: linkme.php");  
             
                }
             
            }
 
        }  
    }
 ?>
 
 

<?php
	
$showAlert = false;
$showError = false;
$exists=false;
	
if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Include file which makes the
	// Database Connection.
	include 'db_connect.php';
	$uname =$_Post["uname"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];
			
	
	$sql = "Select * from users where username='$email'";
	
	$result = mysqli_query($conn, $sql);
	
	$num = mysqli_num_rows($result);
	
	// This sql query is use to check if
	// the Email is already present
	// or not in our Database
	if($num == 0) {
		if(($password == $cpassword) && $exists==false) {
	
			$hash = password_hash($password,
								PASSWORD_DEFAULT);
				
			// Password Hashing is used here.
			$sql = "INSERT INTO `users` ( `email`,
				`password`,) VALUES ('$email',
				'$hash')";
	
			$result = mysqli_query($conn, $sql);
	
			if ($result) {
				$showAlert = true;
			}
		}
		else {
			$showError = "Passwords do not match";
		}	
	}// end if
	
if($num>0)
{
	$exists="Email already Exists";
}
	
}//end if
	
?>



<DOCTYPE.html>
<html>
<title>Sign up</title>
<head>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> 
<style>
body {
  background-image: url("https://source.unsplash.com/720x600/?community,lbtq,rainbow heart");
}
</style>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<form action="server.php" method="post">
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
    <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
      <h1 class="title-font font-large text-3xl text-gray-900">
	  <font size= 100px>
	  <div class="rainbow-text" style="text-align: left;">
	<span class="block-line"><span><span style="color:#ff0000;">L</span><span style="color:#ff3c00;">i</span><span style="color:#ff7300;">n</span><span style="color:#ffaa00;">k</span></span><span><span style="color:#ffe500;">M</span><span style="color:#e1ff00;">E</span></span></span>
</div></font></h1>


      <p class="leading-relaxed mt-4">The Place where is no any barier and We all are same and here for each other and to tell them ,they are not alone.</p>
    </div>
	
	<form action="login.php" method="Post">
    <div class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
      <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Sign Up</h2>
      <div class="relative mb-4">
        <label for="full-name" class="leading-7 text-sm text-gray-600">Full Name</label>
        <input type="text" id="full-name" name="full name" class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"

		placeholder="Full Name">
		
      </div>
      <div class="relative mb-4">
        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
        <input type="email" id="email" name="email" class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"

		placeholder="Email">
      </div>
	  
	 
		  
		  <!-- password input -->
          <div class="mb-6">
		  <label for="Password" class="leading-7 text-sm text-gray-600">Password</label>
            <input
              type="password"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="password"
			  name="pwd" 
              placeholder="Password"
            />
          </div>
		  <!--confirm Password input -->
          <div class="mb-6">
		  <label for="Confirm Password" class="leading-7 text-sm text-gray-600">Confirm Password</label>
            <input
              type="confirm password"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="confirm_password"
			  name="confirm password" 
              placeholder="confirm Password"
            />
          </div>
		  
		  <p>Password must be of 6 characters and having no symbols.</p>
		  
		  
		  
      <button class="text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">Sign Up
        header
      </button>
	  <hr>
	  <br>
	  <p><b>Already have an Account?</b></p>
	  
	  <hr>
	  <br>
         <a href ="login.php"class="text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg" align = center><h3>"login"</h3></a>
      <p class="text-xs text-gray-500 mt-3">To be a part of Our Society do sign up for further updates and for better connection</p>
    </div>
  </div>
</section>

</form>
</body>
</html>
