<?php

namespace Models;

// require_once 'Printable.php';

class BaseElement implements Printable {
    protected $title;
    public $description;
    public $visible = true; // by default
    public $months;

    public function __construct($title, $description) {
        $this->setTitle($title);
        $this->description = $description;
    }

    public function setTitle($t) {
        if($t == '') {
            $this->title = 'N/A';
        } else {
            $this -> title = $t;
        }
    }

    public function getTitle() {
        return $this -> title;
    }

    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extra_months = $this->months % 12;

        if ($this -> months < 12) {
          return "$extra_months months <br>";
        } elseif ($extra_months == 0) {
          return "$years years <br>";
        } else {
          return "$years years and $extra_months months <br>";
        }
    }

    public function getDescription() {
        return $this->description;
    }
}