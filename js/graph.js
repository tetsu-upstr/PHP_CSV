export function drawChart() {

  var label_month = [];
  var sales_data = [];

  // labelsの値を取得
  $('.js-sales_month').each(function(){
    var amount01 = $(this).find('span').text();
    label_month.push(amount01);
  })
  // dataの値を取得
  $('.js-proceeds').each(function(){
    var amount02 = $(this).find('span').text();
    sales_data.push(amount02);
  })

  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {

    // 作成したいチャートタイプ
    type: 'bar',

    // グラフのデータ
    data: {
        // labels: ['1月', '2月', '3月'],
        labels: label_month,

        datasets: [{
            label: "販売実績の推移",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: sales_data
        }]
    },

    // 設定オプション
    options: { 
      responsive: false,
      scales: {
        // 縦軸の設定
        yAxes: [{
          ticks: {
            suggestedMin: 0,
            suggestedMax: 10000,
            stepSize: 1000
          }
        }]
      }
     }
  });

  // < Chart.js MITライセンス >
  // Copyright (c) 2018 Chart.js Contributors
  // Released under the MIT license
  // https://opensource.org/licenses/MIT
  
}
