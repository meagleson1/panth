<?php
require_once("../_Connection/connect.php");
$PageTitle="Sales Rep Maintenance Page";
$title="Sales Rep Maintenance Page";

$rep_num = $_POST['rep_num'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$commission = $_POST['commission'];
$rate = $_POST['rate'];
$message;


//Retrieve Button Selected
if(rep_num != "" && isset($_POST['retrieve']))
{
    $query = "SELECT * FROM REP WHERE REP_NUM = '$rep_num'"; 
    $result = mysql_query($query, $connection);
       
        if(mysql_num_rows($result)<1)
        {
          $message="No results found for Rep Num: '$rep_num'";
        }
        else
        {
            $message= "Record found for Rep Num: '$rep_num'";        
            $array = mysql_fetch_array($result);
            $last_name = $array['LAST_NAME'];
            $first_name = $array['FIRST_NAME'];
            $street = $array['STREET'];
            $city = $array['CITY'];
            $state = $array['STATE'];
            $zipcode = $array['ZIP'];
            $commission = $array['COMMISSION'];
            $rate = $array['RATE'];
        }
}



//Add Button Selected
if(isset($_POST['add']) && ($_POST['rep_num']=="" || $_POST['last_name']=="" || $_POST['first_name']=="" || $_POST['street']=="" || $_POST['city']=="" || $_POST['state']=="" || $_POST['zipcode']=="" || $_POST['commission']=="" || $_POST['rate']==""))
{
    $message="You are missing data!";
}
else if(isset($_POST['add']) && ($_POST['rep_num']!="" && $_POST['last_name']!="" && $_POST['first_name']!="" && $_POST['street']!="" && $_POST['city']!="" && $_POST['state']!="" && $_POST['zipcode']!="" && $_POST['commission']!="" && $_POST['rate']!=""))
{
    $query = "INSERT INTO REP VALUES('$rep_num','$last_name','$first_name','$street','$city','$state','$zipcode','$commission','$rate')";
    $result = mysql_query($query, $connection); 
    if($result != false)
    {
		  $query = "SELECT * FROM REP WHERE REP_NUM = '$rep_num'"; 
          $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
      $message="Record Inserted for Rep Number: $rep_num";
    }
	else
    {
        $message="There is already a record for that Rep Number!";
	} 
}
    

//Delete Button Selected
if(isset($_POST['delete']) && $_POST['rep_num'])
{
		
		$query = "SELECT * FROM REP WHERE REP_NUM = '$rep_num'"; 
        $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
		if(mysql_num_rows($result)<1){
		  $message="That Rep Number does not exist!";	
		}
		else{
			$query = "DELETE FROM REP WHERE REP_NUM = '$rep_num'";
	        $result = mysql_query($query, $connection); 
			$message="Record for Rep Number $rep_num deleted";
		}
}

//Modify Button Selected
if(isset($_POST['modify']) && ($_POST['rep_num']=="" || $_POST['last_name']=="" || $_POST['first_name']=="" || $_POST['street']=="" || $_POST['city']=="" || $_POST['state']=="" || $_POST['zipcode']=="" || $_POST['commission']=="" || $_POST['rate']==""))
{
  $message = "You Must enter all the information!";
}

else if(isset($_POST['modify']) && ($_POST['rep_num']!="" && $_POST['last_name']!="" && $_POST['first_name']!="" && $_POST['street']!="" && $_POST['city']!="" && $_POST['state']!="" && $_POST['zipcode']!="" && $_POST['commission']!="" && $_POST['rate']!=""))
{
    //Checks if Rep exists
    $rep_num=$_POST['rep_num'];
    $query = "SELECT * FROM REP WHERE REP_NUM = '$rep_num'"; 
          $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
    //If it exists
  if($array['LAST_NAME']!="")
  {
    $query = "UPDATE REP SET LAST_NAME='$last_name', FIRST_NAME='$first_name', STREET='$street', CITY='$city', STATE='$state', ZIP='$zipcode', COMMISSION='$commission', RATE='$rate' WHERE REP_NUM='$rep_num'";
    $result = mysql_query($query, $connection);
    
    $query = "SELECT * FROM REP WHERE REP_NUM = '$rep_num'"; 
          $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
    $message="Modified Record for Rep Number: $rep_num successfully";
   }
   else{
     $first_name=""; 
     $last_name=""; 
     $street=""; 
     $city=""; 
     $state=""; 
     $zipcode="";
     $commission="";
     $rate="";
     $message = "Rep Number: $rep_num does not exist!";
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
            <tr><td>Rep_Num:</td><td align="center"><input name="rep_num" value="<?php echo $rep_num ?>"required/></td></tr>
            <tr><td>Last_Name:</td><td align="center"><input name="last_name" value="<?php echo $last_name ?>"/></td></tr>
            <tr><td>First_Name:</td><td align="center"><input name="first_name" value="<?php echo $first_name ?>"/></td></tr>
            <tr><td>Street:</td><td align="center"><input name="street" value="<?php echo $street ?>"/></td></tr>
            <tr><td>City:</td><td align="center"><input name="city" value="<?php echo $city ?>"/></td></tr>
            <tr><td>State:</td><td align="center"><input name="state" value="<?php echo $state ?>"/></td></tr>
            <tr><td>Zip-code:</td><td align="center"><input name="zipcode" value="<?php echo $zipcode ?>"/></td></tr>
            <tr><td>Commission:</td><td align="center"><input name="commission" value="<?php echo $commission ?>"/></td></tr>
            <tr><td>Rate:</td><td align="center"><input name="rate" value="<?php echo $rate ?>"/></td></tr>
       
         </table>
        <br>
        <br>
        <hr />
        <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve" name="retrieve"></td>
            <td colspan="2" align="center"><input type="submit"value="Add" name="add"></td>
            <td colspan="2" align="center"><input type="submit"value="Delete" name="delete" onclick="return confirm('Are you sure you want to delete the entire record for Rep Number <?php echo "$rep_num";?>?')"/></td>
            <td colspan="2" align="center"><input type="submit"value="Modify" name="modify"></td>
        </table>
    
    </form>


<?php 
//Displays Current Table information at the bottom of the page
$query = "SELECT * FROM REP WHERE REP_NUM = '$rep_num'";
$result = mysql_query($query, $connection);
  if($result != "")
  {
    $array = mysql_fetch_array($result);
  }
if($result != "" && $array['LAST_NAME'] != "")
{
    echo " <div align=\"center\"> Record in Sales Rep Table for Rep Number: $rep_num </div>";
    echo " <br/>";
    echo " <div align=\"center\">";
    echo " <table align=\"center\" border=\"5px\"> ";  
    echo " <tr>";
    echo " <td align=\"center\"width=\"150px\">Rep Number</td>";
    echo " <td align=\"center\"width=\"150px\">Last Name</td>";
    echo " <td align=\"center\"width=\"150px\">First Name</td>";
    echo " <td align=\"center\"width=\"150px\">Street</td>";
    echo " <td align=\"center\"width=\"150px\">City</td>";
    echo " <td align=\"center\"width=\"50px\">State</td>";
    echo " <td align=\"center\"width=\"150px\">Zipcode</td>";
    echo " <td align=\"center\" width=\"150px\">Commission</td>";
    echo " <td align=\"center\"width=\"150px\">Rate</td>";
    echo " </tr>"; 
    echo " <tr>";
    echo "<td align=\"center\">".$array[REP_NUM]."</td>";
    echo "<td align=\"center\">".$array[LAST_NAME]."</td>";
    echo "<td align=\"center\">".$array[FIRST_NAME]."</td>";
    echo "<td align=\"center\">".$array[STREET]."</td>";
    echo "<td align=\"center\">".$array[CITY]."</td>";
    echo "<td align=\"center\">".$array[STATE]."</td>";
    echo "<td align=\"center\">".$array[ZIP]."</td>";
    echo "<td align=\"center\">$".$array[COMMISSION]."</td>";
    echo "<td align=\"center\">".$array[RATE]."</td>";
	echo "</tr>";
}
?>
</TABLE>
</body>
</html>

