<template>
<main class="main">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Escritorio</a></li>
	</ol>
       <div class="app-content content">
	   <div class="content-wrapper">
      

		                <section id="chartjs-charts">
                    <!-- Line Chart -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Ventas</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pl-0">
                                        <div class="height-300">
                                            <canvas id="ventas"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Compras</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pl-0">
                                        <div class="height-300">
                                            <canvas id="ingresos"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <!--fin class row---->
                   <!--- inicio clas row--->
                   <div class="row">
                        <!-- Horizontal Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Compras-Ventas</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pl-0">
                                        <div class="height-300">
                                            <canvas id="cv"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Ventas</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pl-0">
                                        <div class="height-300">
                                            <canvas id="cvp"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---fin clas row--->
                </section>
		<!---div card-->
	</div>
</div>
</main>
</template>
<script >
	export default{
        data(){
          return{
          	varIngreso:null,
          	charIngreso:null,
          	ingresos:[],
          	varTotalIngreso:[],
          	varMesIngreso:[],

            varVenta:null,
            charVenta:null,
            ventas:[],
            varTotalVenta:[],
            varMesVenta:[],

            varVenta2:null,
            charVenta2:null,
            venta2s:[],
            varTotalVenta2:[],
            varMesVenta2:[],

          }
        },
        methods:{
        	//metodos obtener ingresos
            getIngresos(){
              let me = this;
              var url= '/dashboard';
              axios.get(url).then(function (response) {

                    var respuesta= response.data;
                    me.ingresos = respuesta.ingresos;
                    me.loadIngresos();
             
                  
                })
                .catch(function (error) {
                    console.log(error);
                });

            },

            //metodos obtener ingresos
            getVentas(){
              let me = this;
              var url= '/dashboard';
              axios.get(url).then(function (response) {

                    var respuesta= response.data;
                    me.ventas = respuesta.ventas;
                    me.loadVentas();
                   
                  
                })
                .catch(function (error) {
                    console.log(error);
                });

            },

            //metodos obtener ingresos
            getVentas_compras(){
              let me = this;
              var url= '/dashboard';
              axios.get(url).then(function (response) {

                    var respuesta= response.data;
                    me.ventas = respuesta.ventas;
                    me.ingresos = respuesta.ingresos; 
                    me.loadcompras_ventas();
                  
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            //metodos obtener ingresos
            getVentas_compras_pie(){
              let me = this;
              var url= '/dashboard';
              axios.get(url).then(function (response) {

                    var respuesta= response.data;
                    me.ventas2 = respuesta.ventas;
                    me.loadcompras_ventaspie();
                  
                })
                .catch(function (error) {
                    console.log(error);
                });

            },

         //metodo load ingreso
   loadIngresos(){
         	let me = this;
         	  me.ingresos.map(function(x){
              me.varMesIngreso.push(x.mes);
              me.varTotalIngreso.push(x.total);
         	});

       
        var $primary = '#7367F0';
			  var $success = '#28C76F';
			  var $danger = '#EA5455';
			  var $warning = '#FF9F43';
			  var $label_color = '#1E1E1E';
			  var grid_line_color = '#dae1e7';
			  var scatter_grid_color = '#f3f3f3';
			  var $scatter_point_light = '#D1D4DB';
			  var $scatter_point_dark = '#5175E0';
			  var $white = '#fff';
			  var $black = '#000';
        var $cafe = '#6F0F0F';
        var $verde = '#0F6F10';
        var $azul = '#0F436F';

			  var themeColors = [$primary, $success, $danger, $warning, $label_color,$scatter_point_light, $scatter_point_dark,$white,$black,$cafe,$verde,$azul];

         	  var horizontalChartctx = $("#ingresos");

  var horizontalchartOptions = {
    // Elements options apply to all of the options unless overridden in a dataset
    // In this case, we are setting the border of each horizontal bar to be 2px wide
    elements: {
      rectangle: {
        borderWidth: 2,
        borderSkipped: 'right',
        borderSkipped: 'top',
      }
    },
    responsive: true,
    maintainAspectRatio: false,
    responsiveAnimationDuration: 500,
    legend: {
      display: false,
    },
    scales: {
      xAxes: [{
        display: true,
        gridLines: {
          color: grid_line_color,
        },
        scaleLabel: {
          display: true,
        }
      }],
      yAxes: [{
        display: true,
        gridLines: {
          color: grid_line_color,
        },
        scaleLabel: {
          display: true,
        }
      }]
    },
    title: {
      display: true,
      text: 'Grafico Estadístico de Compras'
    }
  };
          var meses = me.varMesIngreso;
           meses[0]=["ENE"];
           meses[1]=["FEB"];
           meses[2]=["MAR"];
           meses[3]=["ABR"];
           meses[4]=["MAY"];
           meses[5]=["JUN"];
           meses[6]=["JUL"];
           meses[7]=["AGO"];
           meses[8]=["SEP"];
           meses[9]=["OCT"];
           meses[10]=["NOV"];
           meses[11]=["DIC"];

  // Chart Data
  var horizontalchartData = {
    labels: meses,
    datasets: [{
      label: "Total",
      data: me.varTotalIngreso,
      backgroundColor: themeColors,
      borderColor: "transparent"
    }]
  };

  var horizontalChartconfig = {
    type: 'horizontalBar',

    // Chart Options
    options: horizontalchartOptions,

    data: horizontalchartData
  };

  // Create the chart
  var horizontalChart = new Chart(horizontalChartctx, horizontalChartconfig);
			         				     
 },

  loadVentas(){
          let me = this;
            me.ventas.map(function(x){
            me.varMesVenta.push(x.mes);
            me.varTotalVenta.push(x.total);
          });

       
        var $primary = '#7367F0';
        var $success = '#28C76F';
        var $danger = '#EA5455';
        var $warning = '#FF9F43';
        var $label_color = '#1E1E1E';
        var grid_line_color = '#dae1e7';
        var scatter_grid_color = '#f3f3f3';
        var $scatter_point_light = '#D1D4DB';
        var $scatter_point_dark = '#5175E0';
        var $white = '#fff';
        var $black = '#000';
        var $cafe = '#6F0F0F';
        var $verde = '#0F6F10';
        var $azul = '#0F436F';
      

        var themeColors = [$primary, $success, $danger, $warning, $label_color,$scatter_point_light, $scatter_point_dark,$white, $black,$cafe,$verde,$azul  ];

             var barChartctx = $("#ventas");
             var barChartctx ="ventas";

        // Chart Options
        var barchartOptions = {
          // Elements options apply to all of the options unless overridden in a dataset
          // In this case, we are setting the border of each bar to be 2px wide
          elements: {
            rectangle: {
              borderWidth: 2,
              borderSkipped: 'left'
            }
          },
          responsive: true,
          maintainAspectRatio: false,
          responsiveAnimationDuration: 500,
          legend: { display: false },
          scales: {
            xAxes: [{
              display: true,
              gridLines: {
                color: grid_line_color,
              },
              scaleLabel: {
                display: true,
              }
            }],
            yAxes: [{
              display: true,
              gridLines: {
                color: grid_line_color,
              },
              scaleLabel: {
                display: true,
              },
              ticks: {
                stepSize: 15000
              },
            }],
          },
          title: {
            display: true,
            text: 'Grafico Estadístico de Ventas'
          },

        };
           var meses = me.varMesVenta;
           meses[0]=["ENE"];
           meses[1]=["FEB"];
           meses[2]=["MAR"];
           meses[3]=["ABR"];
           meses[4]=["MAY"];
           meses[5]=["JUN"];
           meses[6]=["JUL"];
           meses[7]=["AGO"];
           meses[8]=["SEP"];
           meses[9]=["OCT"];
           meses[10]=["NOV"];
           meses[11]=["DIC"];

        // Chart Data
        var barchartData = {
          labels: meses,
          datasets: [{
            label: "Ventas mensuales",
            data: me.varTotalVenta,
            backgroundColor: themeColors,
            borderColor: "transparent"
          }]
        };

        var barChartconfig = {
          type: 'bar',

          // Chart Options
          options: barchartOptions,

          data: barchartData
        };

        // Create the chart
        var barChart = new Chart(barChartctx, barChartconfig);
                           
 }, 

     loadcompras_ventas(){
          let me = this;
            me.ventas.map(function(x){
            me.varMesVenta.push(x.mes);
            me.varTotalVenta.push(x.total);
          });

            me.ingresos.map(function(x){
              me.varMesIngreso.push(x.mes);
              me.varTotalIngreso.push(x.total);
          });
          const meses = me.varMesVenta.concat(me.varMesIngreso);
           meses[0]=["ENE"];
           meses[1]=["FEB"];
           meses[2]=["MAR"];
           meses[3]=["ABR"];
           meses[4]=["MAY"];
           meses[5]=["JUN"];
           meses[6]=["JUL"];
           meses[7]=["AGO"];
           meses[8]=["SEP"];
           meses[9]=["OCT"];
           meses[10]=["OCT"];
           meses[11]=["NOV"];
           
           var mesess=["ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC"];
 

          var $primary = '#7367F0';
          var $success = '#28C76F';
          var $danger = '#EA5455';
          var $warning = '#FF9F43';
          var $label_color = '#1E1E1E';
          var grid_line_color = '#dae1e7';
          var scatter_grid_color = '#f3f3f3';
          var $scatter_point_light = '#D1D4DB';
          var $scatter_point_dark = '#5175E0';
          var $white = '#fff';
          var $black = '#000';

          var themeColors = [$primary, $success, $danger, $warning, $label_color];

          // Line Chart
          // ------------------------------------------

          //Get the context of the Chart canvas element we want to select
          var lineChartctx = $("#cv");

          // Chart Options
          var linechartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              position: 'top',
            },
            hover: {
              mode: 'label'
            },
            scales: {
              xAxes: [{
                display: true,
                gridLines: {
                  color: grid_line_color,
                },
                scaleLabel: {
                  display: true,
                }
              }],
              yAxes: [{
                display: true,
                gridLines: {
                  color: grid_line_color,
                },
                scaleLabel: {
                  display: true,
                }
              }]
            },
            title: {
              display: true,
              text: 'Grafico Estadístico de Totales'
            }
          };
   
          // Chart Data
          var linechartData = {
            labels: mesess,
            datasets: [ {
              data: me.varTotalVenta,
              label: "Ventas",
              borderColor: $success,
              fill: false
            },  {
              data: me.varTotalIngreso,
              label: "Compras",
              borderColor: $warning,
              fill: false
            }]
          };

          var lineChartconfig = {
            type: 'line',

            // Chart Options
            options: linechartOptions,

            data: linechartData
          };

          // Create the chart
          var lineChart = new Chart(lineChartctx, lineChartconfig);

     },
     loadcompras_ventaspie(){
            let me = this;
            me.ventas2.map(function(x){
            me.varMesVenta2.push(x.mes);
            me.varTotalVenta2.push(x.total);
          });
        var $primary = '#7367F0';
        var $success = '#28C76F';
        var $danger = '#EA5455';
        var $warning = '#FF9F43';
        var $label_color = '#1E1E1E';
        var grid_line_color = '#dae1e7';
        var scatter_grid_color = '#f3f3f3';
        var $scatter_point_light = '#D1D4DB';
        var $scatter_point_dark = '#5175E0';
        var $white = '#fff';
        var $black = '#000';
        var $cafe = '#6F0F0F';
        var $verde = '#0F6F10';
        var $azul = '#0F436F';
      
         var themeColors = [$primary, $success, $danger, $warning, $label_color,$scatter_point_light, $scatter_point_dark,$white, $black,$cafe,$verde,$azul  ];

           var meses = me.varMesVenta2;
           meses[0]=["ENE"];
           meses[1]=["FEB"];
           meses[2]=["MAR"];
           meses[3]=["ABR"];
           meses[4]=["MAY"];
           meses[5]=["JUN"];
           meses[6]=["JUL"];
           meses[7]=["AGO"];
           meses[8]=["SEP"];
           meses[9]=["OCT"];
           meses[10]=["NOV"];
           meses[11]=["DIC"];

       var pieChartctx = $("#cvp");

  // Chart Options
  var piechartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    responsiveAnimationDuration: 75000,
    title: {
      display: true,
      text: 'Grafico Estadístico de Ventas'
    }
  };

  // Chart Data
  var piechartData = {
    labels: meses,
    datasets: [{
      label: "My First dataset",
      data: me.varTotalVenta2,
      backgroundColor: themeColors,
    }]
  };

  var pieChartconfig = {
    type: 'pie',

    // Chart Options
    options: piechartOptions,

    data: piechartData
  };

  // Create the chart
  var pieSimpleChart = new Chart(pieChartctx, pieChartconfig);
          

      
         }



        
      
        },

        mounted(){
          this.getIngresos();
          this.getVentas();
          this.getVentas_compras();
          this.getVentas_compras_pie();
        }
	}
	
</script>