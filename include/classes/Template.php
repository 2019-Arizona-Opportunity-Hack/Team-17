<?php

class Template {

  private $page = null;

  public function __construct() {
    $this->compressCss();
    $this->ajaxManager();
    $pageUrl = $this->getPageUrl();

    // override some page urls
    $urlOverRide = [''  => 'homepage'];
    foreach ($urlOverRide as $key => $value){
      if ($key === $pageUrl){
        $pageUrl = $value;
      }
    }

    // stores all the details of any given page
    $this->page = $this->getPageData($pageUrl);
  }

  // allows me to manage ajax calls.
  private function ajaxManager(){
    $ajax = filter_input(INPUT_POST, 'ajax', FILTER_SANITIZE_NUMBER_INT);
    if ($ajax) {
      require_once('../include/Ajax.php');
      $ajax_object = new AjaxObject($_REQUEST);
      exit();
    }
  }

  public function compressCss() {
    require_once('../include/css_compressor.php');
    $CSSC = new CSSCompressor();
    $css = $CSSC->compress($CSSC->combine());
    $css_file = fopen($_SERVER['DOCUMENT_ROOT'] . '/css/style.css', 'w');
    fwrite($css_file, $css);
    fclose($css_file);
  }

  public function getPageUrl() {
    $parsedUrl = parse_url(filter_var(getEnv('REQUEST_URI'), FILTER_SANITIZE_URL));
    return ltrim($parsedUrl['path'], "/");
  }

  public function getPageData($pageUrl) {
    return Functions::query_select(
      'SELECT * FROM page WHERE url = ?'
    , $pageUrl);
  }

  public function printHead() {
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<title>' . $this->page['title'] . '</title>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<link rel="shortcut icon" href="#" />';
    echo '<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,900&display=swap" rel="stylesheet">';
    echo '<link rel="stylesheet" href="/css/style.css">';
    echo '</head>';
    echo '<body>';
  }

  public function printTail() {
    echo '<script src="/main.js"></script>';
    echo '</body>';
    echo '</html>';
  }

  public function print404() {
    echo '<div class="dashboard_wrapper">';
    echo '<h1>404</h1>';
    echo '<p>';
    echo 'Are you lost?';
    echo '</p>';
    echo 'Let\'s send you <a href="/">Home</a>';
    echo '<div class="zuri_portrait_wrapper">';
    echo '<a href="/">';
    echo '<img src="/images/zuri.png" alt="Home">';
    echo '</a>';
    echo '</div>';
    echo '</div>';
  }

  public function run() {
    // head
    $this->printHead();

    // body
    echo '<div id="zuris-circle">';
    $customScript = ucwords(str_replace('_', ' ', $this->page['custom_script']));
    $phpFile = '../include/classes/' . $customScript;
    $className = str_replace('.php', '', $customScript);
    if (!empty($customScript) && file_exists($phpFile)) {
      require_once($phpFile);
      $pageTemplate = new $className();
      $pageTemplate->run();
    }
    else {
      $this->print404();
    }
    echo '</div>'; //ends zuris-circle

    // tail
    $this->printTail();
  }

}
