@auth
{{-- @dump($notFollowingUsers) --}}
<div class="card">
    <div class="card-header pb-0 border-0">
        <h5 class="">Who to follow</h5>
    </div>
    <div class="card-body">
        @if($notFollowingUsers ?? false)
        @foreach ($notFollowingUsers as $notFollowingUser )
        <div class="hstack gap-2 mb-3">
            <div class="avatar">
                <a href="{{route('Users.show', $notFollowingUser)}}"><img width="50px" height="50px"
                        class="avatar-img rounded-circle" src="{{$notFollowingUser->getUserImage()}}"
                        alt="{{$notFollowingUser->name}}"></a>
            </div>
            <div class="overflow-hidden">
                <a class="h6 mb-0" href="{{route('Users.show', $notFollowingUser)}}">{{$notFollowingUser->name}}</a>
                <p class="mb-0 small text-truncate">{{$notFollowingUser->email}}</p>
            </div>
            <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="#"><i class="fa-solid fa-plus">
                </i></a>
        </div>
        @endforeach
        @endif
        <div class="d-grid mt-3">
            <a class="btn btn-sm btn-primary-soft" href="#!">Show More</a>
        </div>
    </div>
</div>
@endauth