<html>
<?php
	require_once("../_Connection/connect.php");
?>
	<head>
		<title>Campers</title>
	</head>
	<body>
        <br>
        <br>
        <br>
        <hr />
        <br>
        <br>
	
	<form method= "POST" action= "<?php echo $PHP_SELF?>">
        
        <table align="center">
            <tr><td>Camper_ID:</td><td align="center"><input name="customer_num" value="<?php echo $customer_num ?>" required/></td></tr>
            <tr><td>Parent_ID:</td><td align="center"><input name="customer_name" value="<?php echo $customer_name ?>"/></td></tr>
            <tr><td>First_Name:</td><td align="center"><input name="street" value="<?php echo $street ?>" /></td></tr>
            <tr><td>Last_Name:</td><td align="center"><input name="city" value="<?php echo $city ?>" /></td></tr>
	    <tr><td>Age:</td><td align="center"><input name="street" value="<?php echo $street ?>" /></td></tr>
            <tr><td>Group_Num:</td><td align="center"><input name="city" value="<?php echo $city ?>" /></td></tr>
	    <tr><td>Pick-up_Name:</td><td align="center"><input name="street" value="<?php echo $street ?>" /></td></tr>
            <tr><td>Medications:</td><td align="center"><input name="city" value="<?php echo $city ?>" /></td></tr>
            <tr><td>Allergies:</td><td align="center"><input name="street" value="<?php echo $street ?>" /></td></tr>
            <tr><td>Med_Hist:</td><td align="center"><input name="city" value="<?php echo $city ?>" /></td></tr>
        </table>
        
        <br>
        <br>
        <hr />
         <table align="center"> 
            <td colspan="2" align="center"><input type="submit"value="Retrieve" name="retrieve"></td>
            <td colspan="2" align="center"><input type="submit"value="Add" name="add"></td>
            <td colspan="2" align="center"><input type="submit"  value="Delete" name="delete" onclick="return confirm('Are you sure you want to delete the entire record for Customer Number <?php echo "$customer_num";?>?')"/></td>
            <td colspan="2" align="center"><input type="submit"value="Modify" name="modify"></td>
        </table>

    
    </form>

	<h2 align="center"><a href="../admin_homepage.html">Go Back</a></h2>

</html>