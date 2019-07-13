@if (Session::has('danger'))
    <div class="alert alert-danger">
        <p class="p-0 m-0">{{ Session::get('danger') }}</p>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success">
        <p class="p-0 m-0">{{ Session::get('success') }}</p>
    </div>
@endif
