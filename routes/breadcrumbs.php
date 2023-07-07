<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail): void {
    $trail->push('Accueil', route('home'));
});

Breadcrumbs::for('card', function (BreadcrumbTrail $trail): void {
    $trail->push('Card', route('card'));
});

Breadcrumbs::for('search', function (BreadcrumbTrail $trail): void {
    $trail->push('Search', route('search'));
});

Breadcrumbs::for('savecard', function (BreadcrumbTrail $trail): void {
    $trail->push('saveCard', route('saveCard'));
});

Breadcrumbs::for('dashboard.profil', function (BreadcrumbTrail $trail): void {
    $trail->parent('home');
    $trail->push('Mon profil', route('dashboard.profil'));
});

Breadcrumbs::for('dashboard.profil.edit', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard.profil');
    $trail->push('Mettre à jour', route('dashboard.profil.edit'));
});

Breadcrumbs::for('dashboard.profil.Password', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard.profil');
    $trail->push('Changer Mot de passe', route('dashboard.profil.Password'));
});

Breadcrumbs::for('dashboard.profil.beneficiaire', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard.profil');
    $trail->push('Mes Bénéficiaires', route('dashboard.profil.beneficiaire'));
});



Breadcrumbs::for('welcomePelerinage', function (BreadcrumbTrail $trail): void {
    $trail->parent('home');
    $trail->push('Pelerinage', route('accueilPelerinage'));
});
Breadcrumbs::for('FonctionnairePelerinage', function (BreadcrumbTrail $trail): void {
    $trail->parent('welcomePelerinage');
    $trail->push('FonctionnairePelerinage', route('inscriptionPelerinage'));
});
Breadcrumbs::for('retraitePelerinage', function (BreadcrumbTrail $trail): void {
    $trail->parent('welcomePelerinage');
    $trail->push('retraitePelerinage', route('inscriptionPelerinage'));
});
