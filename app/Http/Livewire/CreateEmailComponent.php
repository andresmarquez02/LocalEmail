<?php

namespace App\Http\Livewire;

use App\Email;
use App\StatusEmail;
use App\File;
use App\EmailFile;
use App\Events\Email as EventsEmail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEmailComponent extends Component
{
    use WithFileUploads;

    public $email, $subject, $description, $files, $password;

    public function render()
    {
        return view('livewire.create-email-component');
    }

    public function store(){
        $this->validate([
            "email" => "email|required",
            "subject" => "required|max:255",
            "description" => "required",
        ]);

        DB::beginTransaction();
        try {
            $email = Email::create([
                "email_send" => $this->email,
                "subject" => $this->subject,
                "description" => $this->description,
                "user_id" => auth()->user()->id,
            ]);

            StatusEmail::create([
                "email_id" => $email->id,
            ]);

            // Archivos para adjuntar
            foreach($this->files as $value) {
                $url = $value->store("files_emails");
                $file_id = File::create([
                    "file" => $url,
                ]);
                EmailFile::create([
                    "file_id" => $file_id->id,
                    "email_id" => $email->id,
                ]);
            }
            event(new EventsEmail(["id" => $email->id,"password" => $this->password]));
            DB::commit();
            $this->reset();
            return redirect()->to("emails/sends");

        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            $this->dispatchBrowserEvent("error", ["error" => "Ocurrio un error inesperado..."]);
        }
    }
}
