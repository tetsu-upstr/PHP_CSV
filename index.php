<?php require 'header.php'; ?>

<body>
<?php

// 売上実績の検索
if(isset($_POST['search'])) {

  // 全件検索
  if (empty($_POST['name']) && empty($_POST['store'])) {
    $sql = "SELECT item_name, DATE_FORMAT(month, '%Y年%m月') as sale_month, SUM(amount) as count, unit_price, store FROM sales_result ";
  }

  // 品名と店舗の検索
  if (!empty($_POST['name']) && !empty($_POST['store'])) {
    $name = $_POST['name'];
    $store = $_POST['store'];
    $sql = "SELECT item_name, DATE_FORMAT(month, '%Y年%m月') as sale_month, SUM(amount) as count, unit_price, store FROM sales_result WHERE item_name LIKE '%{$name}%' AND store LIKE '%{$store}%' ";
    // var_dump($sql);
  }
    
  // 品名検索
  if (!empty($_POST['name']) && empty($_POST['store'])) {
    $name = $_POST['name'];
    $sql = "SELECT item_name, DATE_FORMAT(month, '%Y年%m月') as sale_month, SUM(amount) as count, unit_price, store FROM sales_result WHERE item_name LIKE '%{$name}%' ";
  }

  // 店舗検索
  if (!empty($_POST['store']) && empty($_POST['name'])){
    $store = $_POST['store'];
    $sql = "SELECT item_name, DATE_FORMAT(month, '%Y年%m月') as sale_month, SUM(amount) as count, unit_price, store FROM sales_result WHERE store LIKE '%{$store}%' ";
  }

  // SQL共通の整列条件
  $sql .= " GROUP BY item_name, store, DATE_FORMAT(month, '%Y年%m月') ORDER BY month";

  $result = $pdo->prepare($sql);
  $result->bindValue(':item_name', $name, PDO::PARAM_STR);
  $result->bindValue(':store', $store, PDO::PARAM_STR);
  $result->execute();
}

// 集計期間の指定
if(isset($_POST['period_search'])) {

  $sql = "SELECT item_name, DATE_FORMAT(month, '%Y年%m月') as sale_month, SUM(amount) as count, unit_price, store FROM sales_result";

  if($_POST['start'] == "" && $_POST['end'] == "") {
    $sql .= " GROUP BY item_name, store, DATE_FORMAT(month, '%Y年%m月') ORDER BY month";
  } else {
    $start = $_POST['start'];
    $end = $_POST['end'];
    $sql .= " WHERE month BETWEEN '$start' AND '$end' GROUP BY DATE_FORMAT(month, '%Y年%m月') ORDER BY month";
  }

  $result = $pdo->prepare($sql);
  // $result->bindValue(':item_name', $store, PDO::PARAM_STR);
  // $result->bindValue(':store', $end, PDO::PARAM_STR);
  $result->execute();

}

?>

  <table class="function-table">
    <tr>
      <th class="th-2">検索</th>
      <th class="th-2">集計期間</th>
      <th class="th-3"></th>
      <th class="th-3"></th>
    </tr>
    <form action="index.php" method="POST">
      <td>
        <input type="text" name="name" placeholder="品名">
        <input type="text" name="store" placeholder="店名">
        <input type="submit" name="search" class="btn" value="検索">
      </td>
    </form>
    
    <form action="index.php" method="POST">
      <td><input type="date" name="start">〜<input type="date" name="end">
      <input type="submit" name="period_search" class="btn" value="検索"></td>
      <td><button class="btn"><a href="#">商品登録</a></button></td>
      <td><button class="btn cp_tooltip"><a href="#">取り込み</a>
      <span class="cp_tooltiptext">CSVファイルを読み込みます</span></i></button></td> </tr>
    </form>
  </table>




<p><i class="fas fa-money-check"></i> 販売実績</p>
<table class="item-table">
  <tr>
    <th>品名</th>
    <th>販売月</th>
    <th>数量</th>
    <th>単価</th>
    <th>売上金額</th>
    <th>店舗</th>
  
    <?php
    foreach($result as $row) {
      echo '<tr>';
      echo '<td>' . $row['item_name'] .'</td>';
      echo '<td>' . $row['sale_month'] .'</td>';
      echo '<td>' . $row['count'] .'</td>';
      echo '<td>' . $row['unit_price'] .'</td>';
      echo '<td>' . number_format($row['unit_price'] * $row['count']) .'</td>';
      echo '<td>' . $row['store'] .'</td>';
      echo '</tr>';
    }
    ?>

</table>

<?php

// 商品リスト
$sql = "SELECT * FROM item";
$result = $pdo->prepare($sql);
$result->execute();

?>

<p><i class="fas fa-save"></i> 商品リスト</p>
<table class="item-table">
  <tr>
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
      echo '<tr>';
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