<?php
require_once("../_Connection/connect.php");
$PageTitle="Part Maintenance Page";
$title="Part Maintenance Page";

$part_num = $_POST['part_num'];
$description = $_POST['description'];
$on_hand = $_POST['on_hand'];
$class = $_POST['class'];
$warehouse = $_POST['warehouse'];
$price = $_POST['price'];
$message;

//Retrieve Button Selected
if(part_num != "" && isset($_POST['retrieve']))
{
    $query = "SELECT * FROM PART WHERE PART_NUM = '$part_num'"; 
    $result = mysql_query($query, $connection);
       
        if(mysql_num_rows($result)<1)
        {
          $message="No results found for Part Num: '$part_num'";
        }
        else
        {
            $message= "Record found for Part Num: '$part_num'";   
            $array = mysql_fetch_array($result);
            $description = $array['DESCRIPTION'];
            $on_hand = $array['ON_HAND'];
            $class = $array['CLASS'];
            $warehouse = $array['WAREHOUSE'];
            $price = $array['PRICE'];
        }
}


//Add Button Selected
if(isset($_POST['add']) && ($_POST['part_num']=="" || $_POST['description']=="" || $_POST['on_hand']=="" || $_POST['class']=="" || $_POST['warehouse']=="" || $_POST['price']==""))
{
    $message="You Must enter all the information!";
}
else if(isset($_POST['add']) && ($_POST['part_num']!="" && $_POST['description']!="" && $_POST['on_hand']!="" && $_POST['class']!="" && $_POST['warehouse']!="" && $_POST['price']!=""))
{
        
  $query = "INSERT INTO PART VALUES ('$part_num', '$description','$on_hand','$class','$warehouse','$price')";
  $result = mysql_query($query, $connection); 
    
    if($result != false)
    {
		  $query = "SELECT * FROM PART WHERE PART_NUM = '$part_num'"; 
          $result = mysql_query($query, $connection);
            if($result != 0)
            {
                $array = mysql_fetch_array($result);
            }
      $message="Record Inserted for Part Number: $part_num";
    }
	else
    {
        $message="There is already a record for that Part Number!";
	} 
}

//Delete Button Selected
if(isset($_POST['delete']) && $_POST['part_num'])
{
		
		$query = "SELECT * FROM PART WHERE PART_NUM = '$part_num'"; 
        $result = mysql_query($query, $connection);
            if($result != 0)
            {
                $array = mysql_fetch_array($result);
            }
		if(mysql_num_rows($result)<1){
		  $message="That Part Number does not exist!";	
		}
		else{
			$query = "DELETE FROM PART WHERE PART_NUM = '$part_num'";
	        $result = mysql_query($query, $connection); 
			$message="Record for Part Number $part_num deleted";
		}
}

//Modify Button Selected
if(isset($_POST['modify']) && ($_POST['part_num']=="" || $_POST['description']=="" || $_POST['on_hand']=="" || $_POST['class']=="" || $_POST['warehouse']=="" || $_POST['price']==""))
{
  $message = "You Must enter all the information!";
}

else if(isset($_POST['modify']) && ($_POST['part_num']!="" && $_POST['description']!="" && $_POST['on_hand']!="" && $_POST['class']!="" && $_POST['warehouse']!="" && $_POST['price']!=""))
{
    $part_num=$_POST['part_num'];
    $query = "SELECT * FROM PART WHERE PART_NUM = '$part_num'";
          $result = mysql_query($query, $connection);
            if($result != 0)
            {
                $array = mysql_fetch_array($result);
            }
  if($array['DESCRIPTION']!= "")
  {
    $query = "UPDATE PART SET DESCRIPTION='$description', ON_HAND='$on_hand', CLASS='$class', WAREHOUSE='$warehouse', PRICE='$price' WHERE PART_NUM='$part_num'";
    $result = mysql_query($query, $connection);
      
    $query = "SELECT * FROM PART WHERE PART_NUM = '$part_num'"; 
          $result = mysql_query($query, $connection);
            if($result != "")
            {
                $array = mysql_fetch_array($result);
            }
    $message="Modified Record for Part Number: $part_num successfully";
   }
   else{
     $description=""; 
     $on_hand=""; 
     $class=""; 
     $warehouse=""; 
     $price=""; 
     $message = "Part Number: $part_num does not exist!";
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
            <tr><td>Part_Num:</td><td align="center"><input name="part_num" value="<?php echo $part_num ?>" required /></td></tr>
            <tr><td>Description:</td><td align="center"><input name="description" value="<?php echo $description ?>" /></td></tr>
            <tr><td>On_Hand:</td><td align="center"><input name="on_hand" value="<?php echo $on_hand ?>"/></td></tr>
            <tr><td>Class:</td><td align="center"><input name="class" value="<?php echo $class ?>"/></td></tr>
            <tr><td>Warehouse:</td><td align="center"><input name="warehouse" value="<?php echo $warehouse ?>"/></td></tr>
            <tr><td>Price:</td><td align="center"><input name="price" value="<?php echo $price ?>"/></td></tr>
        </table>
            
            <br>
            <br>
            <hr />
        <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve" name="retrieve"></td>
            <td colspan="2" align="center"><input type="submit"value="Add" name="add"></td>
            <td colspan="2" align="center"><input type="submit"value="Delete" name="delete" onclick="return confirm('Are you sure you want to delete the entire record for Part Number <?php echo "$part_num";?>?')"/></td>
            <td colspan="2" align="center"><input type="submit"value="Modify" name="modify"></td>
        </table>
          
            
            
    </form>

<?php 
//Displays Current Table information at the bottom of the page
$query = "SELECT * FROM PART WHERE PART_NUM = '$part_num'";
$result = mysql_query($query, $connection);
  if($result != "")
  {
    $array = mysql_fetch_array($result);
  }
if($result != "" && $array['DESCRIPTION'] != "")
{
    echo " <div align=\"center\"> Record in Parts Table for Part Number: $part_num </div>";
    echo " <br/>";
    echo " <div align=\"center\">";
    echo " <table align=\"center\" border=\"5px\"> ";  
    echo " <tr>";
    echo " <td align=\"center\"width=\"150px\">Part Number</td>";
    echo " <td align=\"center\"width=\"200px\">Description</td>";
    echo " <td align=\"center\"width=\"150px\">On Hand</td>";
    echo " <td align=\"center\"width=\"150px\">Class</td>";
    echo " <td align=\"center\"width=\"150px\">Warehouse</td>";
    echo " <td align=\"center\"width=\"150px\">Price</td>";
    echo " </tr>"; 
    echo " <tr>";
    echo "<td align=\"center\">".$array[PART_NUM]."</td>";
    echo "<td align=\"center\">".$array[DESCRIPTION]."</td>";
    echo "<td align=\"center\">".$array[ON_HAND]."</td>";
    echo "<td align=\"center\">".$array['CLASS']."</td>";
    echo "<td align=\"center\">".$array[WAREHOUSE]."</td>";
    echo "<td align=\"center\">$".$array[PRICE]."</td>";
    echo "</tr>";
}
?>

</TABLE>
</body>
</html>