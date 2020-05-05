
// List.js 並び替え機能
//   1.CDN読み込み
//   2. <table id="items">のidを引数にクラスを呼び出す
//   3.ソートしたいヘッダーを<th class="sort" data-sort="amount">数量</th>と指定
//   4.ソートしたい要素のクラス名を<td class="amount"></td>と指定
//   5.<tbody class="list">とクラス名を指定
//   6.scriptタグ内のoptionでソートしたい要素名を追記

export function sortTable() {

  //項目用の配列を定義
  var array01 = [];
  var array02 = [];

  // テーブルの並び替え
  var options = {
    valueNames: [ 'category', 'name', 'jan', 'month', 'amount', 'proceeds']
  };
  
  // 販売実績テーブルの要素
  var results = new List('results', options);
  results.sort( 'month', {order : 'asc' });
  results.sort( 'amount', {order : 'desc' });
  results.sort( 'proceeds', {order : 'desc' });
  
  // 商品リストテーブルの要素
  var itemList = new List('items', options);
  itemList.sort( 'category', {order : 'desc' });
  itemList.sort( 'jan', {order : 'desc' });
  
  // labelsの値を取得
  $('.js-sales_month').each(function(){
    var amount01 = $(this).find('span').text();
    array01.push(amount01);
  })

  // dataの値を取得
  $('.js-proceeds').each(function(){
    var amount02 = $(this).find('span').text();
    array02.push(amount02);
  })

}