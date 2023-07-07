@extends('layouts.app')

@section('content')

<div class="container-form">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="card-header bg-white d-flex justify-content-center"><h4>{{ __('Réinitialiser le mot de passe') }}</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                           
                            <div class="col">
                                <div class="input-group input-group-icon ">
                                    <input id="email" type="email" placeholder="adresse e-mail" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
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
                                    <input id="password" type="password" placeholder="mot de passe" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"/>
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
                            <div class="col">
                                <div class="input-group input-group-icon">
                                    <input id="password-confirm" type="password" placeholder="confirmer le mot de passe"  name="password_confirmation" required autocomplete="new-password"/> 
                                </div> 
                                
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col">
                                <button type="submit" class="btn btn-action">
                                    {{ __('Réinitialiser le mot de passe') }}
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

                           {{--  <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}