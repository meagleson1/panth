<?php
require_once("../_Connection/connect.php");
$rep_num = $_POST['rep_num'];
$PageTitle="Sales Rep Report Page";
$title = "Sales Rep Report Page";
$message;

if(rep_num != "" && isset($_POST['retrieve']))
{
    $query = "SELECT * FROM REP WHERE REP_NUM = '$rep_num'";
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
            <tr><td>Enter a Sales Rep Number:</td><td align="center"><input name="rep_num" value="<?php echo $rep_num ?>" required/></td></tr>
        </table>
            
            <br>
            <br>
            <hr />
        <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve Report" name="retrieve"></td>
        </table>
          
            
            
            <br>
            <div align="center"> Sales Rep Listings</div>
            <br/>
            <div align="center">
            <table align="center" border="5px">  
            <tr>
            <td align="center"width="150px">Rep Number</td>
            <td align="center"width="200px">Last Name</td>
            <td align="center"width="150px">First Name</td>
            <td align="center"width="150px">Street</td>
            <td align="center"width="150px">City</td>
            <td align="center"width="150px">State</td>
            <td align="center"width="150px">Zip Code</td>
            <td align="center"width="150px">Commission</td>
            <td align="center"width="150px">Rate</td>
            </tr>
    </form>
<?php
    //Retrieve Button Selected
if(rep_num != "" && isset($_POST['retrieve']))
{
    
    $query = "SELECT * FROM REP WHERE REP_NUM = '$rep_num'";
    $result = mysql_query($query, $connection);
    if($result != "")
    {
        $array = mysql_fetch_array($result);

        echo "<tr>";
        echo "<td align=\"center\">".$array[REP_NUM]."</td>";
        echo "<td align=\"center\">".$array[LAST_NAME]."</td>";
        echo "<td align=\"center\">".$array[FIRST_NAME]."</td>";
        echo "<td align=\"center\">".$array[STREET]."</td>";
        echo "<td align=\"center\">".$array[CITY]."</td>";
        echo "<td align=\"center\">".$array[STATE]."</td>";
        echo "<td align=\"center\">".$array[ZIP]."</td>";
        echo "<td align=\"center\">$".$array[COMMISSION]."</td>";
        echo "<td align=\"center\">%".$array[RATE]."</td>";
        echo "</tr>";
    }
}

?>


</TABLE>
</body>
</html>