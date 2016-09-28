<?php
require_once("../_Connection/connect.php");
$PageTitle="Order For Any Customer By Date and Order Num";
$title="Order For Any Customer By Date and Order Num";
$order_date = $_POST['order_date'];
$order_num = $_POST['order_num'];
$message;
require("../_includes/header.php");
?> 
        <br>
        <div align="center" class="errormessage"> <?php echo $message ?></div>
        <br>
        <hr />
        <br>
        <br>

        <form method= "POST" action="<?php echo $PHP_SELF?>">
            
            <div align="center"><b><ins>List Order for Customer by Date and Order Number</ins></b></div>
            <br>
            <br>
            
        <table align="center">
            <tr><td>Enter Order Number:</td><td align="center"><input name="order_num" value="<?php echo $order_num ?>" required/></td></tr>
            <tr><td>Enter Order Date:</td><td align="center"><input name="order_date" placeholder="yyyy-mm-dd" value="<?php echo $order_date ?>" required/></td></tr>
        </table>
            
            <br>
            <br>
            <hr />
        <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve Report" name="retrieve"></td>
        </table>
          
            <?php echo $message ?>
            
    </form>

    <div align="center"> List of Orders for Customer by Date and Order Number </div>
    <br/>
    <div align="center">
    <table align="center" border="5px">  
    <tr>
    <td align="center"width="150px">Order Number</td>
    <td align="center"width="200px">Order Date</td>
    <td align="center"width="150px">Customer Number</td>
    <td align="center"width="150px">Part Number</td>
    <td align="center"width="150px">Part Description</td>
    <td align="center"width="150px">Number Ordered</td>
    </tr> 
        
<?php 
//Displays Current Table information at the bottom of the page    
if(isset($_POST['retrieve']) && $_POST['order_date']!="" && $_POST['order_num']!="")
{
$query = "SELECT * FROM CUSTOMER C, ORDERS O, ORDER_LINE OL, PART P WHERE O.ORDER_NUM = OL.ORDER_NUM AND O.CUSTOMER_NUM = C.CUSTOMER_NUM AND OL.PART_NUM = P.PART_NUM AND O.ORDER_NUM = '$order_num' AND O.ORDER_DATE = '$order_date'";
$result = mysql_query($query, $connection);
    if(mysql_num_rows($result)<1)
    {
       echo "<div align=\"center\" class=\"errormessage\">Record not found</div>";
    }
    elseif($result != "")
    {
    echo "<div align=\"center\" class=\"errormessage\">Retrieved Results</div>";
        while($array = mysql_fetch_array($result))
        {
        echo "<tr>";
        echo "<td align=\"center\">".$array[ORDER_NUM]."</td>";
        echo "<td align=\"center\">".$array[ORDER_DATE]."</td>";
        echo "<td align=\"center\">".$array[CUSTOMER_NUM]."</td>";
        echo "<td align=\"center\">".$array[PART_NUM]."</td>";
        echo "<td align=\"center\">".$array[DESCRIPTION]."</td>";
        echo "<td align=\"center\">".$array[NUM_ORDERED]."</td>";
        echo "</tr>";
        }
    }
}

?>
</TABLE>
</body>
</html>