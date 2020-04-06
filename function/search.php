<?php
  require './connect.php';

  // 指定した名前の変数を外部から受け取りフィルタリングする
  // 空だった場合はnull、値が入っている場合は送信された値になる
  $name = filter_input(INPUT_POST, 'name');
  $store = filter_input(INPUT_POST, 'store');
  $start = filter_input(INPUT_POST, 'start');
  $end = filter_input(INPUT_POST, 'end');

  if (!isset($data['search'])) {

    // 基本SQLは「WHERE 1」で全件表示にして検索値によって条件を足す
    $sql = "SELECT * , DATE_FORMAT(month, '%Y年%m月') as sale_month FROM sales_result WHERE 1 ";
    
    // 検索文字を投入する為の箱を用意
    $data = [];

    // 品名検索
    if (!empty($name)) {
      $sql .= "AND item_name LIKE ? ";
      $data[] = "%".$name."%";
    }

    // 店名検索
    if (!empty($store)) {
      $sql .= "AND store LIKE ? ";
      $data[] = "%".$store."%";
    }

    // 集計期間の指定
    if (!empty($start)) {
      $sql .= "AND month >= ? ";
      $data[] = $start;
    }

    if (!empty($end)) {
      $sql .= "AND month <= ? ";
      $data[] = $end;
    }

    // データがない場合は検索しない
    if(count($data) === 0) {
      $sql .= "AND 0";
    }

    // 売上金額で並び替え
    $sql .= " ORDER BY proceeds DESC";

   

  }

  $result = $pdo->prepare($sql);
  $result->bindValue(':item_name', $name, PDO::PARAM_STR);
  $result->bindValue(':store', $store, PDO::PARAM_STR);
  $result->execute($data);

  // var_dump($result);

  // ヒット件数を表示
  $count = $result->rowCount();
  if ($count > 0) {
    echo '<p class="table-title">' . $count.'件のデータが登録されています。</p>';
  }