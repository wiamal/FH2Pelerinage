<div class="panel" id='accueilPanel'>
    @if (isset($errorMessage))
        <div class="row">
            <div class="alert alert-danger">{{ $errorMessage }}</div>
        </div>
    @endif
    <div class="card my-4">
        <div class="card-header d-flex justify-content-center text-center">
            <h5 class="programmeAidePelerinage title-card-header">Bienvenue au programme d'aide au Pèlerinage</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 p-2">
                    Le président de la Fondation Hassan II pour la promotion des œuvres sociales au profit des
                    fonctionnaires de
                    la
                    santé publique informe tous les adhérents de l'ouverture de la période de réception des demandes de
                    bénéficier
                    du soutien dédié au service du pèlerinage pour la saison du Hajj 1444/2023, à partir du 10 juillet
                    jusqu'au
                    20
                    septembre 2023.
                </div>
            </div>
           <div class="row mb-2">
            <div class="col-12 p-0 font-weight-bold">
                <div class="text-info bg-light-info border border-info rounded p-2 font-weight-bold">
                    <i class="fas fa-info-circle mr-1"></i>
                    La Fondation a alloué une aide de 40 000,00 dirhams pour ce service, au profit de chaque adhérent
                    retraité,
                    et
                    de 35 000,00 dirhams pour chaque adhérent toujours en activité.
                </div>
            </div>
           </div>
           <div class="row mb-2">
            <div class="col-12 p-2 bg-light">
                <h6>Les conditions d'éligibilité sont les suivantes:</h6>
                <ul>
                    <li>
                        Le demandeur doit être en bonne position vis-à-vis de l'institution.
                    </li>
                    <li>
                        Il doit avoir dépassé l'âge de 50 ans à la fin du mois de Dhu al-Hijjah.
                    </li>
                    <li>
                        Il doit avoir au moins 10 ans d'expérience de service effectif dans l'administration publique.
                    </li>
                    <li>
                        Il ne doit pas avoir déjà bénéficié d'une aide financière, d'un billet de voyage, d'une
                        indemnité ou
                        d'une
                        subvention similaire provenant du budget des administrations publiques, des institutions
                        publiques,
                        des
                        institutions ou des associations sociales, ou de toute autre institution ou association
                        bénéficiant
                        du
                        soutien de l'État ou des collectivités locales.
                    </li>

                </ul>
            </div>
           </div>
           <div class="row mb-2">
            <div class="col-12  p-0">
                <div class="text-warning bg-light-warning border border-warning rounded p-2 font-weight-bold mb-2">
                    Note: Les membres retraités souhaitant bénéficier de ce service doivent régulariser leur situation
                    vis-à-vis
                    de
                    l'institution de manière proactive.
                </div>
                <p><span class="text-dark font-weight-bold"> Pour participer, remplir le formulaire d'inscription disponible sur notre
                    site.</span> 
                    Nous examinerons attentivement chaque candidature en prenant en compte les critères d'éligibilité.</p>
                <p> Bienvenue sur notre Programme et bonne chance à tous les participants !</p>
            </div>
            
           </div>
           <div class="row">
            <div class="col d-flex justify-content-end">
                <a href="{{ route('inscriptionPelerinage') }}" class="inscriptionbutton">Inscription</a>
            </div>
           </div>
        </div>
        
    </div>
</div>
