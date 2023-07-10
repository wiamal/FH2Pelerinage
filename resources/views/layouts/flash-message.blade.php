<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success  rounded alert-block">
            <button type="button" class="close btn btn-flash  py-2" data-dismiss="alert"><i
                    class="fa-solid fa-xmark"></i></button>
            <h6 style="display: inline;"  >{{ $message }}</h6 >
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger  rounded alert-block">
            <button type="button" class="close btn btn-flash  py-2" data-dismiss="alert"><i
                    class="fa-solid fa-xmark"></i></button>
            <h6 style="display: inline;" >{{ $message }}</h6 >
        </div>
    @endif
    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-time  rounded alert-block">
            <button type="button" class="close btn btn-flash  py-2" data-dismiss="alert"><i
                    class="fa-solid fa-xmark"></i></button>
            <h6 style="display: inline;" >{{ $message }}</h6 >
        </div>
    @endif
    @if ($message = Session::get('info'))
        <div class="alert alert-info  rounded alert-block">
            <button type="button" class="close btn btn-flash  py-2" data-dismiss="alert"><i
                    class="fa-solid fa-xmark"></i></button>
            <h6 style="display: inline;" >{{ $message }}</h6 >
        </div>
    @endif
</div>
{{-- @if ($errors->any())
<div class="container-fluid">
    <div class="alert alert-default-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="fa-solid fa-xmark"></i>
            </span>
        </button>
        Check the following errors :(
    </div>
</div>
@endif --}}

{{-- @if ($message = Session::get('success'))
    <div class="container">
        <div class="alert alert-success alert-block">
            <button type="button" class="close btn btn-flash  py-2" data-dismiss="alert"><i
                    class="fa-solid fa-xmark"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="container">
        <div class="alert alert-danger alert-block">
            <button type="button" class="close btn btn-flash  py-2" data-dismiss="alert"><i
                    class="fa-solid fa-xmark"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    </div>
@endif
@if ($message = Session::get('warning'))
    <div class="container">
        <div class="alert alert-warning alert-block">
            <button type="button" class="close btn btn-flash  py-2" data-dismiss="alert"><i
                    class="fa-solid fa-xmark"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    </div>
@endif
@if ($message = Session::get('info'))
    <div class="container">
        <div class="alert alert-info alert-block">
            <button type="button" class="close btn btn-flash  py-2" data-dismiss="alert"><i
                    class="fa-solid fa-xmark"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    </div>
@endif
{{-- @if ($errors->any())
    <div class="container">
        <div class="alert alert-danger">
            <button type="button" class="close btn btn-flash  py-2" data-dismiss="alert"><i
                    class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
@endif --}}
