<?php
require_once('config/index.php');

$Files = new Files();

switch ($_POST['command']) {
  case 'read_log':
    echo $Files->read();
    break;

  case 'save_tmp':
    echo $Files->save_tmp($_POST['text']);
    break;

  case 'read_tmp':
    echo $Files->read(TMP_LOG);
    break;
  
  default:
    break;
}
