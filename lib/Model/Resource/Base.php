<?php

namespace Model\Resource;

class Base {
  protected function connect() {
    $dataSource = "mysql:host=localhost;dbname=gallery";
    //return new \PDO($dataSource, "gallery", "galery1234");
    return new \PDO($dataSource, "root", "");
  }
}
