@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection
@section('content')


  <main class="main">
    <div>
      {{ Breadcrumbs::render('home') }}
    </div>
    <index-component></index-component>
      <div class="container-fluid">

      </div>

  </main>
@endsection
