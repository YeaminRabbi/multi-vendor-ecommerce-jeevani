<?php
namespace App\Traits;
 use Filament\Panel;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;
 use Illuminate\Support\Collection;

 use TomatoPHP\FilamentAccounts\Models\Team;

 trait InteractsWithTenant{

     public function canAccessPanel(Panel $panel): bool
     {
         return true;
     }

     public function getTenants(Panel $panel): Collection
     {
         return $this->teams()->get();
     }
//
     public function canAccessTenant(Model $tenant): bool
     {
         return (bool)$this->teams()->where('team_id', $tenant->id)->first();
     }
//
     public function getDefaultTenant(Panel $panel): ?Model
     {
         return $this->latestTeam;
     }
//
     public function latestTeam(): BelongsTo
     {
         return $this->belongsTo(Team::class, 'current_team_id');
     }
 }
