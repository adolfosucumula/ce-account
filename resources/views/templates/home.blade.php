@extends('templates.template')

@section('content')
<style>
    .main{
        text-align:center;
        margin-top:1%
    }
    span{color:#ccc}
    img{
      max-width:300px;
      max-height:300px;
    }
</style>
<div class="main">
<img class="mb-4" src="{{url('assets/logos/logo-2078018_640.png')}}" alt="" >
    <div>
        <h2>NetAcad</h2>
        <span>Gerenciamento seguro e completo!</span>
    </div>
    
    <footer class="main-footer">
    <strong>Copyright &copy; 2019-2020 <a href="javascript:;">Unotec - Solutions</a>.</strong>
    All rights reserved.<br/>
    <b>Versão 1.0</b>
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>
</div>

@endsection