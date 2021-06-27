@extends('layouts.app')

@section('content')
<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">
                <div class="col-md-12 col-lg-8 offset-lg-2">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">GASTOS</h4>
                        </header>
                        <hr class="widget-separator">
                        <div class="widget-body">
                            <form class="" action="{{url('bill')}}" method="GET">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="date_start">FECHA INICIAL:</label>
                                        <input type="text" name="date_start" class="form-control datepicker-trigger" id="date_start" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_end">FECHA FINAL:</label>
                                        <input type="text" name="date_end" class="form-control datepicker-trigger" id="date_end" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="pwd"><b>CATEGORIA:</b></label>
                                        <select name="category" required id="" class="form-control">
                                            @foreach($list_categories  as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                    <button class="btn btn-info hidden" type="submit">BUSCAR</button>
                                    <a href="{{url('bill/create')}}" class="btn btn-success">AGREGAR</a>
                                    </div>
                                </div>
                            </form>
                            <br class="clearfix">
                            <table class="table agente-g-table">
                                <tbody>
                                    <tr class="visible-lg">
                                        <th>Cartera</th>
                                        <th>Fecha</th>
                                        <th>Valor</th>
                                        <th>Detalle</th>
                                        <th>Categoría</th>
                                        <th>Agente</th>
                                        <th></th>
                                    </tr>
                                    @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->wallet_name}}</td>
                                        <td>{{$client->created_at}}</td>
                                        <td>{{$client->amount}}</td>
                                        <td>{{$client->description}}</td>
                                        <td>{{$client->category_name}}</td>
                                        <td>{{$client->user_name}}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <footer class="widget-footer">
                            <p><b>Total: </b><span class="text-success">{{$total}}</span></p>
                        </footer>
                    </div><!-- .widget -->
                </div>
            </div><!-- .row -->
        </section>
    </div>
</main>
@endsection
