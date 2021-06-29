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
                                <h4 class="widget-title">REGISTRAR PAGO</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <form method="POST" class="payment-create" action="{{url('summary')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="address"><b>CREDITO:</b></label>
                                            <input type="text" name="credit_id" value="{{$id}}" readonly class="form-control" id="address">
                                        </div>
                                        <div class="col-md-8">
                                            <label for="name"><b>NOMBRE:</b></label>
                                            <input type="text" name="name" value ="{{$user->name}} {{$user->last_name}}" readonly class="form-control" id="name">
                                        </div>
                                        <input type="hidden" name="rev" value="{{ app('request')->input('rev') }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="province"><b>CONDICIONES:</b></label>
                                            <input type="text" name="province" value="{{$amount_neto}} en {{$payment_number}} cuotas" readonly class="form-control" id="province">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone"><b>TOTAL ABONADO:</b></label>
                                            <input type="tel" name="phone" value="{{$credit_data['positive']}}" readonly class="form-control" id="phone">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone"><b>SALDO:</b></label>
                                            <input type="tel" name="phone" value="{{$credit_data['rest']}}" readonly class="form-control" id="phone">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="amount"><b>ABONO REQUERIDO:</b></label>
                                            <input type="text" readonly value="{{$credit_data['payment_quote']}}" class="form-control" id="amount1">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="amount"><b>ABONO A CAPITAL:</b></label>
                                            <input type="number" readonly value="{{ $credit_data['payment_quote']/(1+$utility) }}" name="principal_amount" class="form-control" id="principal_amount">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="amount"><b>ABONO A INTERES:</b></label>
                                            <input type="number" readonly value="{{$credit_data['payment_quote'] - ($credit_data['payment_quote']/(1+$utility)) }}" name="interest_amount" class="form-control" id="interest_amount">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="amount"><b>ABONO RECIBIDO:</b></label>
                                        <input type="number" step="any" min="1" max="{{$credit_data['rest']}}" value="{{$credit_data['payment_quote']}}" name="amount" class="form-control" id="amount">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" {{($credit_data['rest']<1) ? 'disabled': ''}} class="btn btn-success btn-block btn-md">GUARDAR PAGO</button>
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
