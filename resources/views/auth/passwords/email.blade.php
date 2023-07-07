@extends('layouts.app')

@section('content')
<div class="container text-guide d-flex justify-content-center">
    <div class="">
        <h3 class="text-center">Mot de passe oublié</h3>
        <p>Suivez les étapes suivantes pour réinitialiser votre mot de passe :</p>
        <ol>
            <li>Entrez votre adresse e-mail ;</li>
            <li>Vos informations de récupération vous seront envoyées par e-mail ;</li>
            <li>Suivez les instructions afin de pouvoir à nouveau accéder à votre compte <strong>Espace Adhérent</strong>.</li>
        </ol>
        <p>Vous souhaitez obtenir plus d’aide ? Nous vous proposons un <a href="">guide complet pour réinitialiser votre mot de passe</a>.</p>
    </div>
</div>
<div class="container-form">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="card-header bg-white d-flex justify-content-center"><h4>{{ __('Réinitialiser le mot de passe') }}</h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                             {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            

                            <div class="col">
                                <div class="input-group input-group-icon ">
                                    <input id="email" type="email" placeholder="adresse e-mail" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col d-flex justify-content-center">
                                <button type="submit" class="btn btn-action">
                                    {{ __('Envoyer le lien de réinitialisation du mot de passe') }}
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
