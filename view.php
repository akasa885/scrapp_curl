<?php
include 'simple_html_dom.php';
if (!empty($_POST)) {
  $curl = curl_init();
  $src = strtolower($_POST['src']);
  $temp = explode(" ",$src);
  $src = "";
  foreach ($temp as $value) {
    if ($src == "") {
      $src = $value;
    }else {
      $src .= "+".$value;
    }
  }
  curl_setopt($curl,CURLOPT_URL,'https://www.google.com/search?q='.$src);
  curl_setopt($curl,CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($curl);
  curl_close($curl);

  // echo $result;

  $domResult = new simple_html_dom();
  $domResult->load($result);

  foreach ($domResult->find('a[href^=/url?]') as $link) {
    if(!empty($link->plaintext))echo $link->plaintext.'<br>';
  }
}
 ?>
