<?php

namespace MasterDmx\LaravelL2ppIntegration\Models;

use App\Traits\SluggableScope;
use Illuminate\Database\Eloquent\Model;
use MasterDmx\LaravelL2ppIntegration\Contracts\SynchronizableModel;

class City extends Model implements SynchronizableModel
{
    use SluggableScope;

    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'l2pp_cities';
    protected $guarded = [];
    protected $syncAttributes = ['id', 'region_id', 'slug', 'name', 'name_genitive', 'name_prepositional', 'pretext', 'kladr', 'center_coord_1', 'center_coord_2'];

    public function getSyncAttributes()
    {
        return $this->syncAttributes;
    }

    public function getNameWithPretext()
    {
        return $this->pretext . ' ' . $this->name_prepositional;
    }

    // --------------------------------------------------------------
    // Relations
    // --------------------------------------------------------------

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
