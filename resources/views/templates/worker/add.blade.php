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

      <div class="container">
  <div class="text-center">
  <h5 class="text-muted">@isset($subtitle) {{$subtitle}} @endisset</h5>

    @if(isset($errors) && count($errors)>0)
      @foreach($errors->all() as $error)
        {{$error}}
      @endforeach
    @endif
  </div>
  <form id="addWorker" method="POST" action="{{route('add.worker')}}" class="needs-validation" novalidate>
  @csrf
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Contactos</span>
        <span class="badge badge-secondary badge-pill">3</span>
      </h4>
      <div class=" mb-3">
          <label for="country">Telefone </label>
          <input type="number" class="form-control" id="tele" name="tele" placeholder="923000900" value="" required>
          <div class="invalid-feedback">
            Este campo e obrigatorio.
          </div>
      </div>
      <div class=" mb-3">
          <label for="country">Celular </label>
          <input type="number" class="form-control" id="cell" name="cell" placeholder="923000900" value="" >
          
      </div>
      <div class=" mb-3">
          <label for="country">Fixo </label>
          <input type="text" class="form-control" id="homephone" name="homephone" placeholder="(+244) 923000900" value="" >
         
      </div>
      <div class=" mb-3">
          <label for="country">Email </label>
          <input type="email" class="form-control" id="email" name="email" placeholder="joao@email.com" value="" >
          
      </div>

      
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">...
      
        
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nome</label>
            <input type="text" autofocus class="form-control" id="firstName" name="firstName" placeholder="Armando da Costa" value="" required>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Sobrenome</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Junior" value="" required>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Genero</label>
            <select class="custom-select d-block w-100" id="gender" name="gender" required>
              <option value="">Selecionar...</option>
              <option>Masculino</option>
              <option>Femenino</option>
              <option>Outro</option>
            </select>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">Estado Civil</label>
            <select class="custom-select d-block w-100" id="mstate" name="mstate" required>
            <option value="">Selecionar...</option>
              <option>Solteiro(a)</option>
              <option>Casado(a)</option>
              <option>Divorciado(a)</option>
            </select>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Nacionalidade</label>
            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Angolana" required>
            <div class="invalid-feedback">
              Este campo e obrigatorio.
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Pais</label>
            <select class="custom-select d-block w-100" id="country" name="country" required>
              <option value="">Selecionar...</option>
              @if(count($coutryList) > 0)
                @foreach($coutryList as $countries)
                  <option value="{{$countries->id_country}}">{{$countries->country}}</option>
                @endforeach
              @endif
            </select>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">Provincia</label>
            <select class="custom-select d-block w-100" id="province" name="province" required>
            <option value="">Selecionar...</option>
              <!--@if(count($provinceList) > 0)
                @foreach($provinceList as $provinces)
                  <option value="{{$provinces->id_province}}">{{$provinces->province}}</option>
                @endforeach
              @endif-->
            </select>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Cidade</label>
            <select class="custom-select d-block w-100" id="city" name="city" required>
            <option value="">Selecionar...</option>
              <!--@if(count($cityList) > 0)
                @foreach($cityList as $cities)
                  <option value="{{$cities->id_city}}">{{$cities->city}}</option>
                @endforeach
              @endif-->
            </select>
            <div class="invalid-feedback">
              Este campo e obrigatorio.
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">B.I/Passaporte nº</label>
            <input type="text" class="form-control" id="identity" name="identity" placeholder="00288H0" required>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          <div class="col-md-5 mb-3">
            <label for="country">Data e Expiração</label>
            <input type="date" class="form-control" id="expdate" name="expdate" placeholder="" required>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="state">Categoria</label>
            <select class="custom-select d-block w-100" id="category" name="category" required>
            <option value="">Selecionar...</option>
              @if(count($categoryList) > 0)
                @foreach($categoryList as $categories)
                  <option value="{{$categories->category}}">{{$categories->category}}</option>
                @endforeach
              @endif
            </select>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
        </div>


        <hr class="mb-4">
    
        <button class="btn btn-primary btn-lg btn-block" type="submit">Salvar</button>
      
    </div>
    </form>
  </div>


@endsection