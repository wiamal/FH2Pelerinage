@extends('dashboard.dashboard')
@section('styles')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>
                Programme d'Aide au Pèlerinage pour L'Annee {{ $pelerinage->Annee }}
            </H2>
        </div>
        <div class="card-body">
            <div class="row mx-5">
                <form action="/demandePelerinage" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="">
                        @if (isset($errorMessage))
                            <div class="alert alert-danger text-center mx-5">{{ $errorMessage }}</div>
                        @endif
                    </div>

                    @if (isset($fonction))
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Nom :</label> {{ $adherent->Nom }}
                                    </div>
                                    <div class="col-12">
                                        <label for=""> Prenom : </label> {{ $adherent->Prenom }}
                                    </div>

                                    <div class="col-12">
                                        <label for=""> Etat de fonction : </label> fonctionaire
                                    </div>
                                    <div class="col-12">
                                        <label for=""> PPR :</label> {{ $adherent->PPR }}
                                    </div>
                                    <input type="hidden" name="EtatFonction" id="EtatFonction" value="Fonctionaire">

                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row ">
                                    <div class="col-12 p-5 text-center">
                                        <b>35000dh</b>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif (isset($retraite))
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Nom :</label> {{ $adherent->Nom }}
                                    </div>
                                    <div class="col-12">
                                        <label for=""> Prenom : </label> {{ $adherent->Prenom }}
                                    </div>

                                    <div class="col-12">
                                        <label for=""> Etat de fonction : </label> Retraité(e)
                                    </div>
                                    <div class="col-12">
                                        <label for=""> N pension :</label> {{ $adherent->Pension }}
                                    </div>
                                    <div class="col-12">
                                        <label for=""> Date de Retraite :</label> {{ $adherent->DateRetraite }}
                                    </div>
                                    <input type="hidden" name="EtatFonction" id="EtatFonction" value="Retraite">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row ">
                                    <div class="col-12 p-5 text-center">
                                        <b>40000dh</b>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif(isset($retraitFonction))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger text-center mx-5" role="alert">Vous n'avez pas informer la
                                    Fondation Hassan II
                                    de votre départ à la retraite. Merci de vous présentez à la fondation
                                    ou auprès de votre coordonnateur régional afin de régler votre situation administrative,
                                    pour que votre inscription sera prise en compte</div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Nom :</label> {{ $adherent->Nom }}
                                    </div>
                                    <div class="col-12">
                                        <label for=""> Prenom : </label> {{ $adherent->Prenom }}
                                    </div>
                                    <div class="col-12">
                                        <label for=""> Etat de fonction : </label> Retraite
                                    </div>
                                    <input type="hidden" name="EtatFonction" id="EtatFonction"
                                        value="FonctionaireRetraite">
                                    @error('DateRetraite')
                                        <div class="col-12 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-12 form-group">
                                        <label for="DateRetraite">Date Retraite:</label>
                                        <input type="date" class="form-control" name="DateRetraite" id="DateRetraite">
                                    </div>
                                    @error('Pension')
                                        <div class="col-12 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-12 form-group">
                                        <label for="Pension">Attestation de pension:</label>
                                        <input type="file" class="form-control-file " id="Pension" name="Pension">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row ">
                                    <div class="col-12 p-5 text-center">
                                        <b>40000dh</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @error('DateNaissance')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group ">
                        <label for="DateNaissance">Date Naissance :</label>
                        <input type="date" class="form-control" name="DateNaissance" id="DateNaissance">
                    </div>

                    @error('DateRecrutement')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group row">
                        <label for="DateRecrutement">Date Recrutement :</label>
                        <input type="date" class="form-control" name="DateRecrutement" id="DateRecrutement">
                    </div>

                    @error('DejaBeneficierDuPelerinage')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="checkbox row">
                        <label>
                            <input type="checkbox" name="DejaBeneficierDuPelerinage" checked='false'> Avez-vous bénéficié
                            auparavant
                            du pèlerinage (Hajj)
                        </label>
                    </div>
                    @error('AttestationDuPremiereParticipation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div x-data="{ open: false }">
                        <div class="panel" id="piece-jointes" x-show="open">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="AttestationDuPremiereParticipation"> Attestation de première
                                            participation au
                                            Hajj
                                        </label>
                                        <input type="file" class="form-control-file "
                                            id="AttestationDuPremiereParticipation"
                                            name="AttestationDuPremiereParticipation">
                                    </div>
                                    @error('Demande')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="Demande"> Demande adressée au directeur de l'institution </label>
                                        <input type="file" class="form-control-file " id="Demande" name="Demande">
                                    </div>

                                    @error('DeclarationHonneurFH2')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="DeclarationHonneurFH2"> Attestation de l'authenticité de tous les
                                            documents
                                            fournis
                                        </label>
                                        <input type="file" class="form-control-file " id="DeclarationHonneurFH2"
                                            name="DeclarationHonneurFH2">
                                    </div>

                                    @error('RecuDepenses')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="RecuDepenses"> Recu des Depenses </label>
                                        <input type="file" class="form-control-file " id="RecuDepenses"
                                            name="RecuDepenses">
                                    </div>

                                    @error('Visa')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="Visa"> Visa </label>
                                        <input type="file" class="form-control-file " id="Visa" name="Visa">
                                    </div>

                                    @error('Passport')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="Passport"> Passport (la première page du passeport et le sceau d'entrée
                                            et de
                                            sortie du
                                            Royaume
                                            d'Arabie saoudite) </label>
                                        <input type="file" class="form-control-file " id="Passport" name="Passport">
                                    </div>

                                    @error('ReleveDidentiteBanquer')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="ReleveDidentiteBanquer"> Attestation de ReleveDidentiteBanquer </label>
                                        <input type="file" class="form-control-file " id="ReleveDidentiteBanquer"
                                            name="ReleveDidentiteBanquer">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col d-flex justify-content-end py-3 w-50">
                                    <button type="button" class="btn btn-primary" x-on:click="open = ! open">Étape
                                        suivante</button>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row" x-show="!open">
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn btn-primary"
                            wire:click.prevent={{ $next = true }}>Suivant</button>
                    </div>
                </div> --}}
                    </div>
                </form>
            </div>

            <div x-data="{ open: false }">
                <button x-on:click="open = ! open">Toggle Dropdown</button>

                <div x-show="open">
                    Dropdown Contents...
                </div>
            </div>
        </div>
    </div>
@endsection
