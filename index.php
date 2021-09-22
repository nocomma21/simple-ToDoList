<?php
require 'conn.php';

function insertTask($task, $task_ke)
{
    global $conn;
    $query = "INSERT INTO tasks VALUES (null,'$task','$task_ke')";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn)) {
        return true;
    }
    return false;
}

if (isset($_POST['addTask1']) || isset($_POST['addTask2']) || isset($_POST['addTask3'])) {
    if (insertTask($_POST['task'], (int)$_POST['task_ke'])) {
        header('location: index.php');
    }
    echo "error";
    die;
}

// if (isset($_POST['addTask'])) {
//     $task = $_POST['task'];

//     mysqli_query($conn, "INSERT INTO tasks (task) VALUES ('$task')");
//     header('location: index.php');
// }
// delete task
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    mysqli_query($conn, "DELETE FROM tasks WHERE id=$id");
    header('location: index.php');
}

$task1 = mysqli_query($conn, "SELECT * FROM tasks WHERE task_ke = 1");
$task2 = mysqli_query($conn, "SELECT * FROM tasks WHERE task_ke = 2");
$task3 = mysqli_query($conn, "SELECT * FROM tasks WHERE task_ke = 3");

// var_dump(mysqli_fetch_assoc($task2));
// die;

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
    <div class="container mt-3 bg-primary">
        <h2>Task List</h2>
    </div>
    <div class="container mt-3 px-3">
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="task" placeholder="Type To Do" required>
                        <input type="hidden" name="task_ke" value="1">
                        <span class="input-group-text" id="basic-addon2">
                            <button class="btn btn-primary" name="addTask1" type="submit">Add To Do</button>
                        </span>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Task</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index1 = 1; ?>
                        <?php while ($row = mysqli_fetch_array($task1)) : ?>
                            <tr>
                                <td><?php echo $index1; ?></td>
                                <td class="task"><?php echo $row['task']; ?></td>
                                <td class="delete">
                                    <a href="index.php?del_task=<?php echo $row['id']; ?>">X</a>
                                </td>
                            </tr>
                            <?php $index1++; ?>
                        <?php endwhile ?>

                    </tbody>
                </table>

            </div>
            <div class="col">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="task" placeholder="Type Doing" required>
                        <input type="hidden" name="task_ke" value="2">
                        <span class="input-group-text" id="basic-addon2">
                            <button class="btn btn-primary" name="addTask2" type="submit">Add Doing</button>
                        </span>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Task</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index2 = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($task2)) : ?>
                            <tr>
                                <td><?php echo $index2; ?></td>
                                <td class="task"><?php echo $row['task']; ?></td>
                                <td class="delete">
                                    <a href="index.php?del_task=<?php echo $row['id']; ?>">X</a>
                                </td>
                            </tr>
                            <?php $index2++; ?>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="task" placeholder="Type Done" required>
                        <input type="hidden" name="task_ke" value="3">
                        <span class="input-group-text" id="basic-addon2">
                            <button class="btn btn-primary" name="addTask3" type="submit">Add Done</button>
                        </span>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Task</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index3 = 1; ?>
                        <?php while ($row = mysqli_fetch_array($task3)) : ?>
                            <tr>
                                <td><?php echo $index3; ?></td>
                                <td class="task"><?php echo $row['task']; ?></td>
                                <td class="delete">
                                    <a href="index.php?del_task=<?php echo $row['id']; ?>">X</a>
                                </td>
                            </tr>
                            <?php $index3++; ?>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</html>