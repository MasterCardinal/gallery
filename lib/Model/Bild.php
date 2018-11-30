<?php
namespace Model;

class Bild {
  private $id = 0;
  private $name = "";
  private $path = "";

  // Getter und Setter für die drei Parameter id, name und path
  public function getId() {
    return $this->id;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getName() {
    return $this->name;
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function getPath() {
    return $this->path;
  }
  public function setPath($path) {
    return $this->path = $path;
  }
}
