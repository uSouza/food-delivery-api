<?php

namespace App\Observers;

use App\Menu;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MenuObserver
{
    use UploadObserverTrait;

    protected $field = 'url';
    protected $path = 'img/menus/';

    public function creating(Menu $model)
    {
        $this->sendFile($model);
    }

    public function deleting(Menu $model)
    {
        $this->removeFile($model);
    }

    public function updating(Menu $model)
    {
        $this->updateFile($model);
    }
}
