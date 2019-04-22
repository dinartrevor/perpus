@extends('layouts.app')

@section('content')
<!-- Page Content -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link rel="icon" type="image/png" href="{{asset('/img/icon/favicon.ico') }}"/>

<div class="jumbotron">
  <br>
  <center><h1 class="animasi">SELAMAT DATANG </h1><center>
</div>

<div class="container">
  <div class="row">
    <!-- Team Member 1 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">
        <div class="card-body text-center">
          <h5 class="card-title mb-0"><i class="fa fa-bookmark"> KATEGORI BUKU </i></h5>
          <hr/>
          <h2 class="card-title mb-0">{{ $categories }}</h2>
          <br>
          <a href="{{ route('categories.index') }}" class="btn btn-primary">Selengkapnya </a>
        </div>
      </div>
    </div>
    <!-- Team Member 2 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">

        <div class="card-body text-center">
  
          <h5 class="card-title mb-0"><i class="fa fa-book"> BUKU </i></h5>
          <hr/>
          <h2 class="card-title mb-0">{{ $book }}</h2>
          <br>
          <a href="{{ route('books.index') }}" class="btn btn-primary">Selengkapnya</a>
        </div>
      </div>
    </div>
    <!-- Team Member 3 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">
   
        <div class="card-body text-center">
       
          <h5 class="card-title mb-0"><i class="fa fa-user"> ANGGOTA </i></h5>
          <hr/>
          <h2 class="card-title mb-0">{{ $member }}</h2>
          <br>
          <a href="{{ route('members.index') }}" class="btn btn-primary">Selengkapnya</a>
        </div>
      </div>
    </div>
    <!-- Team Member 4 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">

        <div class="card-body text-center">
         
          <h5  class="card-title mb-0"><i class="fa fa-drivers-license"> PEMINJAMAN </i></h5>
          <hr/>
          <h2 class="card-title mb-0">{{ $loan }}</h2>
          <br>
          <a href="{{ route('loans.index') }}" class="btn btn-primary">Selengkapnya</a>
      </div>
    </div>
  </div>
  </div>
  <!-- /.row -->
</div>

 
<!-- /.container -->
@endsection
  <!-- @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif -->