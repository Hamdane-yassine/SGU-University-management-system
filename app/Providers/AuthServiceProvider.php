<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
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
