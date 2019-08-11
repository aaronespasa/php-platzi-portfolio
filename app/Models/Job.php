<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// interface Printable {
//     public function getDescription();
// }

class Job extends Model {
    //public function __construct($title, $description) {
        //$newTitle = 'Job: ' . $title;
        //$this->title = $newTitle;
        //$this->description = $description;
        // Get the parent constructor and don't create another new one 
        // parent::__construct($newTitle, $description);
    //}

    protected $table = 'jobs';

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