<?php 
    session_start();
    //authorization
    if(!$_SESSION['username']){
      session_destroy();
      header('Location: ../index.php');
    }
    else if($_SESSION['username'] && $_SESSION['role'] != 'teacher'){
      session_destroy();
      header('Location: ./dashboard.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Progress</title>
</head>
<style>
    @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
    body{
        margin: 0;
        font-size: .9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        text-align: left;
        background-color: #f5f8fa;
    }

    .navbar-laravel
    {
        box-shadow: 0 2px 4px rgba(0,0,0,.04);
    }

    .navbar-brand , .nav-link, .my-form, .login-form
    {
        font-family: Raleway, sans-serif;
    }

    .my-form
    {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .my-form .row
    {
        margin-left: 0;
        margin-right: 0;
    }

    .login-form
    {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .login-form .row
    {
        margin-left: 0;
        margin-right: 0;
    }
</style>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="dashboard.php">Project</a>
                <a class="navbar-brand" href="thesisProgress.php">Thesis/Project-Progress</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="mt-3 mb-4">
                <h4 class="text-center">My Group information</h4>
            </div>
                <table class="table table-hover table-fixed">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Date Completed</th>
                    <th>Grade</th>
                    <th>Progress</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php  
                        include '../connection.php';
                        $teacher_id = $_SESSION['id'];
                        $query = "SELECT groups.id, groups.projectName, groups.description, groups.dateCompleted, groups.grade, groups.progress, groups.status FROM groupSupervision, groups WHERE groupSupervision.groupId = groups.id AND groupSupervision.teacher_id = $teacher_id";
                        $sql = mysqli_query($conn, $query);
                        $i = 1;
                        while($row = mysqli_fetch_array($sql))
                        { ?>
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><?php echo $row['projectName']; ?></td>
                                <td><?php echo (!$row['description']) ? "No information" : $row['description']; ?></td>
                                <td><?php echo (!$row['dateCompleted']) ? "No information" : $row['dateCompleted']; ?></td>
                                <td><?php echo (!$row['grade']) ? "No information" : $row['grade']; ?></td>
                                <td><?php echo $row['progress']; ?>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?php echo $row['progress']; ?>" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td> <a class="btn btn-primary" href="editGroup.php?id=<?php echo $row['id']?>">Edit</a></td>
                            </tr>
                        <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body> 
</html>
