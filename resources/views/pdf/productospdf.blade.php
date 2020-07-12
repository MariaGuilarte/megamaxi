<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Reporte de Productos</title>
	<style type="text/css">
		body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;           
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
        .centro{
            float:center;
        }
	</style>
</head>
<body>
  
	<div >
        <div style="position: relative; padding: 10px;  top:10px; left: 200px;">
        <h1 style="align:center"> <span >Lista de Productos</span> </h1><br>
       
        </div>
         <div style="position: relative; padding: 10px;  top:-180px; left: -50px;">
        <div id="logo">
                <img src="img/logo2.png" alt="incanatoIT" id="imagen">
            </div>
        </div>
      
	</div>
	<div>
		 <div style="position: relative; padding: 10px;  top: -200px; left: -10px;">
         <h3> <span class="derecha">{{now()}}</span> </h3><br><br>

		<table class="table table-striped table-bordered table-sm" style="width:100%"  border="1">
        <thead style="background-color: red">
            <tr>
          
                <th>CÓDIGO</th>
                <th>Categoría</th>
                <th>PRODUCTO</th>
                <th>PRECIO</th>
                <th>STOCK</th>
                <th>DESCRIPCIÓN</th>
                <th>ESTADO</th>
         
            </tr>
        </thead>
        <tbody style="background-color: #134E80">
        	@foreach ($productos as $p)
            <tr>
                 <td>{{$p->codigo}}</td>
                 <td>{{$p->nombre_categoria}}</td>
                 <td>{{$p->nombre}}</td>
                 <td>{{$p->precio_venta}}</td>
                 <td>{{$p->stock}}</td>
                 <td>{{$p->descripcion}}</td>
                 <td>{{$p->estado}}</td>
              
            </tr>
            @endforeach
        </tbody>
    </table>
   </div>
	</div>
	<div class="izquierda">
		<p><strong>Total de registros:</strong>{{$cont}} </p>
	</div>

</body>
</html>