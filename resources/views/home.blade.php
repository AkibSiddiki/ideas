@extends('layout.layout')

@section('title', 'Home - ')

@section('main')

<div class="row">
    <div class="col-3">
        @include('shared.leftSideMenu')
    </div>
    <div class="col-6">
        @include('shared.successMassage')
        @include('shared.ideaSubmitForm')
        @forelse ($ideas as $idea)
        <div class="mt-3">
            @include('shared.ideaCard')
        </div>
        @empty
        <div class="card p-4">
            <p class="text-center">No result founds.</p>
            <div class="text-center">
                <a class="btn btn-dark p-2" href="{{route('home')}}">Back To Home</a>
            </div>
        </div>
        @endforelse
        <div class="mt-2">
            {{$ideas ->withQueryString()->links()}}
        </div>
    </div>
    <div class="col-3">
        @include('shared.searchBar')
        <div class="mt-3"></div>
        @include('shared.followBox')
    </div>
</div>
@endsection
