<?php
require_once("../_Connection/connect.php");
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$PageTitle="Invoice By Date";
$title="Invoice By Date";

require("../_includes/header.php");
?> 
        <br>
        <div align="center" class="errormessage"> <?php echo $message ?></div>
        <br>
        <hr />
        <br>
        <br>

        <form method= "POST" action="<?php echo $PHP_SELF?>">
            
        <table align="center">
            <tr><td>Enter a Start Date:</td><td align="center"><input name="start_date" placeholder="yyyy-mm-dd" value="<?php echo $start_date ?>" required/></td></tr>
            <tr><td>Enter a End Date:</td><td align="center"><input name="end_date" placeholder="yyyy-mm-dd" value="<?php echo $end_date ?>" required/></td></tr>
        </table>
            
            <br>
            <br>
            <hr />
        <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Generate Invoice" name="generate"></td>
        </table>
          
            <?php echo $message ?>
            
            
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
        <td align="center"width="190px"><b>Order Date</b> </td>
        <td align="center"width="187px"><b>Order Num</b></td>
        <td align="center"width="190px"><b>Part Num</b> </td>
        <td align="center"width="190px"><b>Num Ordered</b></td>
        <td align="center"width="187px"><b>Quoted Price</b></td>
        <td align="center"width="190px"><b>Part Total</b></td>
        
    </tr>


<?php 
if(isset($_POST['generate']) && $_POST['end_date']!="" && $_POST['start_date']!="")
{
    $order_total;
    $part_total;
    $query = "SELECT * FROM ORDERS O, ORDER_LINE OL WHERE  O.ORDER_NUM = OL.ORDER_NUM AND (O.ORDER_DATE BETWEEN '$start_date' AND '$end_date')";
    $result = mysql_query($query, $connection);
    if(mysql_num_rows($result)<1)
    {
       echo "<div align=\"center\" class=\"errormessage\">Record not found</div>";
    }
    elseif($result != "")
    {
    echo "<div align=\"center\" class=\"errormessage\">Retrieved Invoice</div>";
        while($array = mysql_fetch_array($result))
        {
            $part_total = $array['NUM_ORDERED'] * $array['QUOTED_PRICE']; 
            echo "<tr>";
            echo "<td align=\"center\">".$array[ORDER_DATE]."</td>";
            echo "<td align=\"center\">".$array[ORDER_NUM]."</td>";
            echo "<td align=\"center\">".$array[PART_NUM]."</td>";
            echo "<td align=\"center\">".$array[NUM_ORDERED]."</td>";
            echo "<td align=\"right\">$".$array[QUOTED_PRICE]."</td>";
            echo "<td align=\"right\">$".number_format($part_total,2)."</td>";
            echo "</tr>";
            $order_total += $part_total;
        }
        echo "<tr><td colspan=\"5\" align=\"right\"> Order Total >></td><td align=\"right\">$".number_format($order_total,2)."</td></tr>";
        echo"</table>";
    }
}
?>
  
</TABLE>
</body>
</html>