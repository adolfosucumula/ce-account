@extends('templates.template')

@section('content')
 
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@isset($title) {{$title}} @endisset</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
        @if(Session::exists('AccessPage'))
                    @foreach(Session::get('AccessPage') as $list)
                      @if( $list['page'] ==="Worker" && $list['allowed'] ===1
                          && $list['insert'] ==='1' )
                          <a class="btn btn-success btn-sm" href="{{route('stud.new')}}" >Cadastrar  </a>
                        @break
                      @endif
                    @endforeach
                  @endif

                  @if(Session::exists('AccessPage'))
                    @foreach(Session::get('AccessPage') as $list)
                      @if( $list['page'] ==="Worker" && $list['allowed'] ===1
                          && $list['select'] ==='1' )
                          <a class="btn btn-primary btn-sm" href="{{route('stud')}}" >Lista Geral </a>
                        @break
                      @endif
                    @endforeach
                  @endif
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
      
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h2>@isset($subtitle) {{$subtitle}} @endisset</h2>
          
          @if(isset($errors) && count($errors)>0)
            @foreach($errors->all() as $error)
              <span class=" alert-danger">
              {{$error}}
              </span>
            @endforeach
          @endif

        </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
        @csrf
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>B.I</th>
              <th>Categoria</th>
              <th>Origem</th>
              <th>Contact</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
          @isset($datalist)
          @if($datalist->count()===0)
              Nenhum dado encontrado!
          @else
          @foreach($datalist as $student)
            
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$student->relPeople->firstname}} {{$student->relPeople->lastname}}</td>
              <td>{{$student->relPeople->relIdentity->identity}}</td>
              <td>{{$student->code_student}}</td>
              <td>
              {{$student->relPeople->relCity->city}}
                  ({{$student->relPeople->relCity->relProvince->province}}
                  / {{$student->relPeople->relCity->relProvince->relCountry->country}}
                  )
              </td>
              <td>
              @foreach($student->relContacts as $contacts)
                {{$contacts->telephone}} <br/>
               @endforeach
              </td>
              <td>
              <!--<a href="students/{{$student->id_student}}/edit">
                  <button class="btn btn-primary btn-sm" >Editar</button> </a>
                <a> -->
                  <form  action="{{ route('quot.extract') }}" method="POST" >
                                        @csrf
                      <input type="hidden" name="code" value="{{$student->id_student}}" />
                      <button class="btn btn-dark btn-sm" >Propina</button>
                  </form>
                </a>
                <!--<a href="student/{{$student->id_student}}/edit">
                  <button class="btn btn-primary btn-sm" >Editar</button> </a>
                <a id="{{$student->id_student}}">
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