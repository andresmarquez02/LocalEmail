<?php

namespace App\Http\Livewire;

use App\Email;
use App\EmailFile;
use App\File;
use App\StatusEmail;
use Livewire\Component;

class SendsComponent extends Component
{
    public function render()
    {
        $emails = Email::where("user_id",auth()->user()->id)
        ->join("status_emails","status_emails.email_id","emails.id")
        ->where("delete",0)
        ->get();
        return view('livewire.sends-component',["emails" => $emails]);
    }

    public function delete($id){

        StatusEmail::where("email_id",$id)->update([
            "delete" => 1,
        ]);

        $this->dispatchBrowserEvent("success",["success" => "Correo eliminado con exito."]);
    }

    public function delete_end($id){

        $status = StatusEmail::where("email_id",$id)
        ->join("status_emails","status_emails.email_id","emails.id")
        ->first();

        if($status->view == 0){

            Email::whereId($id)->delete();
            StatusEmail::whereId("email_id",$id)->delete();
            $email_files = EmailFile::where("email_id",$id)->get();

            foreach($email_files as $email_file){
                $file = File::whereId($email_file->file_id)->first();
                $path_file = public_path()."/".$file->file;
                if(file_exists($path_file)){
                    unlink($path_file);
                }
                $file->delete();
            }

            $email_files->delete();
        }

        $this->dispatchBrowserEvent("success",["success" => "Correo eliminado con exito."]);
    }

}
