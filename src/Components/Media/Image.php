<?php

namespace MasterDmx\LaravelL2ppIntegration\Components\Media;

use MasterDmx\LaravelMedia\Entities\Media\Image as BaseImage;

class Image extends BaseImage
{
    public function getUrl()
    {
        return route('l2pp.get.media', $this->path);
    }
}
