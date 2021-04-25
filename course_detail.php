<?php
session_start();
if (!isset($_SESSION['user_id']))
{
    header("Location: index.php");
    die();
}
include_once('conexion.php');
// Get Major Name
if (isset($_GET['career_id']))
{
    $career_id =  intval($_GET["career_id"]);
    $career_name = "";
    $sql = "SELECT * FROM careers WHERE id=".$career_id;
    $result = $conn->query($sql);
    //print $sql;
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $career_name = $row['name'];
    }     
}


if (isset($_POST['save_course'])) //button
{
    $user_id= $_SESSION['user_id'];
    $career_id = $_POST['career_id'];
    $requirement_ids = isset($_POST['requirements_ids']) ? $_POST['requirements_ids'] : [] ;

    // delete data
    $sql = "DELETE FROM user_career_requirements WHERE career_id=".$career_id ." AND user_id=" . $user_id;
    if ($conn->query($sql) === TRUE) {

        foreach($requirement_ids as $id)
        {
            $sql1 = "INSERT INTO user_career_requirements (user_id, career_id,requirement_id,done)
            VALUES (" . $user_id . "," . $career_id . "," .$id . ",1)";
            if ($conn->query($sql1) === TRUE) {
               
            }
        }
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Good Job!</strong> Your To-Do list has been updated
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <?php
    }
    else{
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> You already have that course in your list
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php
    }

  //user_career_requirements
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="d-flex toggled" id="wrapper">

<?php include_once('sidebar.php'); ?>

<!-- Page Content -->
<div id="page-content-wrapper">

<?php include_once('header.php'); ?>

  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center"><h1 class="mt-4 text-red"><?php echo $career_name;?> Details</h1></div>
    </div>
    <div class="row row justify-content-center">
        <div class="col-md-6 col-lg-6 offset-lg-3">
            
            <div class="content">
            <?php
                $career_id =  isset($_GET['career_id']) ? intval($_GET["career_id"]) : "";

                    $sql = "SELECT * FROM requirements WHERE career_id=".$career_id;
                    $result = $conn->query($sql);
                    //print $sql;
                    
                    if ($result->num_rows > 0) {
                        // output data of each row
                        ?>
                        <form method="post">
                        <?php
                        $type ="";
                        while($row = $result->fetch_assoc()) {
                            if ( $type != $row["type"] )
                            {
                                echo "<h2 class='text-red'>".  $row["type"] . "</h2>";
                                $type = $row["type"];
                            }
                            $checked = "";
                            // Look into 
                            $sql1 = "SELECT * FROM user_career_requirements WHERE career_id=".$career_id ." AND user_id=" . $_SESSION['user_id']. " AND requirement_id=". $row['id'];
                            $result1 = $conn->query($sql1);
                            if ($result1->num_rows > 0) {
                                $checked = ' checked="checekd"';
                            }

                            echo "<input type='checkbox' name='requirements_ids[]' id='check_" . $row["id"] . "' value='" . $row["id"] . "' " . $checked . "><label for='check_" . $row["id"]. "'>&nbsp;" . $row["name"]."</label><br>";
                        }
                        ?>
                        
                        <input type="hidden" name="career_id" value="<?php echo $career_id;?>">
                        <button type="submit" class="btn btn-success" name="save_course">Save</button>
                        </form>
                        <?php
                    } else {
                    echo "0 results";
                    }
            ?>
            
            </div>
        </div>
    </div>        
  </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

    <?php include('footer.php'); ?>
</body>
</html>


