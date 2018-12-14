<?php

namespace View;

class Template {
  protected $tmplFile = null;

  public function __construct(string $tmplFile) {
    $this->tmplFile = $tmplFile;
  }

  public function renderTemplate(array $data) {
    extract $data;

    ob_start();
    require_once BASEPATH . '/template' . $this->tmplFile;
  }
}
