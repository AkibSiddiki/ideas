<h4> Share yours ideas </h4>
<div class="row">
    <form action="{{ route('store.idea') }}" method="post">
        @csrf
        <div class="mb-3">
            <textarea name="idea" class="form-control" id="idea" rows="3"></textarea>
            @error('idea')
                <p class="mt-2 fs-6 text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="">
            <button type="submit" class="btn btn-dark"> Share </button>
        </div>
    </form>
</div>
<hr>