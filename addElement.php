<?php

use Models\{Job, Project};

$job_button = $_POST['submit_job'];
$project_button = $_POST['submit_project'];

if ($job_button) {
  if (!empty($_POST)) {
    $job = new Job();
    $job->title = $_POST['job_title'];
    $job->description = $_POST['job_description'];
    $job->save();
  }
}

if ($project_button) {
  if (!empty($_POST)) {
    $project = new Project();
    $project->title = $_POST['project_title'];
    $project->description = $_POST['project_description'];
    $project->save();
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Element</title>

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
    crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Add a job to database -->
    <h1>Add Job</h1>
    <form action="addElement.php" method="POST">
        <label for="">Title:</label>
        <input type="text" name="job_title"><br>
        <label for="">Description:</label>
        <input type="text" name="job_description"><br>
        <input type="submit" name="submit_job" value="Submit">
    </form>
    <!-- Add a project to database -->
    <h1>Add Project</h1>
    <form action="addElement.php" method="POST">
        <label for="">Title:</label>
        <input type="text" name="project_title"><br>
        <label for="">Description:</label>
        <input type="text" name="project_description"><br>
        <input type="submit" name="submit_project" value="Submit">
    </form>
</body>
</html>