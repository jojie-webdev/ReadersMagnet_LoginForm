<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        .wrapper{
            width: 950px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Authors Details</h2>
                    </div>
                    <?php

                    // Attempt select query execution
                    $sql = "SELECT * FROM users";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table id='example' class='table table-striped table-bordered'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Phone Number</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Date</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['mobile'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['created_at'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
    <div class="house-rule">
        <p>1. You can write any topic as long as it is related to your work as an author (your book, your journey as a writer, achievement, latest update and etc.)</p>
        <p>2. The article will be posted under "Featured Article".</p>
        <p>3. English is the default language</p>
        <p>4. Post length should be 700 to 1000 words.</p>
        <p>5. Posting of an article will be based on first come first serve basis.</p>
        <p>6. We will feature 5-10 articles per day.</p>
        <p>7. Mentioned, "Authors lounge" in your first paragraph, the body of the content and last Paragraph of the article.</p>
        <p>8. Mentioned "Authors lounge" in your description/ excerpt.</p>
        <p>9. Description or excerpt should consist up to 300-320 characters.</p>
        <p>10. Link your book to your website.</p>
        <p>11. Link your book to any selling platform.</p>
        <p>12. Do not link your publisher to your article.</p>
        <p>13. Include your own photos to your blog and make sure they're high quality.</p>
        <p>14. Make sure you’re citing photos if you’re using ones from other sources.</p>
        <p>15. Utilize tagging by adding a certain keyword to your post.</p>
        <p>16. Ones submitted you will receive a notification or thank you message.</p>
        <p>17. Your Article will be reviewed before posting it on our site.</p>
        <p>18. We will contact you ones your article is posted.</p>
        <p>19. Share your blog article to social media by clicking the social media buttons.</p>
    </div>
</body>
</html>