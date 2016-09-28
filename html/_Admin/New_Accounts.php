<html>
<?php

require_once("../_Connection/connect.php");

$email = $_POST['email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$lvl_num = $_POST['lvl_num'];
$message;

//Retrieve Button Selected
if(email != "" && isset($_POST['retrieve']))
{
       $query = "SELECT * FROM PENDING_ACCOUNTS WHERE EMAIL = '$email'"; 
       $result = mysqli_query($connection,$query);

        if(mysqli_num_rows($result)<1)
        {
          $message="No results found for Email: '$email'";
        }
        else
        {
            $message= "Record found for Email: '$email'";   
            $array = mysqli_fetch_array($result);
            $first_name = $array['FIRST_NAME'];
            $last_name = $array['LAST_NAME'];
            $lvl_num = $array['LVL_NUM'];
        }
}
//Add Button Selected
if(isset($_POST['add']) && ($_POST['email']=="" || $_POST['first_name']=="" || $_POST['last_name'] ==""  || $_POST['lvl_num']=="" ))
{
    $message="There a data fields that are empty!";
}
else if(isset($_POST['add']) && ($_POST['email'] !=="" || $_POST['first_name'] !=="" || $_POST['last_name'] !==""  || $_POST['lvl_num'] !=="" ))
{
  $query = "INSERT INTO PENDING_ACCOUNTS VALUES ('$email', '$first_name','$last_name','$lvl_num')";
  
  $result = mysqli_query($connection,$query); 
    if($result != false)
    {
          $query = "SELECT * FROM PENDING_ACCOUNTS WHERE EMAIL = '$email'"; 
        
          $result = mysqli_query($connection,$query);
            if($result != "")
            {
                $array = mysqli_fetch_array($result);
            }
      $message="Record Inserted for Email: $email";
    }
	else
    {
        $message="There is already a record for that Email!";
    } 
}

//Delete Button Selected
if(isset($_POST['delete']) && $_POST['email'])
{
      	$query = "SELECT * FROM PENDING_ACCOUNTS WHERE EMAIL = '$email'"; 
        
        $result = mysqli_query($connection,$query);
            if($result != 0)
            {
                $array = mysqli_fetch_array($result);
            }
		if(mysqli_num_rows($result)<1){
		  $message="That Email does not exist!";	
		}
		else{
            
			$query = "DELETE FROM PENDING_ACCOUNTS WHERE EMAIL = '$email'";
            
	        $result = mysqli_query($connection,$query); 
			$message="Record for Email $email deleted";
		}
}

//Modify Button Selected
//if(isset($_POST['modify']) && ($_POST['customer_num']=="" || $_POST['customer_name']=="" || $_POST['street'] ==""  || $_POST['city']=="" || $_POST['state']=="" || $_POST['zipcode']=="" || $_POST['balance']=="" || $_POST['credit_limit']=="" || $_POST['rep_num']==""))
//{
//  $message = "You Must enter all the information!";
//}
//
//else if(isset($_POST['modify']) && $_POST['customer_num']!="" && $_POST['customer_name']!="" && $_POST['street'] !=""  && $_POST['city']!="" && $_POST['state']!="" && $_POST['zipcode']!="" && $_POST['balance']!="" && $_POST['credit_limit']!="" && $_POST['rep_num']!="")
//{
//    $customer_num=$_POST['customer_num'];
//    LOCK TABLES CUSTOMER;
//    $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'"; 
//    UNLOCK TABLES;
//          $result = mysql_query($query, $connection);
//            if($result != 0)
//            {
//                $array = mysql_fetch_array($result);
//            }
//  if($array['CUSTOMER_NAME']!="")
//  {
//    $query = "UPDATE CUSTOMER SET CUSTOMER_NAME='$customer_name', STREET='$street', CITY='$city', STATE='$state', ZIP='$zipcode', BALANCE='$balance', CREDIT_LIMIT='$credit_limit', REP_NUM='$rep_num' WHERE CUSTOMER_NUM='$customer_num'";
//    $result = mysql_query($query, $connection);
//     
//    LOCK TABLES CUSTOMER; 
//    $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'"; 
//      UNLOCK TABLES;
//          $result = mysql_query($query, $connection);
//            if($result != "")
//            {
//                $array = mysql_fetch_array($result);
//            }
//    $message="Modified Record for Customer Number: $customer_num successfully";
//   }
//  else{
//     $customer_name=""; 
//     $street=""; 
//     $city=""; 
//     $state=""; 
//     $zipcode=""; 
//     $balance="";
//     $credit_limit="";
//     $rep_num="";
//     $message = "Customer Number: $customer_num does not exist!";
//   }
//}
?>
	<head>
		<title>New Accounts</title>
	</head>
	<body>
        <br>
        <br>
        <br>
        <hr />
        <br>
        <br>

	<form method= "POST" action= "<?php echo $PHP_SELF?>">
        
        <table align="center">
            <tr><td>Email:</td><td align="center"><input name="email" value="<?php echo $email ?>" required/></td></tr>
            <tr><td>First_Name:</td><td align="center"><input name="first_name" value="<?php echo $first_name ?>" /></td></tr>
            <tr><td>Last_Name:</td><td align="center"><input name="last_name" value="<?php echo $last_name ?>" /></td></tr>
	    <tr><td>Lvl_Num:</td><td align="center"><input name="lvl_num" value="<?php echo $lvl_num ?>" /></td></tr>
        </table>
        
        <br>
        <br>
        <hr />
         <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve" name="retrieve"></td>
            <td colspan="2" align="center"><input type="submit"value="Add" name="add"></td>
            <td colspan="2" align="center"><input type="submit"  value="Delete" name="delete" onclick="return confirm('Are you sure you want to delete the entire record for Customer Number <?php echo "$customer_num";?>?')"/></td>
            <td colspan="2" align="center"><input type="submit"value="Modify" name="modify"></td>
        </table>

    
    </form>
	<h2 align="center"><a href="../admin_homepage.html">Go Back</a></h2>

<?php 
//Displays Current Table information at the bottom of the page

$query = "SELECT * FROM PENDING_ACCOUNTS WHERE EMAIL = '$email'";

$result = mysqli_query($connection,$query);
  if($result != "")
  {
    $array = mysqli_fetch_array($result);
  }
if($result != "" && $array['FIRST_NAME'] != "")
{
    echo " <div align=\"center\"> Record in Pending Accounts Table for Email: $email </div>";
    echo " <br/>";
    echo " <div align=\"center\">";
    echo " <table align=\"center\" border=\"5px\"> ";  
    echo " <tr>";
    echo " <td align=\"center\"width=\"150px\">Email</td>";
    echo " <td align=\"center\"width=\"150px\">First Name</td>";
    echo " <td align=\"center\"width=\"150px\">Last Name</td>";
    echo " <td align=\"center\"width=\"150px\">Lvl Num</td>";
    echo " </tr>"; 
    echo " <tr>";
    echo "<td align=\"center\">".$array[EMAIL]."</td>";
    echo "<td align=\"center\">".$array[FIRST_NAME]."</td>";
    echo "<td align=\"center\">".$array[LAST_NAME]."</td>";
    echo "<td align=\"center\">".$array[LVL_NUM]."</td>";
    echo "</tr>";
}
?>
</html>