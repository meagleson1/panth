<?php
require_once("../_Connection/connect.php");
$PageTitle="User Defined Report";
$title="User Defined Report";
require("../_includes/header.php");
$rep_num = $_POST['rep_num'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$balance = $_POST['balance'];
$val = 1;

if(isset($_POST['retrieve']))
{
    $query = "SELECT * FROM CUSTOMER WHERE ";

    if(!empty($_POST['rep_num']))
        {
            $val = 0;
            $query = $query. " REP_NUM = '$rep_num'";
        }
    if(!empty($_POST['state']))
        {      
            if($val == 0)
            {
                 $query = $query. " AND ";
            }
            $query = $query. " STATE = '$state'";
            $val = O;
        }
    if(!empty($_POST['zipcode']))
        {
            if($val == 0)
            {
                $query = $query. " AND ";
            }
            $query = $query. " ZIP = '$zipcode'";
            $val = 0;
        }
    if(!empty($_POST['balance']))
        {
            if($val == 0)
            {
               $query = $query. " AND ";
            }
            $query = $query. " BALANCE >= '$balance'"; 
            $val = 0;
        }
    else if($val == 1)
    {
        echo "<div align=\"center\" class=\"errormessage\">Error, No Information in fields</div>";
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
            
            <div align="center"><b><ins>User Defined Customer Report</ins></b></div>
            <br>
            <br>
            
        <table align="center">
            <tr><td>Enter a Rep Num:</td><td align="center"><input name="rep_num" value="<?php echo $rep_num ?>" /></td></tr>
            <tr><td>Enter a State:</td><td align="center"><input name="state" value="<?php echo $state ?>" /></td></tr>
            <tr><td>Enter a Zipcode:</td><td align="center"><input name="zipcode" value="<?php echo $zipcode ?>"/></td></tr>
            <tr><td>Enter a Minimal Balance:</td><td align="center"><input name="balance" value="<?php echo $balance ?>"/></td></tr>
        </table>
            
            <br>
            <br>
            <hr />
        <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve Report" name="retrieve"></td>
        </table>
          
            <?php echo $message ?>
            
    </form>
        <div align="center">
        <table align="center" border="5px">  
        <tr>
        <td align="center"width="150px">Customer Number</td>
        <td align="center"width="200px">Customer Name</td>
        <td align="center"width="150px">Street</td>
        <td align="center"width="150px">City</td>
        <td align="center"width="150px">State</td>
        <td align="center"width="150px">ZipCode</td>
        <td align="center"width="150px">Balance</td>
        <td align="center"width="150px">Rep Num</td>
        </tr> 

<?php
$result = mysql_query($query,$connection);

if(mysql_num_rows($result)<1)
    {
       echo "<div align=\"center\" class=\"errormessage\">Record not found</div>";
    }
    else if($result != "")
    {
    echo "<div align=\"center\" class=\"errormessage\">Retrieved Results</div>";
        while($array = mysql_fetch_array($result))   
        {
        
            echo "<tr>";
            echo "<td>".$array['CUSTOMER_NUM']."</td>";
            echo "<td>".$array['CUSTOMER_NAME']."</td>";
            echo "<td>".$array['STREET']."</td>";
            echo "<td>".$array['CITY']."</td>";
            echo "<td>".$array['STATE']."</td>";
            echo "<td>".$array['ZIP']."</td>";
            echo "<td>".$array['BALANCE']."</td>";
            echo "<td>".$array['REP_NUM']."</td>";
        
        
        }
    echo "</table>";
}
?> 
</TABLE>
</body>
</html>