<?php
require_once("../_Connection/connect.php");
$PageTitle="Order Line Maintenance Page";
$title ="Order Line Maintenance Page";

$order_num = $_POST['order_num'];
$part_num = $_POST['part_num'];
$num_ordered = $_POST['num_ordered'];
$quoted_price = $_POST['quoted_price'];
$message;

//Retrieve Button Selected
if(order_num != "" && isset($_POST['retrieve']))
{
    $query = "SELECT * FROM ORDER_LINE WHERE ORDER_NUM = '$order_num'"; 
    $result = mysql_query($query, $connection);

        if(mysql_num_rows($result)<1)
        {
          $message="No results found for Order Num: '$order_num'";
        }
        else
        {
            $message= "Record found for Order Num: '$order_num'";   
            $array = mysql_fetch_array($result);
            $part_num = $array['PART_NUM'];
            $num_ordered = $array['NUM_ORDERED'];
            $quoted_price = $array['QUOTED_PRICE'];
        }
}

//Add Button Selected
if(isset($_POST['add']) && ($_POST['order_num']=="" || $_POST['part_num']=="" || $_POST['num_ordered']=="" || $_POST['quoted_price']==""))
{
    $message="There a data feilds that are empty!";
}
else if(isset($_POST['add']) && $_POST['order_num']!="" && $_POST['part_num']!="" && $_POST['num_ordered']!="" && $_POST['quoted_price']!="")
{
        
  $query = "INSERT INTO ORDER_LINE VALUES ('$order_num', '$part_num','$num_ordered','$quoted_price')";
  $result = mysql_query($query, $connection); 
      
    if($result != false)
    {
		  $query = "SELECT * FROM ORDER_LINE WHERE ORDER_NUM = '$order_num'"; 
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
		
		$query = "SELECT * FROM ORDER_LINE WHERE ORDER_NUM = '$order_num'"; 
        $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
		if(mysql_num_rows($result)<1){
		  $message="That Order Number does not exist!";	
		}
		else{
			$query = "DELETE FROM ORDER_LINE WHERE ORDER_NUM = '$order_num'";
            $result = mysql_query($query, $connection); 
            $message="Record for Order Number $order_num deleted";
		}
}

//Modify Button Selected
if(isset($_POST['modify']) && ($_POST['order_num']=="" || $_POST['part_num']=="" || $_POST['num_ordered']=="" || $_POST['quoted_price']==""))
{
  $message = "You Must enter all the information!";
}

else if(isset($_POST['modify']) && $_POST['order_num']!="" && $_POST['part_num']!="" && $_POST['num_ordered']!="" && $_POST['quoted_price']!="")
{
    //Checks if customer exists
    $order_num=$_POST['order_num'];
    $query = "SELECT * FROM ORDER_LINE WHERE ORDER_NUM = '$order_num'"; 
          $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
    //If it exists
  if($array['PART_NUM']!="")
  {
    $query = "UPDATE ORDER_LINE SET PART_NUM='$part_num', NUM_ORDERED='$num_ordered', QUOTED_PRICE='$quoted_price' WHERE ORDER_NUM='$order_num'";
    $result = mysql_query($query, $connection);
      
    $query = "SELECT * FROM ORDER_LINE WHERE ORDER_NUM = '$order_num'"; 
    $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
    $message="Modified Record for Order Number: $Order_num successfully";
   }
   else
   {
     $part_num=""; 
     $num_ordered=""; 
     $quoted_price=""; 
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
    <form method="POST" action= "<?php echo $PHP_SELF?>">
        
        <table align="center">
            <tr><td>Order_Num:</td><td align="center"><input name="order_num" value="<?php echo $order_num ?>" required/></td></tr>
            <tr><td>Part_Num:</td><td align="center"><input name="part_num" value="<?php echo $part_num ?>"/></td></tr>
            <tr><td>Num_Ordered:</td><td align="center"><input name="num_ordered" value="<?php echo $num_ordered ?>"/></td></tr>
            <tr><td>Quoted_Price:</td><td align="center"><input name="quoted_price" value="<?php echo $quoted_price ?>" /></td></tr>
        </table>
        
            <br>
            <br>
            <hr />
        <table align="center">
            <td colspan="2" align="center"><input type="submit"value="Retrieve" name="retrieve"/></td>
            <td colspan="2" align="center"><input type="submit"value="Add" name="add"/></td>
            <td colspan="2" align="center"><input type="submit"value="Delete" name="delete" onclick="return confirm('Are you sure you want to delete the entire record for Order Number <?php echo "$order_num";?>?')"/></td>
            <td colspan="2" align="center"><input type="submit"value="Modify"name="modify"></td>
        </table>
        
    </form>

<?php 
//Displays Record infromation at the bottom of the page
$query = "SELECT * FROM ORDER_LINE WHERE ORDER_NUM = '$order_num'";
$result = mysql_query($query, $connection);
  if($result != "")
  {
    $array = mysql_fetch_array($result);
  }
if($result != "" && $array['ORDER_NUM'] != "")
{
    echo " <div align=\"center\"> Record in Order Line Table for Order Number: $order_num </div>";
    echo " <br/>";
    echo " <div align=\"center\">";
    echo " <table align=\"center\" border=\"5px\"> ";  
    echo " <tr>";
    echo " <td align=\"center\"width=\"150px\">Order Number</td>";
    echo " <td align=\"center\"width=\"150px\">Part Number</td>";
    echo " <td align=\"center\"width=\"150px\">Num Ordered</td>";
     echo " <td align=\"center\"width=\"150px\">Quoted Price</td>";
    echo " </tr>"; 
    echo " <tr>";
    echo "<td align=\"center\">".$array[ORDER_NUM]."</td>";
    echo "<td align=\"center\">".$array[PART_NUM]."</td>";
    echo "<td align=\"center\">".$array[NUM_ORDERED]."</td>";
    echo "<td align=\"center\">$".$array[QUOTED_PRICE]."</td>";
    echo "</tr>";
}
?>
</TABLE>
</body>
</html>