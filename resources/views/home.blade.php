@extends('layout.layout')

@section('title', 'Home - ')

@section('main')

<div class="row">
    <div class="col-3">
        @include('shared.leftSideMenu')
    </div>
    <div class="col-6">
        @if (session()->has('success'))
        @include('shared.successMassage')
        @endif
        @include('shared.ideaSubmitForm')
        @foreach ($ideas as $idea)
        <div class="mt-3">
            @include('shared.ideaCard')
        </div>
        @endforeach
        <div class="mt-2">
            {{$ideas -> links()}}
        </div>
    </div>
    <div class="col-3">
        @include('shared.searchBar')
        <div class="mt-3"></div>
        @include('shared.followBox')
    </div>
</div>
@endsection