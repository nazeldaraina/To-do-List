<?php

function loadTasks() {
    if (isset($_SESSION['tasks'])) {
        return $_SESSION['tasks'];
    }
    return [];
}

function saveTasks($tasks) {
    $_SESSION['tasks'] = $tasks;
}