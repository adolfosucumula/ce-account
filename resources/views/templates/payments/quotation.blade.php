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

      <form name="editQuota"  action="{{ route('quot.edit') }}" method="POST" >
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5 style="color:#ccc333">{{ $subtitle ?? 'Mensalidades' }} de  
          @if($datalist->count() > 0)
          @foreach($datalist as $quota)
          {{$quota->relStudent->relPeople->firstname}} {{$quota->relStudent->relPeople->lastname}}
          ({{$quota->relStudent->relPeople->relIdentity->identity}}/{{$quota->relStudent->code_student}})
          -Turma: {{$quota->relStudent->relClass->class}}
            @if($loop->iteration===1)
              @break
            @endif
          @endforeach
          @endif
          </h5>
        <button type="submit" class="btn btn-primary btn-sm" >Atualizar</button>
        </div>
      <div class="table-responsive">
      
        <table class="table table-striped table-sm">
        @csrf
          <thead>
            <tr>
              <th>#</th>
              <th>Mensalidade</th>
              <th>Valor(AOA)</th>
              <th>Estado</th>
              <th>M.Pagamento)</th>
              <th>Data</th>
              <th>Cliente</th>
              <th>Option</th>
            </tr>
          </thead>
         
          @csrf
          <tbody>
          @isset($datalist)
          @if($datalist->count()===0)
              Nenhum dado encontrado!
          @else
          @foreach($datalist as $quota)
           
            <tr style="color:re">
              <td> 
                @if($quota->state !="ON")
                  <input style="cursor:pointer" type="checkbox" id="code_quota[]" name="code_quota[]" value="{{$quota->id_quota}}" />
                @endif
                <input type="hidden" id="studentID" name="studentID" value="{{$quota->student_id}}" />
                <input type="hidden" id="studentName" name="studentName" value="{{$quota->relStudent->relPeople->firstname}} {{$quota->relStudent->relPeople->lastname}}" />
                <input type="hidden" id="studentNif" name="studentNif" value="{{$quota->relStudent->relPeople->relIdentity->identity}}" />
                <input type="hidden" id="studentCode" name="studentCode" value="{{$quota->relStudent->code_student}}" />
                <input type="hidden" id="studentClass" name="studentClass" value="{{$quota->relStudent->relClass->class}}" />
              </td>
              <td>
              @if($quota->state ==="ON")
                @isset($monthsModel)
                  @if(is_array($monthsModel))
                    @foreach($monthsModel as $month)
                      @if($quota->quarter_reference === $month['code'])
                        <span class="btn btn-success">{{$month['month']}}</span>
                      @endif
                    @endforeach
                  @endif
                @endisset
              @else
                @isset($monthsModel)
                  @if(is_array($monthsModel))
                    @foreach($monthsModel as $month)
                      @if($quota->quarter_reference === $month['code'])
                        <span class="btn btn-danger">{{$month['month']}}</span>
                      @endif
                    @endforeach
                  @endif
                @endisset
              @endif
              </td>
              <td>
              {{@number_format($quota->price,2,',','.')}}
              </td>
              <td>{{$quota->state ?? 'Pendente'}}</td>
              <td>{{$quota->payment_method ?? 'Cache'}}</td>
              <td>{{$quota->date_payment ?? 'Atual'}}</td>
              <td>{{$quota->signature ?? 'Diversos'}}</td>
              <td>
              
                @if($quota->state ==="ON")
                  <a href="javascript:;" class="btn btn-success btn-sm" >Quitado</a> 
                @else
                <a href="javascript:;" class="btn btn-danger btn-sm" >Por pagar</a> 
                @endif
               
              </td>
            </tr>
            
          @endforeach
          @endif
          @endisset
          </tbody>
          
        </table>
        
      </div>
      </form>
@endsection