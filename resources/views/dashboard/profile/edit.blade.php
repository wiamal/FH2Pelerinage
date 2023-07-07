@extends('dashboard.dashboard')
@section('content')
<?php $Adherent = Session::get('Adherent') ?>
 


<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">

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
                <form method="POST" action="{{route('dashboard.profil.updateAdherent',['id' => $Adherent->IdAdherent ])}}" class="form-horizontal form-material mx-2" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text"
                                        placeholder="{{ $Adherent->Nom }}"
                                        class="form-control form-control-sm" disabled="">
                                    <br>
                                    <label>Prénom</label>
                                    <input type="text"
                                        placeholder="{{ $Adherent->Prenom }}"
                                        class="form-control form-control-sm" disabled="">
                                </div>
                                <div class="form-group">
                                    <label>Affiliation</label>
                                    <input type="text"
                                        placeholder="{{ $Adherent->Affiliation }}"
                                        class="form-control form-control-sm" disabled="">
                                    <br>
                                    <label>PPR</label>
                                    <input type="text"
                                        placeholder="{{ $Adherent->CIN }}"
                                        class="form-control form-control-sm" disabled="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group " dir="rtl">
                                    <label class="label-ar">الاسم العائلي</label>
                                    <input type="text" class="form-control form-control-sm" name="NomAr"
                                        value="{{ $Adherent->NomAr }}" @error('NomAr') is-invalid @enderror>
                                        @error('NomAr')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    <br>
                                    <label class="label-ar">الاسم الشخصي</label>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ $Adherent->PrenomAr }}" name="PrenomAr" @error('NomAr') is-invalid @enderror>
                                        @error('PrenomAr')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="form-group " >
                                    <label>CIN</label>
                                    <input type="text"
                                        placeholder="{{ $Adherent->CIN }}"
                                        class="form-control form-control-sm" disabled="">
                                    <br>
                                    <label>Date de Naissance</label>
                                    <input type="text" placeholder="{{ $Adherent->DateNaissance }}"
                                            class="form-control form-control-sm" disabled="">
                                </div>
                            </div>
                        </div>
                        
                    
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Adresse</label>
                        <div class="col-md-12">
                            <input type="text" value="{{ $Adherent->Adresse }}" class="form-control form-control"
                             id="example-email" name="Adresse" @error('Adresse') is-invalid @enderror>
                                @error('Adresse')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-12">Tél</label>
                        <div class="col-md-12">
                            <input type="text" value="{{ $Adherent->GSM }}" class="form-control " name="GSM" @error('GSM') is-invalid @enderror>
                            @error('GSM')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-info text-white">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Column -->

</div>

@endsection