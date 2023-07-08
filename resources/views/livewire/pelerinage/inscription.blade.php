<div class="card my-4">
    <div class="card-header">
        <h2 class="programmeAidePelerinage">
            Programme d'aide financière au pèlerinage de l'année {{ $pelerinage->Annee }}
        </H2>
    </div>
    <div class="card-body">
        @if ($currentStep == 1)
            <h5 class="programmeAidePelerinage mx-2 p-3">Bienvenue cher(e) pèlerin(e)</h5>
            <div class="bg-white mx-4 pt-2 px-3 pb-0" style="border-radius: 10px; border:1px dotted #025d38;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row py-0">
                            <label for="Nom" class="col-sm-6 col-form-label" style="color: #025d38">Nom & prenom du
                                pèlerin(e) : </label>
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
                        <div class="form-group row py-0">
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="NomAr"
                                    style="text-align: right" wire:model="nomAr">
                            </div>
                            <label for="NomAr" class="col-sm-6 col-form-label"
                                style="text-align: right; color: #025d38">: الاسم و
                                النسب
                            </label>

                            @error('NomAr')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                @if ($statut == 'F')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="PPR" class="col-sm-6 col-form-label" style="color: #025d38">PPR :
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" wire:model="ppr">
                                </div>
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
                @elseif ($statut == 'R')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="Pension" class="col-sm-6 col-form-label" style="color: #025d38">Nnumero de
                                    pension :
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" wire:model="pension">
                                </div>
                                @error('Pension')
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
                        <div class="alert alert-default-danger text-center mx-5" role="alert">Vous n'avez pas informer
                            la
                            Fondation Hassan II
                            de votre départ à la retraite. Merci de vous présentez à la fondation
                            ou auprès de votre coordonnateur régional afin de régler votre situation
                            administrative,
                            pour que votre inscription sera prise en compte</div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="row ">
                            <div class="col-12 p-5 text-center">
                                <b>40000dh</b>
                            </div>
                        </div>
                    </div>
                </div> --}}
                @elseif ($statut == 'Unknown')
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-default-danger text-center mx-5" role="alert">Votre
                                adhésion à la Fondation Hassan II n'est pas complète. Veuillez vous rendre à la
                                fondation ou contacter votre coordonnateur régional pour régulariser votre
                                situation administrative afin que votre demande d'aide financière pour le
                                pèlerinage soit prise en compte.
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            {{-- @elseif ($currentStep == 2 && $statut != 'Unknown')
            <h5>Liste des documents requis pour la demande d'aide financière au pèlerinage.</h5> --}}
        @endif
        <div class="row mx-4 my-4">
            <div class="col">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($currentStep == 1 && $statut != 'Unknown')
                        <div class="panel">
                            <div class="">
                                @if (isset($errorMessage))
                                    <div class="alert alert-default-danger text-center mx-5">{{ $errorMessage }}</div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    @error('dateNaissance')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="dateNaissance">Date de naissance :</label>
                                        <input type="date" class="form-control" id="dateNaissance"
                                            name="dateNaissance" wire:model.lazy="dateNaissance" max="9999-12-31">
                                    </div>
                                </div>
                            </div>

                            @if ($wrongAge)
                                <div class="alert alert-default-danger">Pour être éligible, il est nécessaire d'avoir
                                    atteint
                                    l'âge de
                                    50
                                    ans.</div>
                            @elseif($correctAge)
                                <div class="alert alert-default-success">Votre âge est éligible (>=50 ans) pour répondre
                                    aux
                                    critères
                                    requis.</div>
                            @endif
                            @if ($shouldRetire)
                                <div class="row pt-1">
                                    <div class="col-md-6">
                                        <div class="form-group d-flex justify-content-start align-items-center">
                                            <label for="statut" style="color: red">Êtes-vous déjà à la retraite
                                                ?</label>
                                            <span class="icheck-danger d-inline px-3">
                                                <input type="radio" name="statut" id="statutRetraite" value="R"
                                                    checked wire:model.lazy="statut" />
                                                <label for="statutRetraite">
                                                    Oui
                                                </label>
                                            </span>
                                            <span class="icheck-green d-inline px-3">
                                                <input type="radio" name="statut" id="statutFonctionnaire"
                                                    value="F" wire:model.lazy="statut" />
                                                <label for="statutFonctionnaire">
                                                    Non
                                                </label>
                                            </span>

                                        </div>
                                    </div>
                                </div>
                                @if ($displayDateRetraite)
                                    <div class="row pt-1">
                                        <div class="col-md-6">
                                            @error('dateRetraite')
                                                <div class="alert alert-default-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="dateRetraite">Date depart a la retraite :</label>
                                                <input type="date" class="form-control" max="9999-12-31"
                                                    wire:model="dateRetraite">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    @error('dateRecrutement')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="dateRecrutement">Date de recrutement :</label>
                                        <input type="date" class="form-control" max="9999-12-31"
                                            wire:model="dateRecrutement">
                                    </div>
                                </div>
                            </div>
                            @if ($correctAnciennete)
                                <div class="alert alert-default-success">Vous êtes admissible, ayant acquis une
                                    ancienneté d'au
                                    moins 10
                                    ans
                                    conformément aux critères requis.
                                </div>
                            @endif
                            @if ($wrongAnciennete)
                                <div class="alert alert-default-danger">Pour être éligible, il est nécessaire d'avoir
                                    une
                                    ancienneté
                                    d'au moins
                                    10 ans.</div>
                            @endif
                            @error('DejaBeneficierDuPelerinage')
                                <div class="alert alert-default-danger">{{ $message }}</div>
                            @enderror
                            <div class="checkbox row pt-3 mx-1">
                                <label>
                                    <input class="" type="checkbox" name="DejaBeneficierDuPelerinage"
                                        class="mx-2" checked='false'>
                                    Avez-vous bénéficié précédemment d'une aide financière pour un pèlerinage antérieur
                                    ?
                                </label>
                            </div>
                        </div>
                    @elseif ($currentStep == 2 && $statut != 'Unknown')
                        <div class="panel" id="piece-jointes">
                            <div class="card elevation-0">
                                <div class="card-header" style="background-color: #025d38; color: white">
                                    <h5>Documents requis </h5>
                                </div>
                                <div class="card-body">
                                    <table class=" table table-stripped">
                                        <thead class="table table-secondary">
                                            <th>Type document</th>
                                            <th colspan="2"></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($listeDocuments as $doc)
                                                <tr>
                                                    <td>{{ $doc->Titre }} :</td>
                                                    <td><a class="btn btn-primary" href="#"
                                                            role="button">voir</a>
                                                    </td>
                                                    <td><a class="btn btn-primary" href="#"
                                                            role="button">Téléverser</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{-- <tr>
                                                <td>Demande adressée au président de la Fondation dument rempli :</td>
                                                <td><a class="btn btn-primary" href="#" role="button">voir</a>
                                                </td>
                                                <td><a class="btn btn-primary" href="#"
                                                        role="button">Téléverser</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Copie de la facture ou de la quittance de paiement des dépenses :
                                                </td>
                                                <td><a class="btn btn-primary" href="#" role="button">voir</a>
                                                </td>
                                                <td><a class="btn btn-primary" href="#"
                                                        role="button">Téléverser</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Certificat des services du ministère de la Santé et de la Protection
                                                    Sociale ou des institutions publiques relevant de sa compétence,
                                                    attestant que le demandeur, en tant qu'exerçant ou retraité, n'a pas
                                                    bénéficié précédemment du pèlerinage :</td>
                                                <td><a class="btn btn-primary" href="#" role="button">voir</a>
                                                </td>
                                                <td><a class="btn btn-primary" href="#"
                                                        role="button">Téléverser</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Déclaration sur l'honneur dans laquelle le demandeur atteste de
                                                    l'authenticité de tous les documents fournis conformément aux
                                                    conditions requises dans cette annonce :</td>
                                                <td><a class="btn btn-primary" href="#" role="button">voir</a>
                                                </td>
                                                <td><a class="btn btn-primary" href="#"
                                                        role="button">Téléverser</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Copie du visa pour effectuer les rites du Hajj, ainsi que de la
                                                    première page du passeport et du cachet d'entrée et de sortie du
                                                    Royaume d'Arabie saoudite. :</td>
                                                <td><a class="btn btn-primary" href="#" role="button">voir</a>
                                                </td>
                                                <td><a class="btn btn-primary" href="#"
                                                        role="button">Téléverser</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Attestation de Relevé d'Identité Bancaire (RIB) originale :</td>
                                                <td><a class="btn btn-primary" href="#" role="button">voir</a>
                                                </td>
                                                <td><a class="btn btn-primary" href="#"
                                                        role="button">Téléverser</a>
                                                </td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    @error('AttestationDuPremiereParticipation')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row">
                                        <label for="AttestationDuPremiereParticipation"> Attestation de première
                                            participation au pèlerinage
                                        </label>
                                        <input type="file" class="form-control-file "
                                            id="AttestationDuPremiereParticipation"
                                            name="AttestationDuPremiereParticipation">
                                    </div>
                                    @error('Demande')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="Demande"> Demande adressée au directeur de l'institution </label>
                                        <input type="file" class="form-control-file " id="Demande"
                                            name="Demande">
                                    </div>

                                    @error('DeclarationHonneurFH2')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
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
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="RecuDepenses"> Recu des Depenses </label>
                                        <input type="file" class="form-control-file " id="RecuDepenses"
                                            name="RecuDepenses">
                                    </div>

                                    @error('Visa')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="Visa"> Visa </label>
                                        <input type="file" class="form-control-file " id="Visa"
                                            name="Visa">
                                    </div>

                                    @error('Passport')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="Passport"> Passport (la première page du passeport et le sceau
                                            d'entrée
                                            et de
                                            sortie du
                                            Royaume
                                            d'Arabie saoudite) </label>
                                        <input type="file" class="form-control-file " id="Passport"
                                            name="Passport">
                                    </div>

                                    @error('ReleveDidentiteBanquer')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group row ">
                                        <label for="ReleveDidentiteBanquer"> Attestation de ReleveDidentiteBanquer
                                        </label>
                                        <input type="file" class="form-control-file " id="ReleveDidentiteBanquer"
                                            name="ReleveDidentiteBanquer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="card-footer bg-light">
        @if ($currentStep == 1 && $statut != 'Unknown')
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button type="button" class="buttonNext" wire:click.prevent="nextStep()">Étape
                        suivante</button>
                </div>
            </div>
        @elseif ($currentStep == 2 && $statut != 'Unknown')
            <div class="row">
                <div class="col-md-6"><button type="button" class="btn btn-outline-secondary mx-3"
                        wire:click.prevent="previousStep()">Étape precedente</button></div>
                <div class="col-md-6 d-flex justify-content-end"> <button type="button" class="buttonNext"
                        wire:click.prevent="demander()">Enregistrer</button></div>
            </div>
        @endif
    </div>
</div>
</div>
</div>
