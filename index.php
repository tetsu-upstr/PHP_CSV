<?php
require 'header.php';
require 'function/search.php';
?>

<body>
  <table class="function-table">
    <tr>
      <th>検索</th>
      <th>集計期間</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <form action="index.php" method="POST">
      <td>
        <input type="text" name="name" placeholder="品名">
        <input type="text" name="store" placeholder="店名">
      </td>
      <td>
        <input type="date" name="start">〜<input type="date" name="end">
        <input type="submit" name="search" class="btn" value="検索">
      </td>
      <td>
        <button class="btn"><a href="item_input.php">商品登録</a></button>
      </td>
      <td>
        <button class="btn cp_tooltip"><a href="csv.php">取り込み</a>
        <span class="cp_tooltiptext">CSVファイルを読み込みます</span></i></button>
      </td>
      <td>
        <button class="btn"><a href="#">POP</a></button>
      </td>
    </form>
  </table>


<p class="table-title"><i class="fas fa-money-check"></i> 販売実績</p>
<table class="item-table">
  <tr>
    <th>品名</th>
    <th>販売月</th>
    <th>数量</th>
    <th>単価</th>
    <th>売上金額</th>
    <th>店舗</th>
  
    <?php
    if(isset($_POST['search'])) {
      foreach($result as $row) {
        echo '<tr>';
        echo '<td>' . $row['item_name'] .'</td>';
        echo '<td>' . $row['sale_month'] .'</td>';
        echo '<td>' . $row['amount'] .'</td>';
        echo '<td>' . $row['unit_price'] .'</td>';
        echo '<td>' . $row['proceeds'] .'</td>';
        echo '<td>' . $row['store'] .'</td>';
        echo '</tr>';
      }
    }
    ?>

</table>


<?php

// 商品リストの呼び出しSQL
$sql = "SELECT * FROM item";
$result = $pdo->query($sql);
$result->execute();

?>

<div class="item-title">
<p class="table-title"><i class="fas fa-save"></i> 商品リスト</p>
<button class="btn"><a href="">商品マスタ編集</a></button>
</div>
<table class="item-table">
  <tr>
    <th></th>
    <th>カテゴリ</th>
    <th>品名</th>
    <th>JAN</th>
    <th>規格</th>
    <th>入数</th>
    <th>定価</th>
    <th>賞味期限</th>
    <th>商品サイズ（幅*高*奥）</th>
  
    <?php
    foreach($result as $row) {
      echo '<tr><form action="index.php" method="POST">';
      echo '<td><input class="check" type="checkbox" name="check"></td>';
      echo '</form>';
      echo '<td>' . $row['category'] .'</td>';
      echo '<td>' . $row['item_name'] .'</td>';
      echo '<td>' . $row['jan'] .'</td>';
      echo '<td>' . $row['standard'] .'</td>';
      echo '<td>' . $row['number_contained'] .'</td>';
      echo '<td>' . $row['regular_price'] . '円' .'</td>';
      echo '<td>' . $row['expiration_date'] . '日' .'</td>';
      echo '<td>' . $row['size'] .'mm' . '</td>';
      echo '</tr>';
    }
    ?>

</table>

</body>
</html>