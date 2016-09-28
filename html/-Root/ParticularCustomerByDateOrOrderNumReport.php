<?php
require_once("../_Connection/connect.php");

$PageTitle="List all Orders for a Specific Customer or a Date <br> Report";
$title="List all Orders for a Customer or a Date Report";
$customer_num = $_POST['customer_num'];
$order_date = $_POST['order_date'];
$message;
require("../_includes/header.php");
?> 
        <br>
        
        <br>
        <hr />
        <br>
        <br>

        <form method= "POST" action="<?php echo $PHP_SELF?>">
            
            <div align="center"><b><ins>List all Orders for a particular Customer or particular Date</ins></b></div>
            <br>
            <br>
            
        <table align="center">
            <tr><td>Enter Customer Num:</td><td align="center"><input name="customer_num" value="<?php echo $customer_num ?>" /></td></tr>
            <tr><td>Enter Order Date:</td><td align="center"><input name="order_date" placeholder="yyyy-mm-dd" value="<?php echo $order_date ?>" /></td></tr>
        </table>
            
            <br>
            <br>
            <hr />
        <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve Report" name="retrieve"></td>
        </table>
          
            <?php if(isset($message)) echo $message ?>
            
    </form>
    <br>
    <br>
    <table align = "center" border="1px">
    <td align= "center" width= 150px>Order Num</td>
    <td align= "center" width= 150px>Order Date</td>
    <td align= "center" width= 150px>Customer Num</td>
    <td align= "center" width= 150px>Part Num</td>
    <td align= "center" width= 150px>Part Description</td>
    <td align= "center" width= 150px>Number Ordered</td>


<?php 
if(isset($_POST['retrieve']) && $_POST['order_date']!="" && $_POST['customer_num']!="")
{
    
    $query = "SELECT * FROM ORDERS O, ORDER_LINE OL, PART P WHERE O.ORDER_NUM = OL.ORDER_NUM AND OL.PART_NUM = P.PART_NUM AND ORDER_DATE = '$order_date' AND O.CUSTOMER_NUM = $customer_num";
    $result = mysql_query($query, $connection);
    if($result != "")
    {
        echo "<div align=\"center\" class=\"errormessage\">Retrieved Results</div>";
        while($array = mysql_fetch_array($result) )
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
        echo "</table>";
    }
}
else if(isset($_POST['retrieve']) && $_POST['customer_num']!="")
{
    
    $query =  "SELECT * FROM ORDERS O, ORDER_LINE OL, PART P WHERE O.ORDER_NUM = OL.ORDER_NUM AND OL.PART_NUM = P.PART_NUM AND CUSTOMER_NUM = '$customer_num'";
    $result = mysql_query($query, $connection);
    if($result != "")
    {
        echo "<div align=\"center\" class=\"errormessage\">Retrieved Results</div>";
        while($array = mysql_fetch_array($result) )
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
        echo "</table>";
    }
}
else if(isset($_POST['retrieve']) && $_POST['order_date']!="")
{
    
    $query = "SELECT * FROM ORDERS O, ORDER_LINE OL, PART P WHERE O.ORDER_NUM = OL.ORDER_NUM AND OL.PART_NUM = P.PART_NUM AND ORDER_DATE = '$order_date'";
    $result = mysql_query($query, $connection);
    if(mysql_num_rows($result)<1)
    {
       echo "<div align=\"center\" class=\"errormessage\">Record not found</div>";
    }
    elseif($result != "")
    {
    echo "<div align=\"center\" class=\"errormessage\">Retrieved Results</div>";
        while($array = mysql_fetch_array($result) )
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
        echo "</table>";
    }
}
else if(isset($_POST['retrieve']))
{
     echo "<div align=\"center\" class=\"errormessage\">Enter a Customer Num or Order Date</div>";

}
?>


</body>
</html>