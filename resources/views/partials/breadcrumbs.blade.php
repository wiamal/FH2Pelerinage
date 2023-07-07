{{-- <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1 class="m-0">Starter Page</h1> --}}
        {{-- </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Accueil</a></li>
            <li class="breadcrumb-item active">{{ request()->path()}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div> --}}

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1 class="m-0">Starter Page</h1> --}}
        </div><!-- /.col -->
        <div class="col-sm-6">

  @unless ($breadcrumbs->isEmpty())
    <ol class="breadcrumb float-sm-right">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                  <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
               @else
                  <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ol>
  @endunless
    </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
