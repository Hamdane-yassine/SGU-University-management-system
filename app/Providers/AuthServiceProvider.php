<?php

namespace App\Providers;

use App\Models\Absence;
use App\Models\Departement;
use App\Models\Etudiant;
use App\Models\Evenement;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Professeur;
use App\Models\Profile;
use App\Policies\AbsencePolicy;
use App\Policies\DepartementPolicy;
use App\Policies\EtudiantPolicy;
use App\Policies\EvenementPolicy;
use App\Policies\FilierePolicy;
use App\Policies\MatierePolicy;
use App\Policies\NotePolicy;
use App\Policies\ProfesseurPolicy;
use App\Policies\ProfilePolicy;
use App\Policies\UserPolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Profile::class => ProfilePolicy::class,
        Evenement::class => EvenementPolicy::class,
        User::class => UserPolicy::class,

        // chef
        Departement::class => DepartementPolicy::class,
        Absence::class => AbsencePolicy::class,
        // end chef

        // prof
        Etudiant::class => EtudiantPolicy::class,
        Filiere::class => FilierePolicyPolicyPolicy::class,
        Matiere::class => MatierePolicy::class,
        Professeur::class => ProfesseurPolicyPolicy::class,
        Filiere::class => FilierePolicy::class,
        Note::class => NotePolicy::class,
        Professeur::class => ProfesseurPolicy::class,
        // end prof
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
            ->subject(Lang::get('Verifier Votre Adresse Email '))
            ->line(Lang::get('Clicker sur le bouton ci-desous pour vertifer votre adresse email.'))
            ->action(Lang::get('Verifier l\'Adresse Email'), $url)
            ->line(Lang::get('Si vous n\'avez pas créé de compte ou modifié votre adresse e-mail, aucune autre action n\'est requise.'));;;
        });
    }
}
