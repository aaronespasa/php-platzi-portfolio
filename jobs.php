<?php

require_once 'vendor/autoload.php';
// require 'Models/Job.php';
// require_once 'Models/Printable.php';
// require 'Models/Project.php';

use Models\{Job, Project, Printable};

$jobMkt = new Job('Digital Marketer', 'I\'m the founder of sesonoro.com');
$jobMkt -> months = 24;

$jobFront = new Job('Frontend dev', 'I developped my own website');
$jobFront -> months = 18;

$jobData = new Job('Data Scientist beginner', 'I have participated on a data science competition');
$jobData -> visible = false;
$jobData -> months = 3;

$project1 = new Project('Project 1', 'Description 1');

// $projectLib = new Lib1\Project();

$jobs = [
    $jobMkt,
    $jobFront,
    $jobData
];

$projects = [
    $project1
];

function printElement(Printable $job) {
    if($job->visible == false) {
        return;
    }
    echo '<li class="work-position">';
          echo '<h5>' . $job->getTitle() . '</h5>';
          echo '<p>' . $job->getDescription() . '</p>';
          echo '<p>' . $job->getDurationAsString() . '</p>';
          echo '<strong>Achievements:</strong>';
          echo '<ul>';
            echo '<li>This is the first achievement.</li>';
            echo '<li>This is the second achievement.</li>';
          echo'</ul>';
    echo '</li>';
 }