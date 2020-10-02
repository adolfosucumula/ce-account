@extends('templates.template')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@isset($title) {{$title}} @endisset</h1>

        <a class="btn btn-success btn-sm" href="{{route('stud.new')}}" >Cadastrar </a>
        <a class="btn btn-primary btn-sm" href="{{route('stud')}}" >Tabela </a>
        
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
        
      <div class=" text-center">
      
      <h5 class="text-muted">@isset($subtitle) {{$subtitle}} @endisset</h5>

       

        @if(isset($errors) && count($errors)>0)
          @foreach($errors->all() as $error)
            <span class=" alert-danger">
            {{$error}}
            </span><br/><br/>
          @endforeach
        @endif
        
        
        
      </div>

 
      <form id="editStudentQuota" method="POST" action="{{route('quota.stud.update')}}" class="needs-validation" novalidate>
      @csrf
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Mensalidade</span>
        <span class="badge badge-secondary badge-pill">3</span>
      </h4>
      <ul class="list-group mb-3">
        @isset($request->code_quota)
          @if(is_array($request->code_quota))
            @isset($datalist)
            @foreach($datalist as $data)
              @for($a=0;$a < @count($request->code_quota);$a++)
                @if($request->code_quota[$a] == $data->id_quota)
                  
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
          <h6 class="my-0">
          @isset($monthsModel)
                  @if(is_array($monthsModel))
                    @foreach($monthsModel as $month)
                      @if($data->quarter_reference === $month['code'])
                        <input type="checkbox" id="quotaID[]" name="quotaID[]" value="{{$request->code_quota[$a]}}" checked />
                        {{$month['month']}}
                      @endif
                    @endforeach
                  @endif
                @endisset
                {{$data->quater_reference}}
                </h6>
            <small class="text-muted">{{ $data->quater_reference}}</small>
          </div>
          <span class="text-muted">{{$request->code_quota[$a]}}</span>
        </li>

        @endif
        @endfor
        @endforeach
        @endisset
        @endif
        @endisset
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong>$20</strong>
        </li>
      </ul>
      
    </div>

   
    
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">
        <div class="row">
        
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
              <label for="country">Processo</label>
              <input type="text" class="form-control"  id="order_code" name="order_code" value="{{$orderNumber ?? '001'}}" required>
              <div class="invalid-feedback">
              Este campo e obrigatorio.
              </div>
              @error('order_code')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          <div class="col-md-3 mb-3">
              <label for="zip">ID</label>
              <input type="text" class="form-control" readonly id="idS" name="idS" 
              value="
              @isset($request)
                {{$request->studentNif}}
              @endisset
              " placeholder="0" >
              <div class="invalid-feedback">
                Este campo e obrigatorio.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="country">Estudante</label>
              <input type="text" class="form-control" readonly id="studentName" name="studentName" 
              value="
              @isset($request)
                {{$request->studentName}}
              @endisset
              " required>
              <div class="invalid-feedback">
              Este campo e obrigatorio.
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Valor</label>
            <input type="number" autofocus class="form-control" id="price" name="price" placeholder="Armando da Costa" value="" required>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Talao n</label>
            <input type="text" class="form-control" id="ticket" name="ticket" placeholder="Junior" value="" required>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Data do Talao</label>
            <input type="date" class="form-control" id="ticketDate" name="ticketDate"  value="" required>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="state">Metodo de Pagamento</label>
            <select class="custom-select d-block w-100" id="pymethod" name="payMethod" required>
            <option value="">Selecionar...</option>
              <option>Numerario</option>
              <option>Transferencia</option>
              <option>Deposito</option>
            </select>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
              <label for="zip">Banco</label>
             <select class="custom-select d-block w-100" id="bank" name="bank" >
                <option value="">Selecionar...</option>
                <option>BAI</option>
                <option>BIC</option>
                <option>BFA</option>
                <option>Millennium</option>
                <option>BCI</option>
                <option>Standard Bank</option>
              </select>
              <div class="invalid-feedback">
                Este campo e obrigatorio.
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="country">Ano letivo</label>
              <input type="text" class="form-control" id="academicYear" name="academicYear" value="{{@date('Y')}}" required>
              <div class="invalid-feedback">
              Este campo e obrigatorio.
              </div>
            </div>
          
        </div>

        <hr class="mb-4" id="line">
 
        <div class="row">
          
          <div class="col-md-5 mb-3">
            <label for="country">Assinante</label>
            <input type="text" class="form-control" id="signature" name="signature" placeholder="" value="" required>
            <div class="invalid-feedback">
            Este campo e obrigatorio.
            </div>
          </div>
          
        </div>

        <hr class="mb-4">
    
        <button class="btn btn-primary btn-lg btn-block" type="submit">Salvar</button>
      
    </div>
   
  </div>
  </form>

@endsection