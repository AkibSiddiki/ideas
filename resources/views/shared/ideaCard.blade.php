<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{$idea->user->name}}"
                    alt="{{$idea->user->name}}">
                <div>
                    <h5 class="card-title mb-0"><a href="#"> {{$idea->user->name}}</a></h5>
                </div>
            </div>
            @if(!($edit ?? false))
            <div class="d-flex align-items-center">
                <a class="btn btn-outline-primary mx-1" href="{{route('ideas.show', $idea)}}">view</a>
                @auth
                @if (Auth::user()->id==$idea->id)
                <a class="btn btn-outline-primary mx-1" href="{{route('ideas.edit', $idea)}}">Edit</a>
                <form action="{{route('ideas.destroy', $idea)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-outline-primary mx-1">X</button>
                </form>
                @endif
                @endauth
            </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        @if($edit ?? false)
        <h4 class="mb-2">update</h4>
        <div class="row">
            <form action="{{ route('ideas.update', $idea) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <textarea name="idea" class="form-control" id="idea" rows="3">{{$idea->idea}}</textarea>
                    @error('idea')
                    <p class="mt-2 fs-6 text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark"> Update </button>
                </div>
            </form>
        </div>

        @else
        <p class="fs-6 fw-light text-muted">
            {{$idea -> idea}}
        </p>
        <div class="d-flex justify-content-between">
            <div>
                <form action="{{route('ideas.like', $idea)}}" method="GET">
                    @method('get')
                    @csrf
                    <button class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                        </span> {{$idea -> likes}} </button>
                </form>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{$idea -> created_at}} </span>
            </div>
        </div>
        @endif
        @if (!($edit ?? false))
        <div>
            @include('shared.commentSubmitForm')
            <hr>
            @include('shared.commentCard')
        </div>
        @endif
    </div>
</div>
