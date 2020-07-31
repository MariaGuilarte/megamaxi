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
			font-family: sans-serif !important;
			font-size: 0.875rem;
			font-weight: normal;
			line-height: 1.5;
			color: #151b1e;           
		}
		h1,h2,h3,h4 {
			margin-bottom: 0;
		}
		h1 {
			font-size: 24px;
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
			vertical-align: middle;
			border-top: 1px solid #c2cfd6;
		}
		.table-bordered thead th {
			vertical-align: bottom;
			border-bottom: 2px solid #c2cfd6;
		}
		.table-bordered thead th, .table-bordered thead td {
			border-bottom-width: 2px;
		}
		.table-bordered th, .table-bordered td {
			border: 1px solid #c2cfd6;
		}
		.table-bordered td:last-child {
			text-align: center;
		}
		th, td {
			display: table-cell;
			vertical-align: middle;
			text-transform: capitalize;
		}
		th {
			font-weight: bold;
			text-align: center;
		}
		th:first-child {
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
		.col-6 {
			display: inline-block;
			width: 49%;
		}
		.text-right {
			text-align: right;
		}
	</style>
</head>
<body>
	<div id="logo">
		<img src="img/logo2.png" alt="incanatoIT" id="imagen" style="width: 150px; height: 150px;">
	</div>
	
	<div style="border: 1px solid black; border-radius: 3px; padding: 15px;">
		<div class="col-6">
			<h1>Lista de Productos</h1>
		</div>
		<div class="col-6 text-right">
			<h3>{{now()}}</h3>
		</div>
	</div>
	
	<div>
		<div>
			<table class="table table-striped table-bordered table-sm" style="width:100%"  border="1">
				<thead>
					<tr>
						<th>Código</th>
						<th>Categoría</th>
						<th>Producto</th>
						<th>Precio</th>
						<th>Stock</th>
						<th>Descripción</th>
						<th>Estado</th>
					</tr>
				</thead>
				<tbody>
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
		<p><strong>Total de registros:</strong>{{$cont}}</p>
	</div>
</body>
</html>