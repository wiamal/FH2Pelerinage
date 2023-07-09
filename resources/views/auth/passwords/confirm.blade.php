@extends('layouts.app')

@section('content')
<div class="container-form">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header bg-white d-flex justify-content-center"><h6>{{ __('Mot de passe oublié') }}</h6></div>
                <div class="card-body  p-4" style="min-width: 400px;">
                    {{ __('Veuillez confirmer votre mot de passe avant de continuer.') }}
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <div class="input-group input-group-icon">
                                    <input id="password" type="password" placeholder="mot de passe" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                                    <div class="input-icon"><i class="fa fa-key"></i></div>

                                            @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col">
                                <div class="col-half">
                                    <button type="submit" class="btn btn-action">
                                        {{ __('Confirmer le mot de passe') }}
                                    </button>
                                </div>
                                <div class="col-half d-flex justify-content-end">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Mot de passe oublié?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
