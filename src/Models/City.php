<?php

namespace MasterDmx\L2ppIntegration\Models;

use Illuminate\Database\Eloquent\Model;
use MasterDmx\L2ppIntegration\Contracts\SynchronizableModel;

class City extends Model implements SynchronizableModel
{
    public $timestamps = false;

    protected $table = 'l2pp_cities';
    protected $guarded = [];
    protected $syncAttributes = ['id', 'region_id', 'slug', 'name', 'name_genitive', 'name_prepositional', 'pretext', 'kladr', 'center_coord_1', 'center_coord_2'];

    public function getSyncAttributes()
    {
        return $this->syncAttributes;
    }
}
