<?php
require_once("../_Connection/connect.php");
$order_num = $POST['order_num'];
$PageTitle="Order Number Invoice";
$title = "Order Number Invoice";
require("../_includes/header.php");

if(isset($_POST['order_num']) && isset($_POST['generate']))
{
    $query ="SELECT * FROM ORDERS WHERE ORDER_NUM =".$_POST['order_num'];
    $result = mysql_query($query, $connection);
    if(mysql_num_rows($result)<1)
    {
        $message="Record not found";  
    }
    else 
    {
        $message="Retrieved Invoice";
    }
}


?> 
        <br>
        <div align="center" class="errormessage"> <?php echo $message ?></div>
        <br>
        <hr />
        <br>
        <br>

        <form method= "POST" action="<?php echo $PHP_SELF?>">
            
        <table align="center">
            <tr><td>Enter an Order Number:</td><td align="center"><input name="order_num" value="<?php echo $order_num ?>" required/></td></tr>
        </table>
            
            
            <br>
            <hr />
        <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Generate Invoice" name="generate"></td>
        </table>
          
            
            
    </form>


    
    <br/>
    <div align="center">
    <table align="center" border="5px"> 
    <tr>
        <td align="center"colspan="6"width="250px"><br><b>Premiere Products</b><br><b>Order Invoice</b><br><br></td>
    </tr>
    <tr>
    </tr>
    <tr>
    </tr>
    <tr>
    </tr>
    <tr>
        <td align="center"width="187px"><b>Customer</b></td>
        <td align="center"width="190px"><b>Order:</b> </td>
        <td align="center"width="190px"><b>Date:</b></td>
        <td align="center"width="187px"><b>Sales Rep</b></td>
    
    </tr>


<?php 
if(isset($_POST['order_num']) && isset($_POST['generate']))
{
    $order_num = $POST['order_num'];
        $array;
    $query = "SELECT * 
    FROM ORDERS O, CUSTOMER C, REP R
    WHERE  O.CUSTOMER_NUM = C.CUSTOMER_NUM
    AND C.REP_NUM = R.REP_NUM
    AND O.ORDER_NUM = ".$_POST['order_num'];
    $result = mysql_query($query, $connection);
    if($result != "")
    {
        $array = mysql_fetch_array($result);
    }
    
?>
    
    <tr>
    <td align="center"><?php echo $array[CUSTOMER_NUM]?><br><?php echo $array[CUSTOMER_NAME];?></td>
    <td align="center"><?php echo $array[ORDER_NUM];?></td>
    <td align="center"><?php echo $array[ORDER_DATE];?></td>
    <td align="center"><?php echo $array[REP_NUM]?><br><?php echo $array[FIRST_NAME].$array[LAST_NAME]; ?></td>
    </tr>
      
        </table>
        <table border="5px">
            <tr><th>Part Number</th><th>Part Description</th><th>Number Ordered</th><th>Price</th><th>Total</th></tr>
            <?php
            $order_total;
            $part_total;
            $query = "SELECT * FROM PART P, ORDER_LINE OL WHERE P.PART_NUM = OL.PART_NUM AND OL.ORDER_NUM = ".$_POST['order_num'];
            $result = mysql_query($query,$connection);
            if($result != "")
            {
                 while($array = mysql_fetch_array($result))   
                 {
                     $part_total = $array['NUM_ORDERED'] * $array['PRICE']; 
                     echo "<tr><td align=\"center\"width=\"150px\">".$array['PART_NUM']."</td><td align=\"center\" width=\"150px\">".$array['DESCRIPTION']."</td><td align=\"center\"width=\"150px\">".$array['NUM_ORDERED']."</td><td align=\"right\" width=\"150px\">$".$array['PRICE']."</td><td align=\"right\"width=\"150px\">$".number_format($part_total,2)."</td></tr>";
                
                $order_total += $part_total;
                 }
               echo "<tr><td colspan=\"4\" align=\"right\"> Order Total >></td><td align=\"right\">$".number_format($order_total,2)."</td></tr>";
                echo "</table>";
            }
        ?>
            
        </table>
<?php 
}
        ?>
    


</TABLE>
</body>
</html>