<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Files extends Model
{
    //
    public function getSrcAttribute()
    {
        return \Storage::url($this->file_name);
    }
}
