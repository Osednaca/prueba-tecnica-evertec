@extends('layouts.app')

@section('content')
<h3>Create Order</h3>
<form action="{{ route('store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Document:</strong>
                    <select name="customer_document_type" class="form-control">
                        <option value="CC">Cédula de ciudadanía</option>
                        <option value="CE">Cédula de extranjería</option>
                        <option value="TI">Tarjeta de identidad</option>
                        <option value="NIT">Número de Identificación Tributaria</option>
                        <option value="RUT">Registro único tributario</option>
                    </select>
                    <br>
                    <input type="number" name="customer_document" class="form-control" placeholder="Document">
                </div>
            </div>        
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="customer_name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="customer_last_name" class="form-control" placeholder="Last Name">
                </div>
            </div>            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="customer_email" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Mobile:</strong>
                    <input type="text" name="customer_mobile" class="form-control" placeholder="Mobile">
                </div>
            </div>                                   
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Buy</button>
            </div>
        </div>

    </form>
@endsection