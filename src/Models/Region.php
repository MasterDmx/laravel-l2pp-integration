<?php

namespace MasterDmx\L2ppIntegration\Models;

use Illuminate\Database\Eloquent\Model;
use MasterDmx\L2ppIntegration\Contracts\SynchronizableModel;

class Region extends Model implements SynchronizableModel
{
    public $timestamps = false;

    protected $table = 'l2pp_regions';
    protected $guarded = [];
    protected $syncAttributes = ['id', 'slug', 'name', 'name_genitive', 'name_prepositional', 'pretext', 'kladr'];

    public function getSyncAttributes()
    {
        return $this->syncAttributes;
    }
}
