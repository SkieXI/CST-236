<link rel="stylesheet" href="loginStyle.css"> <!-- style sheet being pulled from -->
<?php
require_once 'db_connector.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$db = new db_connector();
$connection = $db->getConnection();

if($_SESSION['Role'] != 'Admin') {
    echo "Please login as an admin<br>";
    exit;
}



$sql_statement = "SELECT * FROM `User` ";

if($connection)
{
    $result = mysqli_query($connection, $sql_statement);
    if($result){
        while($row = mysqli_fetch_assoc($result)){?>
        <section class="section">
        <?php
            echo "User ID " . $row['UID'] . "<br>";
            echo "User Email " . $row['Email'] . "<br>";
            echo "User First Name " . $row['FName'] . "<br>";
            echo "User Last Name " . $row['LName'] . "<br>";
            echo "User Password " . $row['Password'] . "<br>";
            echo "Username " . $row['Username'] . "<br>";
            echo "User Role" . $row['Role'] . "<br>";
            echo "User's Total Points " . $row['UPoints'] . "<br>";
            ?>
            <div class="row">
                <form action="processDeleteUser.php">
                    <input type = "hidden" name = "ID" value =" <?php echo $row['UID']?>"></input>
                    <input type = "hidden" name = "name" value = " <?php echo $row['Username']?>"></input>
                    
                    <div style="margin-left: auto;margin-right: auto;">
                        <button type = "submit" class="button">Delete</button>
                        <button type = "submit" class="button" form action="showEditUser.php">Edit</button>
                    </div>
                </form>
            </div>
            
            <!--<form action="showEditUser.php">
            <input type = "hidden" name = "ID" value =" <?php// echo $row['UID']?>"></input>
            <input type = "hidden" name = "name" value = " <?php //echo $row['FName']?>"></input>
            
            <button type = "submit">Edit</button>
            </form>-->
            
            <?php
            echo "==============<br>";
            ?>
            </section>
            <?php
        }
    }
    
}
?>