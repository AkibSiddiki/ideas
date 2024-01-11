<div class="card">
    <div class="card-header pb-0 border-0">
        <h5 class="">Search</h5>
    </div>
    <div class="card-body">
        <form action="{{route('Users.show', $user->id)}}" method="GET">
            <input value="{{request('search')}}" placeholder="..." class="form-control w-100" type="text" name="search">
            <div class="d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-dark">Search</button>
            </div>
        </form>
    </div>
</div>