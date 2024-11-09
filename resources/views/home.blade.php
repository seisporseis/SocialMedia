@extends('layouts.app')

@section('title')
    Feed principal
@endsection

@section('content')
   <x-post-list :posts="$posts" />
  
@endsection