@extends('templates.template')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@isset($title) {{$title}} @endisset</h1>

        <a class="btn btn-success btn-sm" href="{{route('new.worker')}}" >Cadastrar </a>
        <a class="btn btn-primary btn-sm" href="{{route('workerHome')}}" >Tabela </a>
        
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

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Detálhes</h6>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <strong class="d-block text-gray-dark">{{$datalist->relPeople->firstname}} {{$datalist->relPeople->lastname}}</strong>
        B.I nº {{$datalist->relPeople->relIdentity->identity}}
        Categoria: {{$datalist->category}}, Contactos: @foreach($datalist->relContacts as $contacts)
                {{$contacts->telephone}} {{$contacts->cellphone}} {{$contacts->email}} <br/>
               @endforeach, 
        {{$contacts->telephone}},
        Cidade: {{$datalist->relPeople->relCity->city}} 
          ({{$datalist->relPeople->relCity->relProvince->province}}
          /
          {{$datalist->relPeople->relCity->relProvince->relCountry->country}})
      </p>
    </div>
    
    <small class="d-block text-right mt-3">
      <a href="#">All updates</a>
    </small>
  </div>


@endsection