<?php
//include database connection
include('dbconnect.php');



//check to see if the connection was successful
if(!$db){
	echo "<h2> Sorry, we cannot process your request at this time. Please try
	again later. </h2><br />\n";
	echo "<a href=\"index.php\">Try again</a><br />\n";
	echo "<a href=\"index.php\">Home</a><br />\n";
	exit; 

}

//check for form submission	
if($_SERVER['REQUEST_METHOD']=='POST'){

//////////////////////////validation/////////////////////////////  
    
//	//minimal validation
//if(isset($_POST['email'], $_POST['password'],$_POST['firstName'],
//$_POST['lastName'], $_POST['phone'], $_POST['address'], $_POST['city'], $_POST['state'],
//$_POST['zipCode'])){
//
    
    if(isset($_POST['password'])){
        
		//Declare variables
	$id= trim($_POST['id']);
    $username= trim($_POST['username']);    
	$email= trim($_POST['email']);
	$password= trim($_POST['password']);
	$password2= trim($_POST['password2']);
	$tablename = 'users';
	$role = 'U';
    
    //check if first name was entered into the form
		$nameFormat = "/^[A-Za-z0-9 ]*$/";
			//$nameFormat = "/^\w+([\.- ]?\w+)*$/";
			if($username == ''){
		
			echo "<h4>You must enter a username.</h4><br />\n";
			$baduser = 1;
			}
		else if(!preg_match($nameFormat, $username)){
			echo "<h4> You must enter a valid name.</h4><br />\n";
			$baduser = 1;
			}
        
        //check if email was entered into the form
			$emailFormat = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
			if($email == ''){
		
			echo "<h4> You must enter your Email Address.</h4><br />\n";
			$baduser = 1;
			}
		else if(!preg_match($emailFormat, $email)){
			echo "<h4> You must enter a valid email address (ie. xyz@xyz.com).</h4><br />\n";
			$baduser = 1;
			}    
        
        
        
        
    //check if password was entered into the form
		if($password == ''){
		
			echo "<h4> You must enter a Password.</h4><br />\n";
			$baduser = 1;
			}	
			



 		//check to see if there was any bad data
			if($baduser==0){
		
				//See if the user already exists in the database
				//Use a Select query to find out if the user exists
				$query = "SELECT email from $tablename WHERE email ='$email';";
				$result = mysqli_query($db, $query);
				$row = mysqli_fetch_array($result, MYSQL_ASSOC);
				if($row['email']== $email){
				
					echo "<h2> Sorry, but this E-Mail is already taken. Please try
					again later. </h2><br />\n";
					echo "<a href=\"registration.php\">Try again</a><br />\n";
					echo "<a href=\"../index.php?\">Home</a><br />\n";
					$baduser = 1;
					exit; 
				}
			}       
        
        
        
 //if valid user information insert into the database table
			if($baduser == 0){
$query= "INSERT INTO $tablename VALUES ('','$username','$email', SHA1('$password'),'$role');";
			//echo ($query); //debugging technique
			$result = mysqli_query($db, $query);
			if($result) {
			
				//Create a session for the logged in user
				//Set a session variable
                $_SESSION['username'] = $username;
				$_SESSION['email'] = $email;
				$_SESSION['role'] = $role;
			
			
					echo "<h2> Your registration was successful. Welcome to the Pint Club! </h2><br />\n";
					//echo "<a href=\"index.php?content=register\">Home</a><br />\n";
					//Redirect back to index/login
					echo "<META HTTP-EQUIV=\"Refresh\" Content=\"2; URL=../index.php\">";			
					exit;
					}
			else{
					echo "<h2> Sorry,there was a problem processing your request. Can't drink a Pint yet! </h2><br />\n";
					echo "<a href=\"../index.php?#register\">Try again</a><br />\n";
					echo "<a href=\"../index.php\">Home</a><br />\n";
					exit;
			}
			
		}//end if
		
		
		
	}//end minimal validation		
} //end if request_method		





?>    
    
    
    
    
    
    
    

<!--
//	
////check if first name was entered into the form
//		$nameFormat = "/^[A-Za-z0-9 ]*$/";
//			//$nameFormat = "/^\w+([\.- ]?\w+)*$/";
//			if($firstName == ''){
//		
//			echo "<h4>You must enter your First Name.</h4><br />\n";
//			$baduser = 1;
//			}
//		else if(!preg_match($nameFormat, $firstName)){
//			echo "<h4> You must enter a valid name.</h4><br />\n";
//			$baduser = 1;
//			}
////check if last name was entered into the form
//		$nameFormat = "/^[A-Za-z0-9 ]*$/";
//			if($lastName == ''){
//		
//			echo "<h4> You must enter your Last Name.</h4><br />\n";
//			$baduser = 1;
//			}
//		else if(!preg_match($nameFormat, $lastName)){
//			echo "<h4> You must enter a valid name.</h4><br />\n";
//			$baduser = 1;
//			}
////check if password was entered into the form
//		if($password == ''){
//		
//			echo "<h4> You must enter a Password.</h4><br />\n";
//			$baduser = 1;
//			}	
//			
////check if password2 was entered into the form
//			if($password2 == ''){
//		
//			echo "<h4> You must re-enter your Password Correctly.</h4><br />\n";
//			$baduser = 1;
//			}
//				
////check password and confirm password match
//		if($password != $password2){
//		
//			echo "<h4> Your passwords must match.</h4><br />\n";
//			$baduser = 1;
//			}
-->
<!--
//		
////check if email was entered into the form
//			$emailFormat = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
//			if($email == ''){
//		
//			echo "<h4> You must enter your Email Address.</h4><br />\n";
//			$baduser = 1;
//			}
//		else if(!preg_match($emailFormat, $email)){
//			echo "<h4> You must enter a valid email address (ie. xyz@xyz.com).</h4><br />\n";
//			$baduser = 1;
//			}
//		
////phone
//			if($phone == ''){
//		
//			echo "<h4> You must enter your Phone Number.</h4><br />\n";
//			$baduser = 1;
//			}
//		
////address
//			if($address == ''){
//		
//			echo "<h4> You must enter your Address.</h4><br />\n";
//			$baduser = 1;
//			}
//		
////city	
//			if($city == ''){
//		
//			echo "<h4> You must enter your City.</h4><br />\n";
//			$baduser = 1;
//			}
//			
////zipcode
//				if($zipCode == ''){
//		
//			echo "<h4> You must enter your Zip Code.</h4><br />\n";
//			$baduser = 1;
//			}
//			
////state
//				if($state == ''){
//		
//			echo "<h4> You must select your State.</h4><br />\n";
//			$baduser = 1;
//			}
//			
//			
//		
//		
//		//check to see if there was any bad data
//			if($baduser==0){
//		
//				//See if the user already exists in the database
//				//Use a Select query to find out if the user exists
//				$query = "SELECT email from $tablename WHERE email ='$email';";
//				$result = mysqli_query($db, $query);
//				$row = mysqli_fetch_array($result, MYSQL_ASSOC);
//				if($row['email']== $email){
//				
//					echo "<h2> Sorry, but this E-Mail is already taken. Please try
//					again later. </h2><br />\n";
//					echo "<a href=\"registration.php\">Try again</a><br />\n";
//					echo "<a href=\"../index.php?\">Home</a><br />\n";
//					$baduser = 1;
//					exit; 
//				}
//			}
		
		
-->
