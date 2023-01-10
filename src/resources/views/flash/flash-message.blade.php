@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong> {{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> {{ $message }}</strong>
    </div>
@endif
