<?php
$PageTitle="Login Page";
$welcome = "Welcome To The";
$title="Login Page";
require_once("../_Connection/connect.php");


    <title>NICU login</title>
       <p></p>
        <body>
            <form action ="" method="post">
                <table align="center" border="2">
                    <tr bgcolor="#0000ff">
                        <td align="center" colspan="3"><font color="white">Welcome</font></td>
                    </tr>
                    <tr>
                        <td>Login ID :</td>
                        <td colspan="2"><input type="email" name="first_name" placeholder="anyname@bob.com" required></td>
                    </tr>
                    <tr>
                        <td>Password :</td>
                        <td colspan="2"><input type="password" name="last_name"></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="submit" value="Login" on>
                        </td>
                        <td align="center"><input type="submit" onclick="forgotpass.html" value="Forgot Password"></td>
                        <td align="center"><input type="submit" value="Register">
                        </td>            
                    </tr>
                </table>
    
            </form>
        </body>
    <footer>
        <h6 align="center">Web Master: William Tippet</h6> 
        <h6 align="center">Date Last Updated 1/29/2016</h6>
        <p align="center"><a href="mailto:wtippet1@salisbury.gulls.edu">wtippet1@salisbury.gulls.edu</a></p>
    </footer> 

</html>
?>