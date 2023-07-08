@extends('layouts.app')

@section('content')
    <div class="container-sm text-center text-guide">
        <p>
            Commencez par créer votre compte Espace Adhérent. Vous possédez un compte ?
            <a href="{{ route('login') }}" class="btn btn-link p-0" rel="noopener noreferrer">Connectez-vous.</a>
        </p>
    </div>
    <div class="container-form">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0">
                    <div class="card-header bg-white d-flex justify-content-center">
                        <h4>{{ __('Inscription') }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="input-group input-group-icon">
                                        <input id="Affiliation" type="text" placeholder="Numéro d'affiliation"
                                            class=" @error('Affiliation') is-invalid @enderror" name="Affiliation"
                                            value="{{ old('Affiliation') }}" required autocomplete="Affiliation"
                                            autofocus />
                                        <div class="input-icon"><i class="fa fa-user"></i></div>

                                        @error('Affiliation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="input-group input-group-icon">
                                        <input id="CIN" type="text" placeholder="Numéro de CIN"
                                            class=" @error('CIN') is-invalid @enderror" name="CIN"
                                            value="{{ old('CIN') }}" required autocomplete="cin" autofocus />
                                        <div class="input-icon"><i class="fa-solid fa-id-card"></i></div>

                                        @error('CIN')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col">
                                    <div class="input-group input-group-icon ">
                                        <input id="email" type="email" placeholder="adresse e-mail"
                                            class="@error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus />
                                        <div class="input-icon"><i class="fa fa-envelope"></i></div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
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

                            <div class="row mb-3">
                                <div class="input-group input-group-icon">
                                    <input id="password-confirm" type="password" placeholder="confirmer le mot de passe"
                                        name="password_confirmation" required autocomplete="new-password" />

                                </div>

                            </div>

                            <div class="row mb-0">
                                <div class="col">
                                    <button type="submit" class="btn btn-action">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- 
<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"> --}}
