 <div class="panel" id="liste-inscrits">
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-header">
                     <div class="row">
                         <div class="col-md-6">
                             <h5>Liste des inscrits a l'aide financiere au pelerinage. Annee : {{ $annee }}</h5>
                         </div>
                         <div class="col-md-6 d-flex justify-content-end">
                             {{-- @can('creer-lot')
                                 <button type="button" class="btn btn-outline-info" style="width: 30%"
                                     wire:click.prevent='go2createLot()'>
                                     <i class="fa-solid fa-plus mr-2"></i>Nouveau lot
                                 </button>
                             @endcan --}}
                         </div>
                     </div>
                 </div>
                 <div class="card-body">
                     <table class="table table-striped display py-6" id="ListeInscrits">
                         <thead>
                             <tr>
                                 <th>ID Inscription</th>
                                 <th>Affiliation</th>
                                 <th>Nom & prenom</th>
                                 <th>الإسم و النسب</th>
                                 <th>Sexe</th>
                                 <th>Date de naissance</th>
                                 <th>Age</th>
                                 <th>Situation familiale</th>
                                 <th>CIN</th>
                                 <th>Retraite</th>
                                 <th>PPR</th>
                                 @if ($retraite)
                                     <th>Pension</th>
                                 @endif
                                 <th>Grade</th>
                                 <th>Tel</th>
                                 <th>Fixe</th>
                                 <th>Email</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($listeInscrits as $insc)
                                 <tr>
                                     <td><strong> {{ $insc->IdInscription }}</strong></td>
                                     <td> {{ $insc->Affiliation }}</td>
                                     <td>
                                         {{ $insc->Nom . ' ' . $insc->Prenom }}
                                     </td>
                                     <td>
                                         {{ $insc->NomAr . ' ' . $insc->PrenomAr }}
                                     </td>
                                     <td>
                                         {{ $insc->pid == 1 ? 'Homme' : 'Femme' }}
                                     </td>
                                     <td>
                                         {{ $insc->Date_Naissance }}
                                     </td>
                                     <td>
                                         {{ \Carbon\Carbon::parse($insc->Date_Naissance)->age }}
                                     </td>

                                     <td>
                                         {{ $insc->Situation_Famille }}
                                     </td>
                                     <td>
                                         {{ $insc->CIN }}
                                     </td>
                                     <td>
                                         {{ $insc->Pension_Retraite != null ? 'Oui' : 'Non' }}
                                     </td>
                                     <td>
                                         {{ $insc->PPR }}
                                     </td>
                                     @if ($insc->Pension_Retraite != null)
                                         <td>
                                             {{ $insc->Pension_Retraite }}
                                         </td>
                                     @endif
                                     <td>
                                         {{ $insc->grade }}
                                     </td>
                                     <td>
                                         {{ $insc->GSM }}
                                     </td>
                                     <td>
                                         {{ $insc->Fixe }}
                                     </td>
                                     <td>
                                         {{ $insc->email }}
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
