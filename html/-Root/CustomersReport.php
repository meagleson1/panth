<?php
require_once("../_Connection/connect.php");

$PageTitle="Specific Customer Report";
$title="Specific Customer Report";

$customer_num = $_POST['customer_num'];
$message;

if(customer_num != "" && isset($_POST['retrieve']))
{
    $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'";
    $result = mysql_query($query, $connection);
    if(mysql_num_rows($result)< 1)
    {
        $message="Record not found";  
    }
    else
    {
        $message="Record found";
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

        <form method= "POST" action="<?php echo $PHP_SELF?>">
            
        <table align="center">
            <tr><td>Enter a Customer Number :</td><td align="center"><input name="customer_num" value="<?php echo $customer_num ?>" required/></td></tr>
        </table>
            
            <br>
            <br>
            <hr />
            
        <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve Report" name="retrieve"></td>
        </table>
          
            
        <br>
        <div align="center"> Customer Listings</div>
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
        <td align="center"width="150px">Credit Limit</td>
        <td align="center"width="150px">Rep Num</td>
        </tr> 
            
    </form>

<?php 
    
//Retrieve Button Selected
if(customer_num != "" && isset($_POST['retrieve']))
{
    
    $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer_num'";
    $result = mysql_query($query, $connection);
    if($result != "")
    {
        $array = mysql_fetch_array($result);

        echo "<tr>";
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
}

?>

</TABLE>
</body>
</html>