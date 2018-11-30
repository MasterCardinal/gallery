<?php

namespace Controller;
use Model\Resource\Bild;

class index {
  public function indexAction($params) {
    echo "<h1>indexAction</h1>";
    // Resource Model instanziieren
    $model = new Bild();

    // Bilder abrufen
    $bilder = $model->getBilder();
    var_dump($bilder);

    // TODO: Bilder darstellen (template)
  }

  public function loginAction($params) {
    echo "loginAction";
  }

  public function registerAction($params) {
    echo "registerAction";
  }

  public function logoutAction($params) {
    echo "logoutAction";
  }

  public function uploadAction($params) {
    echo "uploadAction";
  }
}
