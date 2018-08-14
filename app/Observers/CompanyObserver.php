<?php

namespace App\Observers;

use App\Company;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanyObserver
{
    use UploadObserverTrait;

    protected $field = 'url';
    protected $path = 'img/companies/';

    public function creating(Company $model)
    {
        $this->sendFile($model);
    }

    public function deleting(Company $model)
    {
        $this->removeFile($model);
    }

    public function updating(Company $model)
    {
        $this->updateFile($model);
    }
}
