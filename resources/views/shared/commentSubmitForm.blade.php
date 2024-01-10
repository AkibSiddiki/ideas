@auth
<form action="{{route('Comments.store', $idea)}}" method="POST">
    @csrf
    <div class="mb-3">
        <textarea name="comment" class="fs-6 form-control" rows="1"></textarea>
        @error('comment')
        <small class="mt-4 text-small">{{ $message }}</small>
        @enderror
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
    </div>
</form>
@endauth
@guest
<hr>
<h6>Login to post your comments</h6>
@endguest
