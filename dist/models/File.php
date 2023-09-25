<?php

namespace Toolkit\models;

class File extends PostType
{
    const TYPE = 'attachment';

    public function url()
    {
        return wp_get_attachment_url($this->id());
    }
}
