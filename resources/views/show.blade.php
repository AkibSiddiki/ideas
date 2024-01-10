@extends('layout.layout')

@section('title', 'Home - ')

@section('main')

<div class="row">
    <div class="col-3">
        @include('shared.leftSideMenu')
    </div>
    <div class="col-6">
        @include('shared.successMassage')
        @include('shared.ideaCard')
    </div>
    <div class="col-3">
        @include('shared.followBox')
    </div>
</div>
@endsection
