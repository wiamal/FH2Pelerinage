@extends('layouts.app')

@section('content')
    <div class="container text-center text-guide">
        <div class="">
            <h3>
                Connectez-vous à votre compte.
            </h3>
        </div>
    </div>
    <div class="container-form">

        <div class="row">

            <div class="card border-0">
                {{--   <div class="card-header bg-white d-flex justify-content-center"><h4>{{ __('Connexion') }}</h4>
                </div>
 --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <div class="input-group input-group-icon ">
                                    {{-- class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" --}}
                                    <input id="username" type="text" placeholder="Affiliation" name="username"
                                        class=" @error('username') is-invalid @enderror" required
                                        value="{{ old('username') }}" autocomplete="username" autofocus />
                                    <div class="input-icon"><i class="fa-solid fa-id-card-clip"></i></div>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <div class="input-group input-group-icon">
                                    <input id="password" type="password" placeholder="mot de passe"
                                        class=" @error('password') is-invalid @enderror" name="password" required
                                        autocomplete="current-password" />
                                    <div class="input-icon"><i class="fa fa-key"></i></div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col justify-content-start">
                                <div class="input-group">
                                    <input id="remember" type="checkbox" name="remember"
                                        {{ old('remember') ? 'checked' : '' }} />
                                    <label for="remember"> {{ __('Se souvenir de moi') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-half">
                                <button type="submit" class="btn btn-action">
                                    {{ __('Se connecter') }}
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- 
     <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Adresse Email') }}</label>
    
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

<label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de Passe') }}</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
 
    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Se souvenir de moi') }}
                                    </label>
 
 
    --}}
