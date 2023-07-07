@extends('dashboard.dashboard')
@section('content')
<?php 
$Adherent = getAdherentFields(auth()->user()->idAdherent) ;
/* dd($Adherent->GSM); */
?>
{{--  @include('layouts.flash-message') --}}
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card gradient">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ asset('images/user.png') }}" alt="Admin"
                        class="rounded-circle" width="150">
                    <div class="mt-3">
                        <h4>{{ userFullName() }}</h4>
                        <p class="text-secondary mb-1">Fonction Statut</p>
                        {{-- <p class="text-muted font-size-sm">Software Engineer</p> --}}
                        
                    </div>
                </div>
            </div>
                <hr>
            <div class="card-body"> 
                <small class="text-muted">Adresse Email </small>
                <h6>{{ userEmailaddress() }}</h6> 
                <small class="text-muted p-t-30 db">Tél</small>
                <h6>{{ $Adherent->GSM }}</h6> 
                <small class="text-muted p-t-30 db">Adresse</small>
                <h6>{{ $Adherent->Adresse }}</h6>
            </div>

            
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card"> 
            <div class="card-body"> 
                <small class="text-muted">Nom</small>
                <h6>{{ $Adherent->Nom }}</h6> 
                <hr>
                <small class="text-muted">Prénom</small>
                <h6>{{ $Adherent->Prenom }}</h6> 
                <hr>
                <small class="text-muted">Affiliation</small>
                <h6>{{ $Adherent->Affiliation }}</h6>
                <hr> 
                <small class="text-muted">CIN</small>
                <h6>{{ $Adherent->CIN }}</h6> 
                <hr>
                <small class="text-muted">PPR</small>
                <h6>{{ $Adherent->CIN }}</h6> 
                <hr>
                <small class="text-muted p-t-30 db">Date de naissance</small>
                <h6>{{ $Adherent->DateNaissance }}</h6>
                
            </div> 
        </div>
        <div class="card">
            <div class="col-sm-12">                
                {{ Session::put('Adherent', $Adherent); }}
                <a href="{{ route('dashboard.profil.edit') }}" class="btn btn-link">Mettre à jours mes Informations <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <!-- Column -->
   
</div>

                               

@endsection