<?php
require_once("../_Connection/connect.php");
$PageTitle="Order Maintenance Page";
$title="Order Maintenance Page";

$order_num = $_POST['order_num'];
$order_date = $_POST['order_date'];
$customer_num = $_POST['customer_num'];
$message;

//Retrieve Button Selected
if(order_num != "" && isset($_POST['retrieve']))
{
    $query = "SELECT * FROM ORDERS WHERE ORDER_NUM = '$order_num'"; 
    $result = mysql_query($query, $connection);

        if(mysql_num_rows($result)<1)
        {
          $message="No results found for Order Num: '$order_num'";
        }
        else
        {
            $message= "Record found for Order Num: '$order_num'";   
            $array = mysql_fetch_array($result);
            $order_date = $array['ORDER_DATE'];
            $customer_num = $array['CUSTOMER_NUM'];
        }
}



//Add Button Selected
if(isset($_POST['add']) && ($_POST['order_num']=="" || $_POST['order_date']=="" || $_POST['customer_num']==""))
{
    $message="There a data feilds that are empty!";
}
else if(isset($_POST['add']) && $_POST['order_num']!="" && $_POST['order_date']!="" && $_POST['customer_num']!="")
{
        
  $query = "INSERT INTO ORDERS VALUES ('$order_num', '$order_date','$customer_num')";
  $result = mysql_query($query, $connection); 
    
    if($result != false)
    {
		  $query = "SELECT * FROM ORDERS WHERE ORDER_NUM = '$order_num'"; 
          $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
      $message="Record Inserted for Order Number: $order_num";
    }
	else
    {
        $message="There is already a record for that Order Number!";
	} 
}

//Delete Button Selected
if(isset($_POST['delete']) && $_POST['order_num'])
{
		
		$query = "SELECT * FROM ORDERS WHERE ORDER_NUM = '$order_num'"; 
        $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
		if(mysql_num_rows($result)<1){
		  $message="That Order Number does not exist!";	
		}
		else{
			$query = "DELETE FROM ORDERS WHERE ORDER_NUM = '$order_num'";
	        $result = mysql_query($query, $connection); 
            
			$message="Record for Order Number $order_num deleted";
		}
}

//Modify Button Selected
if(isset($_POST['modify']) && ($_POST['order_num']=="" || $_POST['order_date']=="" || $_POST['customer_num']==""))
{
  $message = "You Must enter all the information!";
}

else if(isset($_POST['modify']) && $_POST['order_num']!="" && $_POST['order_date']!="" && $_POST['customer_num']!="")
{
    //Checks if customer exists
    $order_num=$_POST['order_num'];
    $query = "SELECT * FROM ORDERS WHERE ORDER_NUM = '$order_num'"; 
          $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
    //If it exists
  if($array['ORDER_DATE']!="")
  {
    $query = "UPDATE ORDERS SET ORDER_DATE='$order_date', CUSTOMER_NUM='$customer_num' WHERE ORDER_NUM='$order_num'";
    $result = mysql_query($query, $connection);
      
    $query = "SELECT * FROM ORDERS WHERE ORDER_NUM = '$order_num'"; 
          $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
    $message="Modified Record for Order Number: $order_num successfully";
   }
   else
   {
     $order_date=""; 
     $customer_num=""; 
     $message = "Order Number: $order_num does not exist!";
   }
}




require("../_includes/header.php");
?>
        <br>
        <div align="center" class="errormessage"> <?php echo $message ?></div>
        <br>
        <hr />
        <br>
        <br>
    <form method="POST" action="<?php echo $PHP_SELF?>">
        
        <table align="center">
            <tr><td>Order_Num:</td><td align="center"><input name="order_num" value="<?php echo $order_num ?>" required/></td></tr>
            <tr><td>Order_Date:</td><td align="center"><input name="order_date" placeholder="yyyy-mm-dd" value="<?php echo $order_date ?>" /></td></tr>
            <tr><td>Customer_Num:</td><td align="center"><input name="customer_num" value="<?php echo $customer_num ?>" /></td></tr>
        </table>
        
        <br>
        <br>
        <hr />
        <table align="center">
            <td colspan="2" align="center"><input type="submit"value="Retrieve"name="retrieve"></td>
            <td colspan="2" align="center"><input type="submit"value="Add"name="add"></td>
            <td colspan="2" align="center"><input type="submit"value="Delete" name="delete" onclick="return confirm('Are you sure you want to delete the entire record for Order Number <?php echo "$order_num";?>?')"/></td>
            <td colspan="2" align="center"><input type="submit"value="Modify"name="modify"></td>
        </table>
    
    </form>
<?php 
//Displays Record infromation at the bottom of the page
$query = "SELECT * FROM ORDERS WHERE ORDER_NUM = '$order_num'";
$result = mysql_query($query, $connection);
  if($result != "")
  {
    $array = mysql_fetch_array($result);
  }
if($result != "" && $array['ORDER_NUM'] != "")
{
    echo " <div align=\"center\"> Record in Orders Table for Order Number: $order_num </div>";
    echo " <br/>";
    echo " <div align=\"center\">";
    echo " <table align=\"center\" border=\"5px\"> ";  
    echo " <tr>";
    echo " <td align=\"center\"width=\"150px\">Order Number</td>";
    echo " <td align=\"center\"width=\"150px\">Order Date</td>";
    echo " <td align=\"center\"width=\"150px\">Customer Num</td>";
    echo " </tr>"; 
    echo " <tr>";
    echo "<td align=\"center\">".$array[ORDER_NUM]."</td>";
    echo "<td align=\"center\">".$array[ORDER_DATE]."</td>";
    echo "<td align=\"center\">".$array[CUSTOMER_NUM]."</td>";
    echo "</tr>";
}
?>
</TABLE>
</body>
</html>