@extends('dashboard.dashboard')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/welcomePelerinage.css') }}">
@endsection

@section('content')
    @if (isset($errorMessage))
        <div class="row">
            <div class="alert alert-danger">{{ $errorMessage }}</div>
        </div>
    @endif
    <div class="row mx-5 programmeAidePelerinage">
        <h2>Bienvenue au Programme d'Aide au Pèlerinage !</h2>
        <br>
        <div class="col-12 p-2">

            Le président de la Fondation Hassan II pour la promotion des œuvres sociales au profit des fonctionnaires de la
            santé publique informe tous les adhérents de l'ouverture de la période de réception des demandes de bénéficier
            du soutien dédié au service du pèlerinage pour la saison du Hajj 1444/2023, à partir du 10 juillet jusqu'au 20
            septembre 2023.
        </div>
        <div class="col-12 p-2 font-weight-bold">
            La Fondation a alloué une aide de 40 000,00 dirhams pour ce service, au profit de chaque adhérent retraité, et
            de 35 000,00 dirhams pour chaque adhérent toujours en activité.
        </div>



        <div class="col-12 p-2">Les conditions d'éligibilité sont les suivantes:</div>

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
                Il ne doit pas avoir déjà bénéficié d'une aide financière, d'un billet de voyage, d'une indemnité ou d'une
                subvention similaire provenant du budget des administrations publiques, des institutions publiques, des
                institutions ou des associations sociales, ou de toute autre institution ou association bénéficiant du
                soutien de l'État ou des collectivités locales.
            </li>

        </ul>


        <div class="col-12  p-2">
            Note: Les membres retraités souhaitant bénéficier de ce service doivent régulariser leur situation vis-à-vis de
            l'institution de manière proactive.
        </div>


        <div class="col-12  p-2"> Pour participer, veuillez remplir le formulaire d'inscription disponible sur notre site.
            Nous examinerons attentivement chaque candidature en prenant en compte les critères d'éligibilité.</div>

        <div class="col-12 p-2"> Bienvenue sur notre Programme et bonne chance à tous les participants !</div>

    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 p-5 text-center">
            <div class="col"><a href="/retraitePelerinage" class="inscriptionbutton">Inscription pour les retaites</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 p-5 text-center">
            <div class="col"><a href="/FonctionnairePelerinage" class="inscriptionbutton">Inscription pour les
                    fonctionaires</a></div>
        </div>
    </div>
@endsection
