<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $table = 'projects';

    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extra_months = $this->months % 12;

        if ($this -> months < 12) {
          return "Project duration: $extra_months months <br>";
        } elseif ($extra_months == 0) {
          return "Project duration: $years years <br>";
        } else {
          return "Project duration: $years years and $extra_months months <br>";
        }
    }
}