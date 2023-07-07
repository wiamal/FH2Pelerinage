<?php

use App\Models\vueenfant;
use App\Models\vueadherent;
use App\Models\vueconjoint;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


function setMenuClASs($route, $clASse)
{
    $routeActuel = request()->route()->getName();

    if (contains($routeActuel, $route)) {
        return $clASse;
    }
    return "";
}

function setMenuActive($route)
{
    $routeActuel = request()->route()->getName();

    if ($routeActuel === $route) {
        return "active";
    }
    return "";
}

function contains($container, $contenu)
{
    return Str::contains($container, $contenu);
}

function ExistAdherent($cin, $affiliation)
{

    $adherent = DB::table('ab6')
        ->where([
            ['CIN', '=', $cin],
            ['Affiliation', '=', $affiliation]
        ])->first();

    if ($adherent === null) {
        return false;
    }
    return true;
}


function getAdherentFullName($affiliation)
{

    $adherent = DB::table('ab6')
        ->where('Affiliation', '=', $affiliation)->first();
    return $adherent->Nom . ' ' . $adherent->Prenom;
}
function getAdherentFullNameById($id)
{
    $adherent = DB::table('ab6')
        ->where('id_adh', '=', $id)->first();
    return $adherent->Nom . ' ' . $adherent->Prenom;
}
function getAdherentAffiliation($id)
{
    $adherent = DB::table('ab6')
        ->where('idAdherent', '=', $id)->first();
    return $adherent->Affiliation;
}
function AdherentHASAccount($id)
{
    $user = DB::table('users-pelerinage')
        ->where('IdAdherent', '=', $id)->first();
    if ($user === null) {
        return false;
    }
    return true;
}

// function userFullName(){
//     return auth()->user()->name;
//    /*  return getAdherentFullNameById(auth()->user()->idAdherent); */
// }
function userEmailaddress()
{
    return auth()->user()->email;
    /*  return getAdherentFullNameById(auth()->user()->idAdherent); */
}
function getAdherentFields($id)
{
    $adherent = DB::table('ab6')
        ->where('id_adh', $id)->first();
    return $adherent;
}

function getAdherentConjoint($id)
{

    $results = DB::select(' SELECT  conj.Affiliation AS Aff,
                                        q.nomQualite AS Qualite,
                                        conj.NomConjoint AS NomConjoint,
                                        conj.PrenomConjoint AS PrenomConjoint,
                                        conj.NomArConjoint AS NomArConjoint,
                                        conj.PrenomArConjoint AS PrenomArConjoint
                                FROM    
                                        ab6 AS adh
                                        INNER JOIN conjoint AS conj
                                        ON conj.IdAdherent = adh.IdAdherent
                                        INNER JOIN qualite AS q 
                                        ON q.IdQualite = conj.IdQualite 
                                        where adh.IdAdherent = :id', ['id' => $id]);

    return $results;
}

function getAdherentEnfants($id)
{

    $results = DB::select(' SELECT  enf.Affiliation AS Aff,
                                        q.nomQualite AS Qualite,
                                        enf.Nom AS NomEnfant,
                                        enf.Prenom AS PrenomEnfant,
                                        enf.NomAr AS NomArEnfant,
                                        enf.PrenomAr AS PrenomArEnfant
                                    FROM    
                                        adherent AS adh
                                        INNER JOIN Enfant AS enf
                                        ON enf.IdAdherent = adh.IdAdherent
                                        INNER JOIN qualite AS q 
                                        ON q.IdQualite = enf.IdQualite 
                                        where adh.IdAdherent = :id', ['id' => $id]);

    return $results;
}

function getConjointCards($id)
{
    $results = DB::select(' SELECT 
                            conj.AffiliationConjoint AS Aff,
                            q.nomQualite AS Qualité,
                            conj.NomConjoint AS Nom,
                            conj.PrenomConjoint AS Prenom,
                            conj.NomArConjoint AS NomAr,
                            conj.PrenomArConjoint AS PrenomAr,
                            conj.PhotoConjoint AS Photo,
                            conj.CINConjoint AS CINConjoint,
                            adh.Nom AS NOMAdhérent,
                            adh.Prenom AS PRENOMAdhérent,
                            adh.CIN AS CINAdhérent,
                            fon.PPR AS PPR,

                            carte.DateImpression AS DateImpression,
                            carte.Active AS StatutCarte
                            FROM 
                            adherent AS adh 
                            INNER JOIN conjoint AS conj 
                            on conj.IdAdherent = adh.IdAdherent 
                            INNER JOIN fonction AS fon 
                            on fon.IdAdherent = adh.IdAdherent 
                            INNER JOIN qualite AS q 
                            on q.IdQualite = conj.IdQualite
                            INNER JOIN carte AS carte 
                            on conj.IdConjoint = carte.IdConjoint
                            where adh.IdAdherent = :id', ['id' => $id]);

    return $results;
}

function getEnfantCards($id)
{
    $results = DB::select(' SELECT 
                            enf.AffiliationEnfant AS Aff,
                            q.nomQualite AS Qualité,
                            enf.NomEnfant AS Nom,
                            enf.PrenomEnfant AS Prenom,
                            enf.NomArEnfant AS NomAr,
                            enf.PrenomArEnfant AS PrenomAr,
                            
                            adh.Nom AS NOMAdhérent,
                            adh.Prenom AS PRENOMAdhérent,
                            adh.CIN AS CINAdhérent,
                            fon.PPR AS PPR,
                            carte.DateImpression AS DateImpression,
                            carte.Active AS StatutCarte

                            FROM 
                            adherent AS adh 
                            INNER JOIN enfant AS enf 
                            on enf.IdAdherent = adh.IdAdherent 
                            INNER JOIN fonction AS fon 
                            on fon.IdAdherent = adh.IdAdherent 
                            INNER JOIN qualite AS q 
                            on q.IdQualite = enf.IdQualite
                            INNER JOIN carte AS carte 
                            on enf.IdEnfant = carte.IdEnfant
                            where adh.IdAdherent = :id', ['id' => $id]);

    return $results;
}

function vueAdherent()
{
    /*  return  vueadherent::select("*")->distinct()->get()->toArray();  */
    return  vueadherent::select("*")->get()->toArray();
}
function vueConjoint()
{
    return vueconjoint::select("*")->get()->toArray();
}
function vueEnfant()
{
    return vueenfant::select("*")->get()->toArray();
}

function getAdherentId($cin, $affiliation)
{
    $adherent = DB::table('ab6')
        ->where('Affiliation', $affiliation)->where('cin', $cin)->first();
    if ($adherent === null) {
        return 0;
    }
    return $adherent->id_adh;
}

function getEnfantId($affiliation)
{
    $enfant = DB::table('enfant')
        ->where('Affiliation', $affiliation)->first();
    if ($enfant === null) {
        return 0;
    }
    return $enfant->IdEnfant;
}

function getConjointId($affiliation)
{
    $conjoint = DB::table('conjoint')
        ->where('Affiliation', $affiliation)->first();
    if ($conjoint === null) {
        return 0;
    }
    return $conjoint->IdConjoint;
}
