<?php
require_once("../_Connection/connect.php");
$PageTitle="Customer Maintenance Page";
$title="Customer Maintenance Page";

$customer_num = $_POST['customer_num'];
$customer_name = $_POST['customer_name'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$balance = $_POST['balance'];
$credit_limit = $_POST['credit_limit'];
$rep_num = $_POST['rep_num'];
$message;

//Retrieve Button Selected
if(customer_num != "" && isset($_POST['retrieve']))
{
    $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'"; 
    $result = mysql_query($query, $connection);

        if(mysql_num_rows($result)<1)
        {
          $message="No results found for customer Num: '$customer_num'";
        }
        else
        {
            $message= "Record found for Customer Num: '$customer_num'";   
            $array = mysql_fetch_array($result);
            $customer_name = $array['CUSTOMER_NAME'];
            $street = $array['STREET'];
            $city = $array['CITY'];
            $state = $array['STATE'];
            $zipcode = $array['ZIP'];
            $balance = $array['BALANCE'];
            $credit_limit = $array['CREDIT_LIMIT'];
            $rep_num = $array['REP_NUM'];
        }
}


//Add Button Selected
if(isset($_POST['add']) && ($_POST['customer_num']=="" || $_POST['customer_name']=="" || $_POST['street'] ==""  || $_POST['city']=="" || $_POST['state']=="" || $_POST['zipcode']=="" || $_POST['balance']=="" || $_POST['credit_limit']=="" || $_POST['rep_num']==""))
{
    $message="There a data feilds that are empty!";
}
else if(isset($_POST['add']) && $_POST['customer_num']!="" && $_POST['customer_name']!="" && $_POST['street'] !=""  && $_POST['city']!="" && $_POST['state']!="" && $_POST['zipcode']!="" && $_POST['balance']!="" && $_POST['credit_limit']!="" && $_POST['rep_num']!="")
{
       
  $query = "INSERT INTO CUSTOMER VALUES ('$customer_num', '$customer_name','$street','$city','$state','$zipcode','$balance','$credit_limit','$rep_num')";
  $result = mysql_query($query, $connection); 
    if($result != false)
    {
		  $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'"; 
          $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
      $message="Record Inserted for Customer Number: $customer_num";
    }
	else
    {
        $message="There is already a record for that Customer Number!";
	} 
}

//Delete Button Selected
if(isset($_POST['delete']) && $_POST['customer_num'])
{
		$query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'"; 
        $result = mysql_query($query, $connection);
            if($result != 0)
            {
                $array = mysql_fetch_array($result);
            }
		if(mysql_num_rows($result)<1){
		  $message="That Customer Number does not exist!";	
		}
		else{
			$query = "DELETE FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'";
	        $result = mysql_query($query, $connection); 
			$message="Record for Customer Number $customer_num deleted";
		}
}

//Modify Button Selected
if(isset($_POST['modify']) && ($_POST['customer_num']=="" || $_POST['customer_name']=="" || $_POST['street'] ==""  || $_POST['city']=="" || $_POST['state']=="" || $_POST['zipcode']=="" || $_POST['balance']=="" || $_POST['credit_limit']=="" || $_POST['rep_num']==""))
{
  $message = "You Must enter all the information!";
}

else if(isset($_POST['modify']) && $_POST['customer_num']!="" && $_POST['customer_name']!="" && $_POST['street'] !=""  && $_POST['city']!="" && $_POST['state']!="" && $_POST['zipcode']!="" && $_POST['balance']!="" && $_POST['credit_limit']!="" && $_POST['rep_num']!="")
{
    $customer_num=$_POST['customer_num'];
    $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'"; 
          $result = mysql_query($query, $connection);
            if($result != 0)
            {
                $array = mysql_fetch_array($result);
            }
  if($array['CUSTOMER_NAME']!="")
  {
    $query = "UPDATE CUSTOMER SET CUSTOMER_NAME='$customer_name', STREET='$street', CITY='$city', STATE='$state', ZIP='$zipcode', BALANCE='$balance', CREDIT_LIMIT='$credit_limit', REP_NUM='$rep_num' WHERE CUSTOMER_NUM='$customer_num'";
    $result = mysql_query($query, $connection);
      
    $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'"; 
          $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
    $message="Modified Record for Customer Number: $customer_num successfully";
   }
   else{
     $customer_name=""; 
     $street=""; 
     $city=""; 
     $state=""; 
     $zipcode=""; 
     $balance="";
     $credit_limit="";
     $rep_num="";
     $message = "Customer Number: $customer_num does not exist!";
   }
}




require("../_includes/header.php");
?>
   
  

        
        <br>
        <div align="center" class="errormessage"> <?php echo $message ?></div>
        <br>
        <hr/>
        <br>
        <br>
    <form method= "POST" action= "<?php echo $PHP_SELF?>">
        
        <table align="center">
            <tr><td>Customer_Num:</td><td align="center"><input name="customer_num" value="<?php echo $customer_num ?>" required/></td></tr>
            <tr><td>Customer_Name:</td><td align="center"><input name="customer_name" value="<?php echo $customer_name ?>"/></td></tr>
            <tr><td>Street:</td><td align="center"><input name="street" value="<?php echo $street ?>" /></td></tr>
            <tr><td>City:</td><td align="center"><input name="city" value="<?php echo $city ?>" /></td></tr>
            <tr><td>State:</td><td align="center"><input name="state" value="<?php echo $state ?>" /></td></tr>
            <tr><td>Zip-code:</td><td align="center"><input name="zipcode" value="<?php echo $zipcode ?>" /></td></tr>
            <tr><td>Balance:</td><td align="center"><input name="balance" value="<?php echo $balance ?>" /></td></tr>
            <tr><td>Credit_Limit:</td><td align="center"><input name="credit_limit" value="<?php echo $credit_limit ?>" /></td></tr>
            <tr><td>Rep_Num:</td><td align="center"><input name="rep_num" value="<?php echo $rep_num ?>" /></td></tr>
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


<?php 
//Displays Current Table information at the bottom of the page
$query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'";
$result = mysql_query($query, $connection);
  if($result != "")
  {
    $array = mysql_fetch_array($result);
  }
if($result != "" && $array['CUSTOMER_NAME'] != "")
{
    echo " <div align=\"center\"> Record in Customer Table for Customer Number: $customer_num </div>";
    echo " <br/>";
    echo " <div align=\"center\">";
    echo " <table align=\"center\" border=\"5px\"> ";  
    echo " <tr>";
    echo " <td align=\"center\"width=\"150px\">Customer Number</td>";
    echo " <td align=\"center\"width=\"150px\">Customer Name</td>";
    echo " <td align=\"center\"width=\"150px\">Street</td>";
    echo " <td align=\"center\"width=\"150px\">City</td>";
    echo " <td align=\"center\"width=\"50px\">State</td>";
    echo " <td align=\"center\"width=\"150px\">Zipcode</td>";
    echo " <td align=\"center\" width=\"150px\">Balance</td>";
    echo " <td align=\"center\"width=\"150px\">Credit Limit</td>";
    echo " <td align=\"center\" width=\"150px\">Rep_Num</td>";
    echo " </tr>"; 
    echo " <tr>";
    echo "<td align=\"center\">".$array[CUSTOMER_NUM]."</td>";
    echo "<td align=\"center\">".$array[CUSTOMER_NAME]."</td>";
    echo "<td align=\"center\">".$array[STREET]."</td>";
    echo "<td align=\"center\">".$array[CITY]."</td>";
    echo "<td align=\"center\">".$array[STATE]."</td>";
    echo "<td align=\"center\">".$array[ZIP]."</td>";
    echo "<td align=\"center\">$".$array[BALANCE]."</td>";
    echo "<td align=\"center\">$".$array[CREDIT_LIMIT]."</td>";
    echo "<td align=\"center\">".$array[REP_NUM]."</td>";
	echo "</tr>";
}
?>
</TABLE>
</body>
</html>