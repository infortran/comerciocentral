@extends('backend.layout')

@section('content')
<div class="container">
	
		<h1>Categorias
			<button class="addButton float-right" data-target="#modal-create-categoria" data-toggle="modal">
				<i class="fa fa-plus-square"></i>
				Nueva categoria
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
@include('backend.categorias.modal-create')

@foreach($categorias as $categoria)
	@include('backend.categorias.modal-edit')
	@include('backend.categorias.modal-destroy')
@endforeach
		        <hr>
		  <!---....FIN FORMULARIO BUSQUEDA.....-->
		<div class="col-10 mx-auto">
			<table class="table table-bordered">
				<thead>
				    <tr>
				      <th width="20px" scope="col">ID</th>
				      <th width="70%" scope="col">Categoria</th>
				      <th scope="col">Acciones</th>
				    </tr>
				</thead>
				<tbody>
					@foreach($categorias as $categoria)
				    <tr>
				      <th scope="row">{{$categoria->id}}</th>
				      <td>{{$categoria->categoria}}</td>
				      <td><button class="btn btn-warning"
				      	data-toggle="modal" data-target="#modal-edit-cat{{$categoria->id}}">
				      	<i class="fa fa-edit"></i>
				      	Editar
				      	</button>
				      	<button class="btn btn-danger"
				      		data-toggle="modal"
				      		data-target="#modal-destroy-cat{{$categoria->id}}">
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