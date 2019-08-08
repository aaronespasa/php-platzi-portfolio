<?php

namespace Models;

// require_once 'BaseElement.php';

class Job extends BaseElement {
    public function __construct($title, $description) {
        $newTitle = 'Job: ' . $title;
        $this->title = $newTitle;
        $this->description = $description;
        // Get the parent constructor and don't create another new one 
        // parent::__construct($newTitle, $description);
    }

    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extra_months = $this->months % 12;

        if ($this -> months < 12) {
          return "Job duration: $extra_months months <br>";
        } elseif ($extra_months == 0) {
          return "Job duration: $years years <br>";
        } else {
          return "Job duration: $years years and $extra_months months <br>";
        }
    }
}