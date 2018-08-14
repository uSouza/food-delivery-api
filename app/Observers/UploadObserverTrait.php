<?php
namespace App\Observers;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
trait UploadObserverTrait
{
    protected function sendFile($model)
    {
        $field = $this->field;
        if (is_a($model->$field, UploadedFile::class) and $model->$field->isValid()) {
            $this->upload($model);
        }
    }
    protected function removeFile($model)
    {
        $field = $this->field;
        Storage::delete($this->path . $model->$field);
        $model->image_base64 = '';
    }
    protected function updateFile($model)
    {
        $field = $this->field;
        if (is_a($model->$field, UploadedFile::class) and $model->$field->isValid()) {
            $previous_image = $model->getOriginal($field);
            $this->upload($model);
            Storage::delete($this->path . $previous_image);
        }
    }
    protected function upload($model)
    {
        $field = $this->field;
        $extension = $model->$field->extension();
        $name = bin2hex(openssl_random_pseudo_bytes(8));
        $name = $name . '.' . $extension;
        $model->$field->storeAs($this->path, $name);
        $model->$field = $name;
        $url = $this->path.'/'.$name;
        $file = file_get_contents($url);
        $model->image_base64 = 'data:image/'.$extension.';base64,'.base64_encode($file);
    }
}