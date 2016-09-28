<?php
require_once("../_Connection/connect.php");
$PageTitle="All Parts Report";
$title="All Parts Report";
$part_num = $_POST['part_num'];
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
            
             <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve Report" name="retrieve"></td>
        </table>
                    
            <br>
            <br>
            <hr />
       
          
            <?php echo $message ?>
            
        <br>
        <div align="center">All Parts Listings</div>
        <br/>
        <div align="center">
        <table align="center" border="5px">  
        <tr>
        <td align="center"width="150px">Part Number</td>
        <td align="center"width="200px">Description</td>
        <td align="center"width="150px">On Hand</td>
        <td align="center"width="150px">Class</td>
        <td align="center"width="150px">Warehouse</td>
        <td align="center"width="150px">Price</td>
        </tr> 
            
    </form>

<?php 
    
//Retrieve Button Selected
if(isset($_POST['retrieve']))
{
  
    $query = "SELECT * FROM PART";
    $result = mysql_query($query, $connection);
    if($result != "")
    {
    echo "<div align=\"center\" class=\"errormessage\">Retrieved All Parts Report</div>";
        
       while( $array =  mysql_fetch_array($result) )
       {
        echo "<tr>";
        echo "<td align=\"center\">".$array[PART_NUM]."</td>";
        echo "<td align=\"center\">".$array[DESCRIPTION]."</td>";
        echo "<td align=\"center\">".$array[ON_HAND]."</td>";
        echo "<td align=\"center\">".$array['CLASS']."</td>";
        echo "<td align=\"center\">".$array[WAREHOUSE]."</td>";
        echo "<td align=\"center\">$".$array[PRICE]."</td>";
        echo "</tr>";
        }  
            
    }
    
}
?>
</TABLE>
</body>
</html>