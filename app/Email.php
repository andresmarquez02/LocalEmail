<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $guarded = [];

    public function files(){
        return EmailFile::join("files","files.id","email_files.file_id")
        ->where("email_id",$this->id)->get();
    }

    public function user(){
        return User::whereId($this->user_id)->first();
    }
}
