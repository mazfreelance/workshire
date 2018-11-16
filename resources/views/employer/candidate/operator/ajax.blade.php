@extends('layouts.master')
@section('title', 'Search Operator Candidates') 

@section('content')  
  <div id="content">
    @include('employer.candidate.operator.index')
  </div>
  <div class="loading">
    <i class="fas fa-spinner fa-spin fa-2x fa-tw"></i>
    <br>
    <span>Loading</span>
  </div>
  <!-- Footer -->  
  @include('includes.footer') 
@endsection