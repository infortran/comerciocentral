@extends('backend.layout')

@section('content')
<div class="container">
	
		<h1>Marcas
			<button class="addButton float-right" data-target="#modal-create-marca" data-toggle="modal">
				<i class="fa fa-plus-square"></i>
				Nueva marca
			</button>
		</h1>
		<!-- ============================
          FORMULARIO DE BUSQUEDA
		  ================================= -->
		    <div class="container" style="margin-top: 20px">
		        <div class="row">  
		            <form class="search-form">
		                <input name="search" type="text" class="textbox" placeholder="Buscar">
		                <button title="Search" value="" type="submit" class="button">
		                    <i class="fa fa-search"></i>
		                </button>
		            </form>       
		        </div>
		    </div>
		        
		        
		    @if($search)
		        <div class="alert alert-info">Resultados para tu busqueda <strong>"{{$search}}"</strong></div>
		    @endif
		        <!--.fin FORM busqueda-->
@include('backend.marcas.modal-create')

@foreach($marcas as $marca)
	@include('backend.marcas.modal-edit')
	@include('backend.marcas.modal-destroy')
@endforeach
		        <hr>
		  <!---....FIN FORMULARIO BUSQUEDA.....-->
		<div class="col-10 mx-auto">
			<table class="table table-bordered">
				<thead>
				    <tr>
				      <th width="20px" scope="col">ID</th>
				      <th width="70%" scope="col">Marca</th>
				      <th scope="col">Acciones</th>
				    </tr>
				</thead>
				<tbody>
					@foreach($marcas as $marca)
				    <tr>
				      <th scope="row">{{$marca->id}}</th>
				      <td>{{$marca->marca}}</td>
				      <td><button class="btn btn-warning"
				      	data-toggle="modal" data-target="#modal-edit-marca{{$marca->id}}">
				      	<i class="fa fa-edit"></i>
				      	Editar
				      	</button>
				      	<button class="btn btn-danger"
				      		data-toggle="modal"
				      		data-target="#modal-destroy-marca{{$marca->id}}">
				      		<i class="fa fa-minus-circle"></i>
				      		Eliminar
				      	</button></td>
				    </tr>
				    @endforeach
				</tbody>
			</table>
		</div>
	
</div>
@endsection