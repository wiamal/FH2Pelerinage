@extends('layouts.app')
@section('content')
    <div class="container text-center text-guide">
        <div class="">
            <h3>
                
            </h3>
        </div>
    </div>
    <div class="container-form">
        <div class="row">
            <div class="card border-0 ">
                <div class="card-header bg-white d-flex justify-content-center">
                    <h4 class="text-muted">{{ __('Connectez-vous à votre compte.') }}</h4>
                </div>
                <div class="card-body p-4">
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
                                <button type="submit" class="btn btn-action w-100">
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
