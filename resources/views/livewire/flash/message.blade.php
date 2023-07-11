<div class="container-fluid my-2">
    @if ($message = Session::get('success'))
        {{-- {{ dd(Session::get('success')) }} --}}

        <div class="alert alert-time alert-default-success alert-block">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </button>
            <h6>{{ $message }}</h6>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-time alert-default-danger alert-block">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </button>
            <h6>{{ $message }}</h6>
        </div>
    @endif
    @if ($message = Session::get('warning'))
        <div class="alert alert-time alert-default-warning alert-block">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </button>
            <h6>{{ $message }}</h6>
        </div>
    @endif
    @if ($message = Session::get('info'))
        <div class="alert alert-default-info alert-block">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </button>
            <h6>{{ $message }}</h6>
        </div>
    @endif
</div>
