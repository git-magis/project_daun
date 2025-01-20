// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
// var ctx = document.getElementById("myPieChart");
// var myPieChart = new Chart(ctx, {
//   type: 'doughnut',
//   data: {
//     labels: ["Flamboyan", "Mahoni", "Akasia", "Biola Cantik", "Angsana", "Bungur", "Pinus", "Suren", "Bambu Tali", "Bambu Haur Koneng", "Bambu Payung"],
//     datasets: [{
//       data: [9, 30, 5, 5, 1, 3, 2, 1, 16, 2, 6],
//       backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#C9883D', '#A7D037', '#30B9CE', '#7571E2', '#C246BC', '#CC6B7F', '#89C3CC', '#3B3128'],
//       hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
//       hoverBorderColor: "rgba(234, 236, 244, 1)",
//     }],
//   },
//   options: {
//     maintainAspectRatio: false,
//     tooltips: {
//       backgroundColor: "rgb(255,255,255)",
//       bodyFontColor: "#858796",
//       borderColor: '#dddfeb',
//       borderWidth: 1,
//       xPadding: 15,
//       yPadding: 15,
//       displayColors: false,
//       caretPadding: 10,
//     },
//     legend: {
//       display: false
//     },
//     cutoutPercentage: 80,
//   },
// });

var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Flamboyan", "Mahoni", "Akasia", "Biola Cantik", "Angsana", "Bungur", "Pinus", "Suren", "Bambu Tali", "Bambu Haur Koneng", "Bambu Payung"],
    datasets: [{
      data: [9, 30, 5, 5, 1, 3, 2, 1, 16, 2, 6],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#C9883D', '#A7D037', '#30B9CE', '#7571E2', '#C246BC', '#CC6B7F', '#89C3CC', '#3B3128'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

// const chartsData = json_encode($chartsData);
// console.log(chartsData);

// chartsData.forEach((chart, index) => {
//     const ctx = document.getElementById(`chart-${index}`);
//     const labels = chart.data.map(item => item.name);
//     const data = chart.data.map(item => item.count);

//     new Chart(ctx, {
//         type: 'doughnut',
//         data: {
//             labels: labels,
//             datasets: [{
//                 data: data,
//                 backgroundColor: [
//                     '#4e73df', '#1cc88a', '#36b9cc', '#C9883D', '#A7D037',
//                     '#30B9CE', '#7571E2', '#C246BC', '#CC6B7F', '#89C3CC'
//                 ],
//                 hoverBackgroundColor: [
//                     '#2e59d9', '#17a673', '#2c9faf'
//                 ],
//                 hoverBorderColor: "rgba(234, 236, 244, 1)",
//             }],
//         },
//         options: {
//             maintainAspectRatio: false,
//             plugins: {
//                 tooltip: {
//                     callbacks: {
//                         label: (context) => `${context.label}: ${context.raw} pohon`,
//                     }
//                 }
//             }
//         }
//     });
// });



// var ctx = document.getElementById("myPieChart2");
// var myPieChart = new Chart(ctx, {
//   type: 'doughnut',
//   data: {
//     labels: ["Flamboyan", "Mahoni", "Kamboja", "Biola Cantik", "Angsana", "Trembesi", "Bintaro", "Suren", "Kupu-kupu", "Tanjung", "Glodogan Tiang"],
//     datasets: [{
//       data: [10, 16, 2, 10, 4, 1, 3, 1, 2, 4, 12],
//       backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#C9883D', '#A7D037', '#30B9CE', '#7571E2', '#C246BC', '#CC6B7F', '#89C3CC', '#3B3128'],
//       hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
//       hoverBorderColor: "rgba(234, 236, 244, 1)",
//     }],
//   },
//   options: {
//     maintainAspectRatio: false,
//     tooltips: {
//       backgroundColor: "rgb(255,255,255)",
//       bodyFontColor: "#858796",
//       borderColor: '#dddfeb',
//       borderWidth: 1,
//       xPadding: 15,
//       yPadding: 15,
//       displayColors: false,
//       caretPadding: 10,
//     },
//     legend: {
//       display: false
//     },
//     cutoutPercentage: 80,
//   },
// });
