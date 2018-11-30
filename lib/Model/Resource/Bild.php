<?php

namespace Model\Resource;
use \Model\Bild as BildModel;

class Bild extends Base {
  public function getBilder() {
    $sql = 'SELECT id, name, path FROM bilder';
    $dbResult = $this->connect()->query($sql);

    $bilder = array();
    while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC)) {
      // $row[id => 1, name => xyz.jpg, path => abc.jpg]
      $bild = new BildModel();
      $bild->setId($row['id']);
      $bild->setName($row['name']);
      $bild->setPath($row['path']);

      $bilder[] = $bild;
    }
    return $bilder;
  }
}
