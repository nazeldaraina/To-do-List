<?php
session_start();
require_once ('function.php');

// Tambah tugas
if (isset($_POST['add'])) {
    $tasks = loadTasks();
    $tasks[] = [
        'text' => $_POST['task'],
        'done' => false
    ];
    saveTasks($tasks);
    header("Location: index.php");
    exit();
}

// Tandai selesai
if (isset($_POST['check'])) {
    $tasks = loadTasks();
    $index = $_POST['check'];
    $tasks[$index]['done'] = !$tasks[$index]['done'];
    saveTasks($tasks);
    header("Location: index.php");
    exit();
}

// Hapus tugas
if (isset($_POST['delete'])) {
    $tasks = loadTasks();
    $index = $_POST['delete'];
    array_splice($tasks, $index, 1);
    saveTasks($tasks);
    header("Location: index.php");
    exit();
}

$tasks = loadTasks();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="text-center mb-4">📝 Aplikasi To-Do List</h1>

    <!-- Form Tambah Tugas -->
    <form method="post" class="d-flex gap-2 mb-4">
        <input type="text" name="task" class="form-control" placeholder="Tambahkan tugas..." required>
        <button type="submit" name="add" class="btn btn-primary">Tambah</button>
    </form>

    <!-- Daftar Tugas -->
    <ul class="list-group">
        <?php foreach ($tasks as $index => $task): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center
                <?= $task['done'] ? 'list-group-item-success text-decoration-line-through' : '' ?>">
                <form method="post" class="d-flex align-items-center gap-2 w-100">
                    <input type="hidden" name="check" value="<?= $index ?>">
                    <button type="submit" class="btn btn-sm btn-outline-success">
<?= $task['done'] ? '✔' : '◻' ?>
                    </button>
                    <span><?= htmlspecialchars($task['text']) ?></span>
                </form>
                <form method="post">
                    <input type="hidden" name="delete" value="<?= $index ?>">
                    <button type="submit" class="btn btn-sm btn-danger">🗑</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>