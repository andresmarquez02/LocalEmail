<?php

namespace App\Http\Livewire;

use App\Email;
use App\EmailFile;
use App\File;
use App\StatusEmail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeComponent extends Component
{
    public $action;

    public function render()
    {
        $emails = Email::where("email_send",auth()->user()->email)
        ->join("status_emails","status_emails.email_id","emails.id")
        ->select("emails.*","favorite");

        $this->emails_views_check();

        if($this->action == "favorite")
            $emails->where("favorite",1)
            ->where("spam",0)
            ->where("trash",0)
            ->where("to_file",0);

        else if($this->action == "archived")
            $emails->where("spam",0)
            ->where("trash",0)
            ->where("to_file",1);

        else if($this->action == "spam")
            $emails->where("spam",1)
            ->where("trash",0)
            ->where("to_file",0);

        else if($this->action == "trash")
            $emails->where("trash",1)
            ->where("delete_user",0)
            ->where("spam",0)
            ->where("to_file",0);

        else
            $emails->where("spam",0)
            ->where("trash",0)
            ->where("to_file",0);

        return view('livewire.home-component',["emails" => $emails->get()]);
    }

    public function emails_views_check(){

        $emails = Email::where("email_send",auth()->user()->email)
        ->join("status_emails","status_emails.email_id","emails.id")
        ->select("emails.*","favorite");

        foreach($emails->where("view",0)->get() as $email){
            StatusEmail::where("email_id",$email->id)->update([
                "view" => 1,
            ]);
        }
    }

    public function spam($id){
        StatusEmail::where("email_id",$id)->update([
            "spam" => 1,
        ]);
        $this->dispatchBrowserEvent("success",["success" => "Correo agregado a Spam"]);
    }

    public function favorite($id){
        StatusEmail::where("email_id",$id)->update([
            "favorite" => 1,
        ]);
        $this->dispatchBrowserEvent("success",["success" => "Correo agregado a favorito"]);
    }

    public function archived($id){
        StatusEmail::where("email_id",$id)->update([
            "to_file" => 1,
        ]);
        $this->dispatchBrowserEvent("success",["success" => "Correo agregado a Archivados"]);
    }

    public function delete($id){
        StatusEmail::where("email_id",$id)->update([
            "trash" => 1,
        ]);
        $this->dispatchBrowserEvent("success",["success" => "Correo agregado en la papelera, despues de 10 dias sera borrado permanentemente"]);
    }

    public function delete_end($id){

        DB::transaction(function () use ($id) {
            $status = StatusEmail::where("email_id",$id)
            ->first();

            if($status->delete == 1){

                Email::whereId($id)->delete();
                StatusEmail::where("email_id",$id)->delete();
                $email_files = EmailFile::where("email_id",$id)->get();

                foreach($email_files as $email_file){
                    $file = File::whereId($email_file->file_id)->first();
                    $path_file = public_path()."/".$file->file;
                    if(file_exists($path_file)){
                        unlink($path_file);
                    }
                    File::whereId($email_file->file_id)->delete();
                }

                EmailFile::where("email_id",$id)->delete();
            }
            else{
                StatusEmail::where("email_id",$id)->update([
                    "delete_user" => 1
                ]);
            }
        });

        $this->dispatchBrowserEvent("success",["success" => "Correo eliminado con exito."]);
    }
}
