<div class="card my-4">
    <div class="card-header">
        <h2 class="programmeAidePelerinage">
            Programme d'aide au pèlerinage de l'annee {{ $pelerinage->Annee }}
        </H2>
    </div>
    <div class="card-body">
        <h5 class="mx-2 p-3">Bienvenue cher(e) pèlerin(e)</h5>
        <div class="panel bg-light mx-4 pt-3 px-5 pb-0 rounded-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="Nom" class="col-sm-6 col-form-label">Nom & prenom du pèlerin : </label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="Nom"
                                wire:model.lazy="nom">
                        </div>
                        @error('Nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="NomAr"
                                style="text-align: right" wire:model="nomAr">
                        </div>
                        <label for="NomAr" class="col-sm-6 col-form-label" style="text-align: right">: الاسم و النسب
                        </label>

                        @error('NomAr')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    @if ($statut = 'F')
                        <div class="form-group row">
                            <label for="PPR" class="col-sm-6 col-form-label">PPR : </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" wire:model="ppr">
                            </div>
                            @error('PPR')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
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
                        </div> --}}
                    @elseif ($statut = 'R')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="PPR">Pension</label>
                                    <input type="text" class="form-control" wire:model.lazy="PPR"
                                        value="{{ $adherent->Pension_Retraite }}">
                                    @error('PPR')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
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
                            </div> --}}
                        {{-- @elseif($statut = 'UR')
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger text-center mx-5" role="alert">Vous n'avez pas informer
                            la
                            Fondation Hassan II
                            de votre départ à la retraite. Merci de vous présentez à la fondation
                            ou auprès de votre coordonnateur régional afin de régler votre situation
                            administrative,
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
                            <input type="hidden" name="EtatFonction" id="EtatFonction" value="FonctionaireRetraite">
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
                </div> --}}
                    @endif
                </div>
            </div>

        </div>

        <div class="row mx-4 my-4">
            <div class="col">

                <div class="">
                    @if (isset($errorMessage))
                        <div class="alert alert-danger text-center mx-5">{{ $errorMessage }}</div>
                    @endif
                </div>
                @error('dateNaissance')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="dateNaissance">Date Naissance :</label>
                    <input type="date" class="form-control" id="dateNaissance" name="dateNaissance"
                        wire:model.lazy="dateNaissance" max="9999-12-31">
                </div>
                @if ($shouldRetire)
                    <div class="row pt-3">
                        <div class="col-md-6">
                            <div class="form-group d-flex justify-content-start align-items-center  p-2">
                                <label for="statut">Êtes-vous déjà à la retraite ?</label>
                                <span class="icheck-danger d-inline px-3">
                                    <input type="radio" name="statut" id="statutRetraite" value="R" checked
                                        wire:model.lazy="statut" />
                                    <label for="statutRetraite">
                                        Oui
                                    </label>
                                </span>
                                <span class="icheck-green d-inline px-3">
                                    <input type="radio" name="statut" id="statutFonctionnaire" value="F"
                                        wire:model.lazy="statut" />
                                    <label for="statutFonctionnaire">
                                        Non
                                    </label>
                                </span>

                            </div>
                        </div>
                    </div>
                @endif
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @error('dateRecrutement')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="dateRecrutement">Date Recrutement :</label>
                        <input type="date" class="form-control" max="9999-12-31" wire:model="dateRecrutement">
                    </div>

                    @error('DejaBeneficierDuPelerinage')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="checkbox row pt-3 mx-1">
                        <label>
                            <input type="checkbox" name="DejaBeneficierDuPelerinage" class="mx-2" checked='false'>
                            Avez-vous déjà reçu une aide financière pour votre pèlerinage précédent ?
                        </label>
                    </div>

                    {{-- @error('AttestationDuPremiereParticipation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}
                    {{-- <div x-data="{ open: false }">
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
                        <div class="row" x-show="!open">
                            <div class="col d-flex justify-content-end">
                                <button type="button" class="btn btn-primary"
                                    wire:click.prevent={{ $next = true }}>Suivant</button>
                            </div>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</div>
