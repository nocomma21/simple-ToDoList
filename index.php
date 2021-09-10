<?php
require 'conn.php';

if(isset($_POST['addTask'])) {
    $task = $_POST['task'];

    mysqli_query($conn, "INSERT INTO tasks (task) VALUES ('$task')");
    header('location: index.php');  
}
// delete task
if(isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    mysqli_query($conn, "DELETE FROM tasks WHERE id=$id");
    header('location: index.php');
}

$tasks = mysqli_query($conn, "SELECT * FROM tasks");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <div class="container mt-3">
        <h2>Task List</h2>
    </div>
    <div class="container mt-3">
        <form action="index.php" method="POST">
            <div class="row">
                <div class="col">
                    <th>To Do</th><br>
                    <input type="text" name="task" class="task_input" placeholder="Type To Do" required>
                    <button type="submit" name="addTask" class="add_btn">Add Task</button>
                </div>
            </div>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>N</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; while($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class="task"><?php echo $row['task']; ?></td>
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id']; ?>">X</a>
                </td>
            </tr>
        <?php $i++; } ?>
        </tbody>
    </table>
</html>