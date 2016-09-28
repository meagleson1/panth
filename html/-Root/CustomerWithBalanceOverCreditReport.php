<?php
require_once("../_Connection/connect.php");
$PageTitle="Customers with Balances Over Specific Credit Limit Report";
$title="Specific Credit Limit Report";


$credit_limit = $_POST['credit_limit'];
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
           
             <div align="center"><b><ins>Customers with Balance over a specific Credit Limit</ins></b></div>
            <br>
            <br>
            
        <table align="center">
            <tr><td>Enter Specific Credit Limit:</td><td align="center"><input name="credit_limit" value="<?php echo $credit_limit ?>" required /></td></tr>
        </table>
            
            <br>
            <br>
            <hr />
        <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve Report" name="retrieve"></td>
        </table>
          
            
            
    


            <br>
            <div align="center"> <b><ins>Customers with Balance over a specific Credit Limit</ins></b> </div>
            <br/>
            <div align="center">
            <table align="center" border="5px"> 
            <tr>
            <td align="center"width="150px">Customer Number</td>
            <td align="center"width="200px">Customer Name</td>
            <td align="center"width="150px">Street</td>
            <td align="center"width="150px">City</td>
            <td align="center"width="150px">State</td>
            <td align="center"width="150px">Zip Code</td>
            <td align="center"width="150px">Balance</td>
            <td align="center"width="150px">Rep Num</td>
            </tr> 
    
            
    </form>
<?php
    
if(isset($_POST['credit_limit']) && isset($_POST['retrieve']))
{
    $query = "SELECT * FROM CUSTOMER WHERE BALANCE > '$credit_limit'";
    $result = mysql_query($query,$connection);
    if(mysql_num_rows($result)<1)
    {
       echo "<div align=\"center\" class=\"errormessage\">No Records for your criteria</div>";
    }
    elseif($result != "")
    {
    echo "<div align=\"center\" class=\"errormessage\">Retrieved Results</div>";
       while( $array =  mysql_fetch_array($result) )
       {
        echo " <tr>";
        echo "<td align=\"center\">".$array[CUSTOMER_NUM]."</td>";
        echo "<td align=\"center\">".$array[CUSTOMER_NAME]."</td>";
        echo "<td align=\"center\">".$array[STREET]."</td>";
        echo "<td align=\"center\">".$array[CITY]."</td>";
        echo "<td align=\"center\">".$array[STATE]."</td>";
        echo "<td align=\"center\">".$array[ZIP]."</td>";
        echo "<td align=\"center\">$".$array[BALANCE]."</td>";
        echo "<td align=\"center\">".$array[REP_NUM]."</td>";
        echo "</tr>";
        }  
            
    }
    else
    {
        $message="No Records for your criteria";
    }
}
?>

</TABLE>
</body>
</html>