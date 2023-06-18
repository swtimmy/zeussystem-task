<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Ticket;
use App\Policies\TicketPolicy;
use App\Models\Comment;
use App\Policies\CommentPolicy;
use App\Models\User;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Ticket::class => TicketPolicy::class,
        Comment::class => CommentPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('delete-ticket', [TicketPolicy::class, 'delete']);
        Gate::define('restore-ticket', [TicketPolicy::class, 'restore']);
        Gate::define('update-ticket', [TicketPolicy::class, 'update']);
        Gate::define('show-deleted', [TicketPolicy::class, 'viewDeleted']);
        Gate::define('add-comment', [CommentPolicy::class, 'create']);
        
    }
}
