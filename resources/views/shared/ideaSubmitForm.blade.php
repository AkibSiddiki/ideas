@auth
<h4> Share yours ideas </h4>
<div class="row">
    <form action="{{ route('ideas.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <textarea name="idea" class="form-control" id="idea" rows="3"></textarea>
            @error('idea')
            <p class="mt-2 fs-6 text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark"> Share </button>
        </div>
    </form>
</div>
<hr>
@endauth
@guest
<div class="d-flex justify-content-between">
    <h4>Login to Share yours ideas </h4>
    <a type="submit" class="btn btn-dark" href="{{route('auth.login')}}"> Login </a>
</div>
@endguest
