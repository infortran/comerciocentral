@extends('backend.layout')

@section('content')

        <h1>Estado de Ordenes</h1>

        <div class="container">
            <div class="row text-center">
                <div class="col-8 mx-auto col-md-3">
                    <div class="card" style="background: #194ede;color:#ffffff">
                        <div class="card-body">
                            <i class="fa fa-calendar-day fa-3x"></i>
                            <p><strong>Ordenes del dia</strong></p>
                            <h2>{{$count_ordenes}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-8 mx-auto col-md-3">
                    <div class="card" style="background: #7c00cd; color:#fff">
                        <div class="card-body">
                            <i class="fa fa-boxes fa-3x"></i>
                            <p><strong>Por entregar</strong></p>
                            <h2>6</h2>
                        </div>
                    </div>
                </div>
                <div class="col-8 mx-auto col-md-3">
                    <div class="card" style="background: #f200ff; color:#fff">
                        <div class="card-body">
                            <i class="fa fa-file-invoice-dollar fa-3x"></i>
                            <p><strong>Total</strong></p>
                            <h2>0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list-group text-left">
                        <div class="list-group-item">
                            <strong style="color: orange;">PENDIENTES</strong>
                            <span class="badge badge-warning float-right">1</span>
                        </div>
                        <div class="list-group-item">
                            <strong style="color: red;">RECHAZADAS</strong>
                            <span class="badge badge-danger float-right">1</span>
                        </div>
                        <div class="list-group-item">
                            <strong style="color: green;">PAGADAS</strong>
                            <span class="badge badge-success float-right">2</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================
          FORMULARIO DE BUSQUEDA
  ================================= -->
        <div class="container" style="margin-top: 20px">
            <div class="row">

                <form class="search-form">
                    <input name="search" type="number" class="textbox" placeholder="Ingrese el N° de Orden">
                    <button title="Search" value="" type="submit" class="button">
                        <i class="fa fa-search"></i>
                    </button>
                </form>

            </div>
        </div>


        @if($search)
            <div class="alert alert-info">Resultados para la orden  <strong>"N°{{$search}}"</strong></div>
    @endif
    <!--.fin FORM busqueda-->
        <div class="container" style="margin:25px 10px">
            <div class="row">
                <div class="col">
                    <div class="btn-group">
                        <button id="btn-ordenes-hoy" class="btn btn-primary active">Ordenes de hoy</button>
                        <button id="btn-ordenes-all" class="btn btn-primary">Todas las ordenes</button>
                    </div>
                </div>
            </div>
        </div>
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

                    <tbody id="tbody-ordenes">
                    @foreach($ordenes as $orden)
                        <tr>
                            <td>{{$orden->id}}</td>
                            <td>{{$orden->nombre}}</td>
                            <td style="color:{{$orden->direccion ? 'orange' : 'green'}}; font-weight:bold">{{$orden->direccion ? 'DESPACHO A DOMICILIO' : 'RETIRO EN TIENDA'}}</td>
                            <td>{{$orden->tipo_pago}}</td>
                            <td>{{$orden->estado}}</td>
                            <td><a href="{{url('/admin/orden', $orden->id)}}">Ver detalles</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$ordenes->links()}}
            </div>
        </div>

@endsection
