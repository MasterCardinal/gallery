<?php
class Bootstrap {
  private $controller = "";
  private $action = "";
  private $params = array();

  public function __construct() {
    $this->_parseRequest();
  }

  // Die URI aus dem Request zerlegen.
  private function _parseRequest() {
    $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'); // Den ersten Slash entfernen
    @list($controller, $action, $params) = explode('/', $path, 3);

    // Controller?
    $controller = (strlen($controller) > 0) ? $controller : 'index'; // strlen() ermittelt die Stinglänge
    $this->setController($controller);
    // Action
    $action = (strlen($action) > 0) ? $action : 'index';
    $this->setAction($action);
    // Parameter?
    if (isset($params)) {
      $this->setParams($params);
    }
  }

  private function setController($controller) {
    // ToDo: Welche Klasse?
    $ctrl = sprintf("\\Controller\\%s", ucfirst(strtolower($controller)));
    if (!class_exists($ctrl)) {
      throw new InvalidArgumentException("Controller unbekannt: $ctrl");
    }
    $this->controller = $ctrl;
  }
  private function setAction($action) {
    // ToDo: Welche Methode in Klasse xyz
    $actionMethod = sprintf("%sAction", strtolower($action));
    $reflection = new ReflectionClass($this->controller);
    if (!$reflection->hasMethod($actionMethod)) {
      throw new InvalidArgumentException("$this->controller hat keine Action: $action");
    }
    $this->action = $actionMethod;
  }
  private function setParams($params) {
    // ToDo: Parameter verarbeiten
    // /index/view/id/1/filter/name
    // params: id => 1, filter => name
    $splitted = explode('/', $params);
    if (count($splitted) % 2 > 0) {
      throw new InvalidArgumentException("Parameteranzahl ungültig");
    }
    $paramArray = array();
    $lastIndex =0;

    for ($i=0; $i<count($splitted); $i++) {
      if ($i % 2 > 0) {
        $paramArray[$splitted[$lastIndex]] = $splitted[$i];
      }
      $lastIndex = $i;
    }
    $this->_params = $paramArray;

  }

  public function run() {
    $ctrlObj = new $this->controller;
    $ctrlObj->{$this->action}($this->params);
  }
}
 ?>
