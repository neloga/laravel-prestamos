@extends('layouts.app')

@section('content')
    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="row">
                    <div class="col-md-12 col-lg-8 offset-lg-2">
                        <div class="widget">
                            <div class="widget-header">
                                <h4 class="widget-title">CLIENTES Y CREDITOS</h4>
                            </div>
                            <hr class="widget-separator">
                            <div class="widget-body">
                            <div class="table-responsive">
                                <table class="table table-hover client-table">
                                    <thead class="visible-lg">
                                        <tr>
                                            <th>NOMBRE</th>
                                            <th>APELLIDO</th>
                                            <th>COLONIA</th>
                                            <th>CREDITOS</th>
                                            <th>LIQUIDADOS</th>
                                            <th>VIGENTES</th>
                                            <th>IMPORTE</th>
                                            <th>SALDO</th>
                                            <th>CALIFICACION</th>
                                            <th>ACCION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td><span class="value">{{$client->name}}</span></td>
                                            <td><span class="value">{{$client->last_name}}</span></td>
                                            <td><span class="value">{{$client->province}}</span></td>
                                            <td><span class="value">{{$client->credit_count}}</span></td>
                                            <td><span class="value">{{$client->closed}}</span></td>
                                            <td><span class="value">{{$client->inprogress}}</span></td>
                                            <td><span class="value">{{isset($client->amount_net) ? $client->amount_net->amount_neto +$client->gap_credit : 0}}</span></td>
                                            <td><span class="value">{{$client->summary_net + $client->gap_credit}}</span></td>
                                            <td>
                                                @if($client->status=='good')
                                                    <span class="badge-info badge">BUENO</span>
                                                @elseif($client->status=='bad')
                                                    <span class="badge-danger badge">MALO</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url('client/create')}}?id={{$client->id}}" class="btn btn-success btn-xs">VENTA</a>
                                                <a href="{{url('client')}}/{{$client->id}}" class="btn btn-info btn-xs">DATOS</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- .widget -->
                </div>
            </div><!-- .row -->
        </section>
    </div>
</main>
@endsection
