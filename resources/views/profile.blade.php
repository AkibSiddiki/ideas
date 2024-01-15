@extends('layout.layout')
@section('title', 'Profile - ')
@section('main')
<div class="row">
    <div class="col-3">
        @include('shared.leftSideMenu')
    </div>
    <div class="col-6">
        {{-- {{dd($user)}} --}}
        @include('shared.successMassage')
        <div class="card">
            <div class="px-3 pt-4 pb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{$user->getUserImage()}}"
                            alt="{{$user->name}}">
                        <div>
                            @if (!($profileEdit ?? false))
                            <h3 class="card-title mb-0">
                                {{$user->name}}
                                @auth
                                @if (((Auth::user()->id ?? -1) != $user->id) && (auth()->user()->isFollowing($user)))
                                <span class="badge text-bg-info fs-6">Following</span>
                                @endif
                                @endauth
                            </h3>
                            <span class="fs-6 text-muted">{{$user->email}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="px-2 mt-4">
                    @if ($profileEdit ?? false)
                    <div class="row mb-3">
                        <form enctype="multipart/form-data" action="{{route('Users.update', $user)}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <p> Profile Image : </p>
                                <input name="image" class="form-control" maxlength="60" rows="1" type="file"
                                    value="{{$user->image}}">
                                @error('image')
                                <p class="mt-2 fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <p> Name : </p>
                                <textarea name="name" class="form-control" maxlength="60"
                                    rows="1">{{$user->name}}</textarea>
                                @error('name')
                                <p class="mt-2 fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <p> Bio : </p>
                                <textarea name="bio" class="form-control" maxlength="280"
                                    rows="3">{{$user->bio}}</textarea>
                                @error('bio')
                                <p class="mt-2 fs-6 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-dark"> Save </button>
                            </div>
                        </form>
                    </div>
                    @else
                    <h5 class="fs-5"> Bio : </h5>
                    <p class="fs-6 fw-light">
                        {{$user->bio}}
                    </p>
                    {{-- {{dump(Auth::user())}} --}}
                    <div class="d-flex justify-content-start align-items-center mb-3">
                        @if ((Auth::user()->id ?? -1) != $user->id)
                        @auth
                        {{-- <a href="#" class="btn btn-primary btn-sm me-3">Follow</a> --}}
                        {{-- Blade view --}}
                        @if (auth()->check())
                        @if (auth()->user()->isFollowing($user) ?? false)
                        <form action="{{ route('unfollow', $user) }}" method="post">
                            @csrf
                            <button class="btn btn-primary btn-sm me-3" type="submit">Unfollow</button>
                        </form>
                        @else
                        <form action="{{ route('follow', $user) }}" method="post">
                            @csrf
                            <button class="btn btn-primary btn-sm me-3" type="submit">Follow</button>
                        </form>
                        @endif
                        @endif
                        @endauth
                        @guest
                        <a href="{{route('auth.login')}}" class="btn btn-primary btn-sm me-3">Follow</a>
                        @endguest
                        @else
                        <a href="{{route('Users.edit',Auth::user()->id)}}" class="btn btn-primary btn-sm me-3">Edit</a>
                        @endif
                        <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                            </span> {{$user->followersCount()}} Followers </a>
                        <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                            </span> {{$user->ideas->count()}} </a>
                        <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                            </span> {{$user->comments->count()}} </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @if (!($profileEdit ?? false))
        <hr>
        @auth
        @if (Auth::user()->id==$user->id)
        @include('shared.ideaSubmitForm')
        @endif
        @endauth
        @forelse ($Ideas as $idea)
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
            {{$Ideas->withQueryString()->links()}}
        </div>
        @endif
    </div>
    <div class="col-3">
        @if (!($profileEdit ?? false))
        @include('shared.searchBarProfile')
        <div class="mt-3"></div>
        @endif
        @include('shared.followBox')
    </div>
</div>
@endsection