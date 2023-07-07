@extends('dashboard.dashboard')
@section('content')

<?php 
$Adherent = getAdherentFields(auth()->user()->idAdherent) ;
$conjoint = getAdherentConjoint($Adherent->IdAdherent); 
$Enfants = getAdherentEnfants($Adherent->IdAdherent); 
?>

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
                    <p class="text-muted font-size-sm">N° Adhérent</p>
                    <p class="text-primary mb-1">{{ Str::replace('000', '/000', $Adherent->Affiliation) }}</p>  
                </div>
            </div>
        </div>
    </div>
</div>  
   <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        
            <div class="card border-1 shadow-sm ">
                <div class="card-header text-center">
                    <h5>Mes Bénéficiares</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>N° Adhérent</th>
                                <th>Lien de parenté</th>
                                <th>Nom Bénéficiaire</th>
                                <th dir="rtl" style="text-align: right">إسم المستفيد</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($conjoint)>0)
                                <tr>
                                    <td>{{ Str::replace('100', '/100',$conjoint[0]->Aff) }}</td>
                                    <td><span class="badge bg-primary text-center">{{ $conjoint[0]->Qualite }}</span></td>
                                    <td>{{ $conjoint[0]->NomConjoint.' '.$conjoint[0]->PrenomConjoint }}</td>
                                    <td dir="rtl" style="text-align: right">{{ $conjoint[0]->NomArConjoint.' '.$conjoint[0]->PrenomArConjoint }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="4" class="text-danger text-center" >Aucune donnée trouvée.</td>
                                </tr>
                            @endif
                            @if(count($Enfants)>0)
                                @foreach ( $Enfants as $Enfant)
                                    <tr>
                                        <td>{{ Str::replace('101', '/101',$Enfant->Aff) }}</td>
                                        <td><span class="badge bg-teal text-center">{{ $Enfant->Qualite }}</span></td>
                                        <td>{{ $Enfant->NomEnfant.' '.$Enfant->PrenomEnfant }}</td>
                                        <td dir="rtl" style="text-align: right">{{ $Enfant->NomArEnfant.' '.$Enfant->PrenomArEnfant }}</td>
                                    </tr>
                                @endforeach
                            @else
                                   
                            @endif
                        </tbody>
                    </table>

                </div>

            </div>
        
    </div>
</div>

@endsection