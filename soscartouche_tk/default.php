<?php
session_start();
if(!isset($_SESSION['clerkID'])){
    header("Location: /index.php?error=1");
}



$typeString = '';
switch($_SESSION['clerkType']){
    case 0:
        $typeString = "Manager";
        break;
    case 1;
        $typeString = "Clerk";
}

?>
<!DOCTYPE html>
<html>

    <head>
	<!--
	 * Arunraj Adlee
	 * Date: 24/04/2015
	 * Time: 5:30 PM
	/-->
        <title>Default Page</title>
        <!-- Every page will reference the mainFrame.css which contains the basic layout
         of the page-->
        <link rel="stylesheet" type="text/css" href="css/mainFrame.css" />
        <link rel="stylesheet" type="text/css" href="css/fonts.css" />
		<!-- CSS FOR DEFAULT PAGE-->
		<link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>
 
<body>
	
	<?php include "header.php"; ?>
 <main>

<div id="mainContent" align="center">
    <?php
        if(isset($_GET['error'])) {
            $error = null;
            switch($_GET['error']) {
                case 1:
                    $error = "You are not authorized to access that function";
                    break;
            }
            print "<h3 id='error'>".$error."</h3>";
        }
    ?>
	<table class="Content" >
			<tr>
				<td colspan=3>
				<h2>Welcome, <?php echo $_SESSION['firstName']." (".$typeString.")"?> <h2>
				</td>
			</tr>

        <?php if ($_SESSION['clerkType'] == 0) {?>
			<tr id="links">
				<td>
                    <a class="link" href="inventory.php">Inventory</a>
				</td>
				<td>
                    <a class="link" href="invoice.php">Invoice</a>
				</td>
				<td>
					<a class="link" href="users.php">Users</a>
				</td>
                <td>
                    <a class="link" href="userinfo.php">My Account</a>
                </td>
			</tr>
        <?php } else {?>
            <tr id="links">
                <td>
                    <a class="link" href="inventory.php">Inventory</a>
                </td>
                <td>
                    <a class="link" href="invoice.php">Invoice</a>
                </td>
                <td>
                    <a class="link" href="userinfo.php">My Account</a>
                </td>
            </tr>
        <?php } ?>

		</table>
        <?php
        require "../includes/queries.inc";
        require "../includes/dbconnect.inc";
            $numOfUsers = count(getAllUsers($bdd));
            $numOfItems = count(getAllItems($bdd));
            $numOfLazerItems = count(getItems($bdd, "L", "all", "all"));
            $numOfInkItems = count(getItems($bdd, "I", "all", "all"));
        ?>
        <table id="summary">
            <tr>
                <th colspan="4">Database Summary</th>
            </tr>
            <tr>
                <th>Laser Cartridges</th>
                <td><?php echo $numOfLazerItems; ?></td>
                <th>Ink Cartridges</th>
                <td><?php echo $numOfInkItems; ?></td>
            </tr>
            <tr>
               <th colspan="2">Total items</th>
                <td colspan="2"><?php echo $numOfItems; ?></td>
            </tr>
            <tr>
                <th colspan="2">Users</th>
                <td colspan="2"><?php echo $numOfUsers; ?></td>
            </tr>
        </table>
		</div>
        </main>
    </body>

</html>
