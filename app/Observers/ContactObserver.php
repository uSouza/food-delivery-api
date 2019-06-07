<?php
/**
 * Created by PhpStorm.
 * User: uesley
 * Date: 13/08/18
 * Time: 00:12
 */

namespace App\Observers;


use App\Contact;
use App\Mail\ContactReceived;
use Illuminate\Support\Facades\Mail;

class ContactObserver
{
    public function creating(Contact $contact)
    {
        Mail::to('')
            ->cc(['', '', ''])
            ->send(new ContactReceived($contact));
    }
}