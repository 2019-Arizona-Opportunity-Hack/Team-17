<?php

define("CSS_DIR", "../css/");

class CSSCompressor {

  public function __construct(){}

  public function combine() {
    $css = '';
    $css_files = self::get_files();
    foreach ($css_files as $file){
      $css .= file_get_contents(CSS_DIR . $file);
    }
    return $css;
  }

  public function get_files() {
    return array_filter(scandir(CSS_DIR), [$this, 'filter_non_css']);
  }

  public function filter_non_css($file) {
    return preg_match("/\.css$/", $file);
  }

  public function compress($buffer) {
    //removes comments
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

    //removes tabs, spaces, newlines    
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

    return $buffer;
  }
}
