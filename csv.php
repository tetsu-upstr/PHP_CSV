<?php

// $row = 1;
// if (($handle = fopen("csv/test.csv", "r")) !== FALSE) {
//     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//         $num = count($data);
//         echo "<p> $num fields in line $row: <br /></p>\n";
//         $row++;
//         for ($c=0; $c < $num; $c++) {
//             echo $data[$c] . "<br />\n";
//         }
//     }
//     fclose($handle);
// }

// ファイルの読み込み
$lines = file('csv/test.csv');

// $line に一行ずつ入る
foreach($lines as $line){

  //カンマで区切る
  $data = explode(',',$line);

  echo '<p>商品リスト</p>';
	echo ' No.',$data[0];
	echo ' 商品名：',$data[1];
	echo ' 数：',$data[2];
	echo ' 単価：',$data[3];
  
}