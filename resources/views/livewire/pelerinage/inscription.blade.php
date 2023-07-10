<div class="card my-2">
    <div class="card-header d-flex justify-content-center text-center">
        <h5 class="programmeAidePelerinage title-card-header"> Programme d'aide financière au pèlerinage de l'année
            {{ $pelerinage->Annee }}</h5>
    </div>
    <div class="card-body">
        @if ($currentStep == 1)
            <h5 class="programmeAidePelerinage mx-2 p-3">Bienvenue cher(e) pèlerin(e)</h5>
            <div class="mx-4 pt-2 px-3 pb-0"
                style="border-radius: 10px; border:1px dotted #025d38;background: rgb(210,240,234);
                background: linear-gradient(160deg, rgba(210,240,234,1) 0%, rgba(210,240,234,1) 8%, rgba(255,255,255,1) 100%);">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row py-0">
                            <label for="Nom" class="col-sm-6 col-form-label" style="color: #025d38">Nom & prénom du
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
                                <label for="Pension" class="col-sm-6 col-form-label" style="color: #025d38">Numéro de
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
                                    <div class="form-group">
                                        <label for="dateNaissance">Date de naissance :</label>
                                        <input type="date" class="form-control" id="dateNaissance"
                                            name="dateNaissance" wire:model.lazy="dateNaissance" max="9999-12-31">
                                    </div>
                                    @error('dateNaissance')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                    @if ($wrongAge)
                                        <div class="alert alert-default-danger">Pour être éligible, il est nécessaire
                                            d'avoir
                                            atteint
                                            l'âge de
                                            50
                                            ans.
                                        </div>
                                    @elseif($correctAge)
                                        <div class="alert alert-default-success">Votre âge est éligible (>=50 ans) pour
                                            répondre
                                            aux
                                            critères
                                            requis.
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dateRecrutement">Date de recrutement :</label>
                                        <input type="date" class="form-control" max="9999-12-31"
                                            wire:model="dateRecrutement">
                                    </div>
                                    @error('dateRecrutement')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                    @if ($correctAnciennete)
                                        <div class="alert alert-default-success">Vous êtes admissible, ayant acquis une
                                            ancienneté d'au
                                            moins 10
                                            ans
                                            conformément aux critères requis.
                                        </div>
                                    @endif
                                    @if ($wrongAnciennete)
                                        <div class="alert alert-default-danger">Pour être éligible, il est nécessaire
                                            d'avoir
                                            une
                                            ancienneté
                                            d'au moins
                                            10 ans.</div>
                                    @endif

                                </div>
                            </div>


                            {{-- @if ($shouldRetire) --}}
                            <div class="row pt-1">
                                <div class="col-md-6">
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <label for="statut" style="color: maroon">Êtes-vous déjà à la retraite
                                            ?</label>
                                        <span class="icheck-danger d-inline px-3">
                                            <input type="radio" name="statut" id="statutRetraite" value="R"
                                                wire:model.lazy="statut" />
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

                            {{-- @endif --}}
                            <div class="row">
                                <div class="col-md-6">
                                    @if ($displayDateRetraite || $statut == 'R')
                                        <div class="form-group">
                                            <label for="dateRetraite">date départ à la retraite :</label>
                                            <input type="date" class="form-control" max="9999-12-31"
                                                wire:model="dateRetraite">
                                        </div>
                                        @error('dateRetraite')
                                            <div class="alert alert-default-danger">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <div class="row pt-3">
                                <div class="col-6">
                                    <div class="checkbox">
                                        <label>
                                            <input class="" type="checkbox" name="DejaBeneficiant"
                                                checked='false' wire:model="dejaBeneficiant">
                                            J'atteste que je n'ai jamais bénéficié précédemment du pèlerinage.
                                        </label>
                                    </div>
                                    @error('dejaBeneficiant')
                                        <div class="alert alert-default-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    @elseif ($currentStep == 2 && $statut != 'Unknown')
                        <div class="panel" id="piece-jointes">
                            <div class="card elevation-0" style="border: 1px solid rgba(128, 128, 128, 0.452)">
                                <div class="card-header" style="background-color: #025d38; color: white">
                                    <h5>Documents requis </h5>
                                </div>
                                <div class="card-body">
                                    {{-- {{ var_export(count($tmplisteDocuments)) }} --}}
                                    <table class=" table table-stripped">
                                        <thead class="table table-secondary">
                                            <th>Type document</th>
                                            <th colspan="2"></th>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($listeDocuments as $doc)
                                                <tr wire:click="clickMe({{ $doc->IdTypeDocument }})">
                                                    <td>{{ $doc->Titre }} :</td>
                                                    <td><a class="btn btn-primary" href="#"
                                                            role="button">voir</a>
                                                    </td>
                                                    <td>
                                                        <label for="file-upload" class="custom-file-upload">
                                                            Téléverser
                                                        </label>
                                                        <input id="file-upload" type="file"
                                                            wire:model="document" />
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            <tr>
                                                <td>
                                                    <p>Demande adressée au président de la Fondation dument rempli :</p>
                                                    <div wire:loading wire:target="demande">
                                                        <x-loading-indicator />
                                                    </div>
                                                    @if ($demande)
                                                        <p>
                                                            <a href="{{ route('pdf.show', ['path' => $demande->getRealPath()]) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{ $demande->getClientOriginalName() }}
                                                            </a>
                                                        </p>
                                                    @elseif ($demandeBD)
                                                        <p>
                                                            <a href="{{ route('pdf.show', ['path' => storage_path('app/public' . $demandeBD)]) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{ basename($demandeBD) }}
                                                            </a>
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($demande)
                                                        <a class="btn btn-primary"
                                                            href="{{ route('pdf.show', ['filename' => $demande->getClientOriginalName(), 'path' => $demande->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            role="button">voir</a>
                                                    @endif
                                                </td>
                                                <td><label for="file-demande" class="custom-file-upload">
                                                        Téléverser
                                                    </label>
                                                    <input id="file-demande" type="file" wire:model="demande" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>Copie de la facture ou de la quittance de paiement des dépenses :
                                                    </p>
                                                    <div wire:loading wire:target="facture">
                                                        <x-loading-indicator />
                                                    </div>
                                                    @if ($facture)
                                                        <a href="{{ route('pdf.show', ['filename' => $facture->getClientOriginalName(), 'path' => $facture->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer">
                                                            {{ $facture->getClientOriginalName() }}
                                                        </a>
                                                    @elseif ($factureBD)
                                                        <p>
                                                            <a href="{{ route('pdf.show', ['path' => storage_path('app/public' . $factureBD)]) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{ basename($factureBD) }}
                                                            </a>
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($facture)
                                                        <a class="btn btn-primary"
                                                            href="{{ route('pdf.show', ['filename' => $facture->getClientOriginalName(), 'path' => $facture->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            role="button">voir</a>
                                                    @endif
                                                </td>
                                                <td><label for="file-facture" class="custom-file-upload">
                                                        Téléverser
                                                    </label>
                                                    <input id="file-facture" type="file" wire:model="facture" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>Certificat des services du ministère de la Santé et de la
                                                        Protection
                                                        Sociale ou des institutions publiques relevant de sa compétence,
                                                        attestant que le demandeur, en tant qu'exerçant ou retraité, n'a
                                                        pas
                                                        bénéficié précédemment du pèlerinage :</p>
                                                    <div wire:loading wire:target="certificat">
                                                        <x-loading-indicator />
                                                    </div>
                                                    @if ($certificat)
                                                        <a href="{{ route('pdf.show', ['path' => $certificat->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer">
                                                            {{ $certificat->getClientOriginalName() }}
                                                        </a>
                                                    @elseif ($certificatBD != null)
                                                        <p>
                                                            <a href="{{ route('pdf.show', ['path' => storage_path('app/public' . $certificatBD)]) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{ basename($certificatBD) }}
                                                            </a>
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($certificat)
                                                        <a class="btn btn-primary"
                                                            href="{{ route('pdf.show', ['path' => $certificat->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            role="button">voir</a>
                                                    @endif
                                                </td>
                                                <td><label for="file-certificat" class="custom-file-upload">
                                                        Téléverser
                                                    </label>
                                                    <input id="file-certificat" type="file"
                                                        wire:model="certificat" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>Déclaration sur l'honneur dans laquelle le demandeur atteste de
                                                        l'authenticité de tous les documents fournis conformément aux
                                                        conditions requises dans cette annonce :</p>
                                                    <div wire:loading wire:target="declaration">
                                                        <x-loading-indicator />
                                                    </div>
                                                    @if ($declaration)
                                                        <a href="{{ route('pdf.show', ['path' => $declaration->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer">
                                                            {{ $declaration->getClientOriginalName() }}
                                                        </a>
                                                    @elseif ($declarationBD != null)
                                                        <p>
                                                            <a href="{{ route('pdf.show', ['path' => storage_path('app/public' . $declarationBD)]) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{ basename($declarationBD) }}
                                                            </a>
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($declaration)
                                                        <a class="btn btn-primary"
                                                            href="{{ route('pdf.show', ['path' => $declaration->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            role="button">voir</a>
                                                    @endif
                                                </td>
                                                <td><label for="file-declaration" class="custom-file-upload">
                                                        Téléverser
                                                    </label>
                                                    <input id="file-declaration" type="file"
                                                        wire:model="declaration" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>Copie du visa pour effectuer les rites du Hajj, ainsi que de la
                                                        première page du passeport et du cachet d'entrée et de sortie du
                                                        Royaume d'Arabie saoudite. :</p>
                                                    <div wire:loading wire:target="visa">
                                                        <x-loading-indicator />
                                                    </div>
                                                    @if ($visa)
                                                        <a href="{{ route('pdf.show', ['path' => $visa->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer">
                                                            {{ $visa->getClientOriginalName() }}
                                                        </a>
                                                    @elseif ($visaBD != null)
                                                        <p>
                                                            <a href="{{ route('pdf.show', ['path' => storage_path('app/public' . $visaBD)]) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{ basename($visaBD) }}
                                                            </a>
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($visa)
                                                        <a class="btn btn-primary"
                                                            href="{{ route('pdf.show', ['path' => $visa->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            role="button">voir</a>
                                                    @endif
                                                </td>
                                                <td><label for="file-visa" class="custom-file-upload">
                                                        Téléverser
                                                    </label>
                                                    <input id="file-visa" type="file" wire:model="visa" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>Attestation de Relevé d'Identité Bancaire (RIB) originale :</p>
                                                    <div wire:loading wire:target="rib">
                                                        <x-loading-indicator/>
                                                    </div>
                                                    @if ($rib)
                                                        <a href="{{ route('pdf.show', ['path' => $rib->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer">
                                                            {{ $rib->getClientOriginalName() }}
                                                        </a>
                                                    @elseif ($ribBD != null)
                                                        <p>
                                                            <a href="{{ route('pdf.show', ['path' => storage_path('app/public' . $ribBD)]) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{ basename($ribBD) }}
                                                            </a>
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($rib)
                                                        <a class="btn btn-primary"
                                                            href="{{ route('pdf.show', ['path' => $rib->getRealPath()]) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            role="button">voir</a>
                                                    @endif
                                                </td>
                                                <td><label for="file-rib" class="custom-file-upload">
                                                        Téléverser
                                                    </label>
                                                    <input id="file-rib" type="file" wire:model="rib" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="row">
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
                            </div> --}}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="card-footer bg-light">
        @if ($currentStep == 1 && $statut != 'Unknown' && $correctAge && $correctAnciennete)
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button type="button" class="buttonNext" wire:click.prevent="nextStep()">Étape
                        suivante</button>
                </div>
            </div>
        @elseif ($currentStep == 2 && $statut != 'Unknown')
            <div class="row">
                <div class="col-md-6"><button type="button" class="btn btn-outline-secondary mx-3"
                        wire:click.prevent="previousStep()">Étape précédente</button>
                </div>
                <div class="col-md-6 d-flex justify-content-end"> 
                    <button type="button" class="buttonNext"
                        wire:click.prevent="inscrire()">
                        {{-- <i class="fas fa-save mr-2"></i> --}}
                        <x-loading-indicator-2 class="mr-2" wire:loading wire:target="inscrire"/>
                        Enregistrer
                    </button>
                    
                </div>
            </div>
        @endif
    </div>
</div>
