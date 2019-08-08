<?php
use Models\{Job, Project};

$jobs = Job::all();

function printElement($element) {
    // if($element->visible == false) {
    //     return;
    // }

    echo '<li class="work-position">';
          echo '<h5>' . $element->title . '</h5>';
          echo '<p>' . $element->description . '</p>';
        //   echo '<p>' . $element->months . '</p>';
          echo '<p>' . $element->getDurationAsString() . '</p>';
          echo '<strong>Achievements:</strong>';
          echo '<ul>';
            echo '<li>This is the first achievement.</li>';
            echo '<li>This is the second achievement.</li>';
          echo'</ul>';
    echo '</li>';
 }