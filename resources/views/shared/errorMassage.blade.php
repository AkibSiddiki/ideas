@if($errors->has('name'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $errors->first('name') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
