<?php
class Bootstrap {
  private $_controller = "";
  private $_action = "";
  private $params = array();

  public function __construct() {
    $this->_parseRequest();
  }

  private function _parseRequest() {
    $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    @list($controller, $action, $params) = explode('/', $path, 3);

    // Controller?
    $controller = (strlen($controller) > 0) ? $controller : 'index';
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
    $this->_controller = $ctrl;
  }
  private function setAction($action) {
    // ToDo: Welche Methode in Klasse xyz
    $actionMethod = sprintf("%sAction", strtolower($action));
    $reflection = new ReflectionClass($this->_controller);
    if (!$reflection->hasMethod($actionMethod)) {
      throw new InvalidArgumentException("Controller unbekannt: $ctrl");
    }
    $this->_controller = $ctrl;
  }
  private function setParams($params) {
    // ToDo: Parameter verarbeiten

  }

  public function run() {

  }
}
 ?>
