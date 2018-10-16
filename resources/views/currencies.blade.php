@extends('templates.main')

@section('main-content')
    <div class="container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Курсы:</h3>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Название валюты</th>
                        <th>Цена</th>
                        <th>Количество</th>
                    </tr>
                    </thead>
                    <tbody id="currency_table">
                    @if($currencies)
                        @foreach($currencies as $item)
                            <tr>
                                <td>{{ $item['name']}}</td>
                                <td>{{ $item['volume']}} </td>
                                <td>{{ $item['amount']}} </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection