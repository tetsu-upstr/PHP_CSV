// < Chart.js MITライセンス >
// Copyright (c) 2018 Chart.js Contributors
// Released under the MIT license
// https://opensource.org/licenses/MIT

$(function(){

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

  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    // 作成したいチャートのタイプ
    type: 'bar',

    // データセットのデータ
    data: {
        // labels: ['1月', '2月', '3月'],
        labels: array01,
        datasets: [{
            label: "販売実績の推移",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: array02
        }]
    },

    // ここに設定オプションを書きます
    options: { responsive: false }
  });

});