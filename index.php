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

// go_doing onclick
if (isset($_POST['go_doing'])) {
    $task_ke = $_POST['go_doing'];
    $id = $_POST['go_doing'];
    $queryGoDoing = "UPDATE tasks SET task_ke=2 WHERE id=$id";
    mysqli_query($conn, $queryGoDoing);

    header('location: index.php');
}

// go_done onclick
if (isset($_POST['go_done'])) {
    $task_ke = $_POST['go_done'];
    $id = $_POST['go_done'];
    $queryGoDone = "UPDATE tasks SET task_ke=3 WHERE id=$id";
    mysqli_query($conn, $queryGoDone);

    header('location: index.php');
}

// delete_task
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" href="style.css">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <div class="container con1 mt-3">
        <h2 class="outset">Task List</h2>
    </div>
    <div class="container con2 mt-3 px-3">
        <div class="row">
            <div class="col">
                <form action="index.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="task" placeholder="Type To Do" required>
                        <input type="hidden" name="task_ke" value="1">
                        <span class="input-group-text" id="basic-addon2">
                            <button class="btn btnAddTo" name="addTask1" type="submit"><i class='fa fa-plus'></i> To Do </button>
                        </span>
                    </div>
                </form>
                <table class="table table-striped table-hover table-bordered mt-3">
                    <thead class="table">
                        <th>No</th>
                        <th>Task</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $index1 = 1; ?>
                        <?php while ($row = mysqli_fetch_array($task1)) : ?>
                            <tr>
                                <td><?php echo $index1; ?></td>
                                <td class="task"><?php echo $row['task']; ?></td>
                                <td>
                                    <div class="row">
                                        <div class='col d-flex justify-content-center'>
                                            <form action="index.php" method="POST">
                                                <button class="btn btnGo btn-sm" name="go_doing" value="<?php echo $row['id']; ?>" type="submit"><i class='fa fa-arrow-right'></i> Go Doing </button>
                                            </form>
                                        </div>
                                        <div class='col d-flex justify-content-center'>
                                            <form action="" method="GET">
                                                <button class='btn btnDel btn-sm' name="del_task" onclick="return deleteToDo(<?php echo $row['id']; ?>)" type="button" value="del_task"><i class='fa fa-trash'></i> Delete </button>
                                            </form>
                                            <script lang="javascript">
                                                function deleteToDo(id) {
                                                    if (confirm("do you want to detele ?")) {
                                                        window.location.href = 'index.php?del_task=' + id + '';
                                                        return true;
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
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
                            <button class="btn btnAddTo" name="addTask2" type="submit"><i class='fa fa-plus'></i> Doing </button>
                        </span>
                    </div>
                </form>
                <table class="table table-striped table-hover table-bordered mt-3">
                    <thead class="table">
                        <th>No</th>
                        <th>Task</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $index2 = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($task2)) : ?>
                            <tr>
                                <td><?php echo $index2; ?></td>
                                <td class="task"><?php echo $row['task']; ?></td>
                                <td>
                                    <div class="row">
                                        <div class='col d-flex justify-content-center'>
                                            <form action="index.php" method="POST">
                                                <button class="btn btnGo btn-sm" name="go_done" value="<?php echo $row['id']; ?>" type="submit"><i class='fa fa-arrow-right'></i> Go Done </button>
                                            </form>
                                        </div>
                                        <div class='col d-flex justify-content-center'>
                                            <form action="" method="GET">
                                                <button class='btn btnDel btn-sm' name="del_task" onclick="return deleteDoing(<?php echo $row['id']; ?>)" type="button" value="del_task"><i class='fa fa-trash' style="color: white"></i> Delete </button>
                                            </form>
                                            <script lang="javascript">
                                                function deleteDoing(id) {
                                                    if (confirm("do you want to detele ?")) {
                                                        window.location.href = 'index.php?del_task=' + id + '';
                                                        return true;
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
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
                            <button class="btn btnAddTo" name="addTask3" type="submit"><i class='fa fa-plus'></i> Done </button>
                        </span>
                    </div>
                </form>
                <table class="table table-striped table-hover table-bordered mt-3">
                    <thead class="table">
                        <th>No</th>
                        <th>Task</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $index3 = 1; ?>
                        <?php while ($row = mysqli_fetch_array($task3)) : ?>
                            <tr>
                                <td><?php echo $index3; ?></td>
                                <td class="task"><?php echo $row['task']; ?></td>
                                <td>
                                    <div class="row">
                                        <div class='col d-flex justify-content-center'>
                                            <form action="" method="GET">
                                                <button class='btn btnDel btn-sm' name="del_task" onclick="return deleteDoneTask(<?php echo $row['id']; ?>)" type="button" value="del_task"><i class='fa fa-check'></i> Done </button>
                                            </form>
                                            <script lang="javascript">
                                                function deleteDoneTask(id) {
                                                    if (confirm("Wow you done it, do you wanna delete it?")) {
                                                        window.location.href = 'index.php?del_task=' + id + '';
                                                        return true;
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
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
