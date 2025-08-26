  // Chart 1
  var ctx = document.getElementById('chart1').getContext('2d');
  var chart1 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['sdhsf', 'sdfsfs', 'sfsdfa', 'sdfsf', 'siueh'],
      datasets: [{
        label: '# of Somethings',
        data: [5, 7, 3, 4, 2], // Example data
        backgroundColor: [
          '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Chart 2
  var ctx2 = document.getElementById('chart2').getContext('2d');
  var chart2 = new Chart(ctx2, {
    type: 'line',
    data: {
      labels: ['hgfd', 'uytre', 'jhgfd', 'hgfd'],
      datasets: [{
        label: 'iuytre',
        data: [12, 9, 5, 3], // Example data
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 2,
        fill: true
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });