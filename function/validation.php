<?php

// 商品登録
function validatation_item($data) {

  require './connect.php';

  $error = [];
  
  if (($data['category'] === '')) {
    $error[] = '「カテゴリ」を選択してください。';
  }

  if (empty($data['item_name']) || 30 < mb_strlen($data['your_name'])) {
    $error[] = '「品名」は30文字以内で入力してください。';
  }

  if (empty($data['jan']) || 13 !== strlen($data['jan'])) {
    $error[] = '「JAN」が正しく入力されていません。';
  }

  if (!empty($data['jan'])) {
    // JAN(ユニーク)の重複確認
    $stmt = $pdo->prepare("SELECT * FROM item WHERE jan = :jan limit 1");
    $stmt->execute(array(':jan' => $data['jan']));
    $result = $stmt->fetch();

    if ($result > 0) {
      $error[] = '「JAN」は既に登録されています。';
    }
  
  }

  if (empty($data['standard'])) {
    $error[] = '「規格」は必ず入力してください。';
  }

  if (empty($data['number_contained'])) {
    $error[] = '「入数」は必ず入力してください。';
  }

  if (!empty($data['number_contained']) && preg_match('/入/', $data['number_contained'])) {
    $error[] = '「入数」は「入」を含まずに入力してください。';
  }

  if (empty($data['regular_price'])) {
    $error[] = '「定価」は必ず入力してください。';
  }

  if (!empty($data['regular_price']) && preg_match('/円/', $data['regular_price'])) {
    $error[] = '「定価」は「円」を含まずに入力してください。';
  }
  
  if (empty($data['expiration_date'])) {
    $error[] = '「賞味期限」は必ず入力してください。';
  }

  if (!empty($data['expiration_date']) && preg_match('/日/', $data['expiration_date'])) {
    $error[] = '「賞味期限」は「日」を含まずに入力してください。';
  }

  if (empty($data['size'])) {
    $error[] = '「商品サイズ」は必ず入力してください。';
  }

  return $error;
}