var currentURL = window.location.href;
var host = window.location.hostname;
if (currentURL.includes("http://" + host + "/juniorPizza/inicio")) {
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Función para obtener los datos mediante AJAX
  function getDataAndDrawChart() {
    // Realizar una solicitud AJAX al archivo PHP
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'views/chart.php?accion=vendido', true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Convertir la respuesta JSON en un objeto JavaScript
        var data = JSON.parse(xhr.responseText);

        // Procesar los datos para el gráfico
        var labels = data.map(function (item) {
          return item.nombre;
        });
        var values = data.map(function (item) {
          return item.total_vendido;
        });

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: labels,
            datasets: [{
              data: values,
              backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
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
      }
    };
    xhr.send();
  }


  // Llamar a la función para obtener los datos y dibujar el gráfico cuando se cargue la página
  getDataAndDrawChart();
}
