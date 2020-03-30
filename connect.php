<?php

try {
      // ローカル接続
      $pdo = new PDO(
        'mysql:dbname=Sales;host=localhost;charset=utf8mb4',
        'root',
        '',
        array(
          // カラム型に合わない値がINSERTされようとしたときSQLエラーとする
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET SESSION sql_mode='TRADITIONAL'",
          // SQLエラー発生時にPDOExceptionをスローさせる
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          // プリペアドステートメントのエミュレーションを無効化する
          PDO::ATTR_EMULATE_PREPARES => false,
      )
      );
  
} catch(PDOException $e) {
  echo 'DB接続エラー: ' . $e->getMessage();
  var_dump($e);
}