<?php

namespace MasterDmx\LaravelL2ppIntegration\Models\Organization;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;

    protected $table = 'l2pp_organizations_types';
    protected $fillable = ['id', 'name', 'name_plural'];

    // ---------------------------------------------------------
    // SCOPES
    // ---------------------------------------------------------
}
