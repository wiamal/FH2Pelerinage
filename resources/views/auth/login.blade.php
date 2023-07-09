@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body p-4" style="min-width: 400px;">
                    <div class="text-center mb-5" >
                        <h6 class="text-muted">
                            {{ __('Connectez-vous à votre compte.') }}
                        </h6>
                    </div>

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
                        <div class="row mb-2">
                            <div class="col">
                                <button type="submit" class="btn btn-action w-100">
                                    {{ __('Se connecter') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row mb-0 p-0">
                        <div class="col d-flex justify-content-end">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
