@extends('backend.layout')

@section('content')
    <section>
        <h1>Estado de Ordenes</h1>
        <!-- ============================
          FORMULARIO DE BUSQUEDA
  ================================= -->
        <div class="container" style="margin-top: 20px">
            <div class="row">

                <form class="search-form">
                    <input name="search" type="text" class="textbox" placeholder="Ingrese el N° de Orden">
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
        <div class="container">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>N° Orden</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Tipo de pago</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($ordenes as $orden)
                        <tr>
                            <td>{{$orden->id}}</td>
                            <td>{{$orden->nombre}}</td>
                            <td>{{$orden->direccion}}</td>
                            <td>{{$orden->nombre}}</td>
                            <td>{{$orden->estado}}</td>
                            <td><a href="{{url('/admin/orden', $orden->id)}}">Ver detalles</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$ordenes->links()}}
            </div>
        </div>
    </section>
@endsection
