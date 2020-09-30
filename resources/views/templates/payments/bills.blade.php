@extends('templates.template')

@section('content')
 
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@isset($title) {{$title}} @endisset</h1>

        <a class="btn btn-success btn-sm" href="{{route('bill.new')}}" >Novo </a>
        <a class="btn btn-primary btn-sm" href="{{route('bill')}}" >Tabela </a>
        
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <h2>@isset($subtitle) {{$subtitle}} @endisset</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
        @csrf
          <thead>
            <tr>
              <th>#</th>
              <th>Estudante</th>
              <th>Valor (AOA)</th>
              <th>Banco</th>
              <th>Talao</th>
              <th>Data</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
          @isset($datalist)
          @if($datalist->count()===0)
              Nenhum dado encontrado!
          @else
          @foreach($datalist as $bill)
            
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$bill->relStudent->relPeople->firstname}} {{$bill->relStudent->relPeople->lastname}}</td>
              <td>{{@number_format($bill->price,2,',','.')}}</td>
              <td>{{$bill->bank}}</td>
              <td>{{$bill->ticket}}</td>
              <td>{{$bill->ticket_date}}</td>
              <td>
              <a href="bills">
                  <button class="btn btn-primary btn-sm" >Pagar</button> </a>
                <!--<a href="">
                  <button class="btn btn-dark btn-sm" >Visualizar</button> </a>
                <a href="">
                  <button class="btn btn-primary btn-sm" >Editar</button> </a>
                <a id="">
                  <button class="btn btn-danger btn-sm" >Apagar</button> </a>-->
              </td>
            </tr>
            
          @endforeach
          @endif
          @endisset
          </tbody>
        </table>
      </div>

@endsection