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
                                <h4 class="widget-title">OTORGAR NUEVO PRESTAMO A:</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <form method="POST" action="{{url('client')}}" class="new-register" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name"><b>NOMBRES:</b></label>
                                            <input type="text" name="name" value="{{isset($user) ? $user->name : ''}}" class="form-control" id="name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last_name"><b>APELLIDOS:</b></label>
                                            <input type="text" name="last_name" value="{{isset($user) ? $user->last_name : ''}}" class="form-control" id="last_name" required>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="address"><b>CALLE NO.:</b></label>
                                                <input type="text" name="address" value="{{isset($user) ? $user->address : ''}}"
                                                       placeholder="" class="form-control g-autoplaces-address" id="address"
                                                       required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="province"><b>COLONIA:</b></label>
                                                <input type="text" name="province"
                                                       value="{{isset($user) ? $user->province : ''}}" class="form-control"
                                                       id="province" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="phone"><b>TELEFONO:</b></label>
                                                <input type="tel" name="phone" value="{{isset($user) ? $user->phone : ''}}"
                                                    class="form-control" id="phone" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="amount"><b>IMPORTE:</b></label>
                                                <input type="number" step="any" min="1" name="amount"
                                                       class="form-control amount-input" id="amount" required>
                                            </div>
                                            <div class="col-md-3">
                                            <label for="utility"><b>TASA INTERES:</b></label>
                                            <input type="number" step="any" min="0" name="utility" class="form-control" id="utility" required>
                                                                                </div>
                                                                                <div class="col-md-3">
                                            <label for="payment_number"><b>CUOTAS:</b></label>
                                            <select name="payment_number" class="form-control" id="payment_number">
                                                @foreach($payment_number as $p)
                                                    <option {{ ($p->selected) ? 'selected':'' }} value="{{ $p->name }}">{{$p->name }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="payment_day"><b>DIA:</b></label>
                                                <select name="payment_day" class="form-control" id="payment_day">
                                                    @foreach($payment_day as $d)
                                                        <option {{ ($d->selected) ? 'selected':'' }} value="{{$d->name}}">{{$d->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group text-center total-box hidden">
                                            <h4>TOTAL A PAGAR</h4>
                                            <h2 id="total_show"></h2>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block"><b>GUARDAR PRESTAMO</b></button>
                                        </div>
                                </form>
                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div><!-- END column -->
                </div><!-- .row -->
            </section>
        </div>
    </main>
@endsection
