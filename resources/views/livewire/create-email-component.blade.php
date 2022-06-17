<div>
    <div class="p-4 bg-white rounded position-relative">
        <form wire:submit.prevent="store" class="m-0 row">
            <div class="col-12">
                <h3 class="card-title">Redactar Nuevo Correo</h3>
            </div>
            <div class="form-group col-lg-6">
                <input class="form-control" placeholder="Para:" name="email" wire:model="email">
                @error("email")
                    <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <input class="form-control" placeholder="Asunto:" name="subject" wire:model="subject">
                @error("subject")
                    <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group col-12">
                <textarea  class="textarea_editor form-control" name="description" wire:model="description" rows="7" placeholder="Descripcion ..."></textarea>
                @error("description")
                    <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group col-12">
                <h4>
                    <i class="mdi mdi-link"></i> Archivos <span class="small">(Puedes enviar multiples archivos)</span>
                </h4>
                <input name="file" type="file" wire:model="files" multiple class="form-control"/>
                @error("email")
                    <small>{{$message}}</small>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="mt-2 btn btn-success">
                    <i class="mdi mdi-send"></i> Enviar
                </button>
            </div>
        </form>
    </div>
    <div wire:loading wire:target="store">
        <div class="rounded preloader position-absolute" style="width:94%">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">EMAIL - LOCAL</p>
            </div>
        </div>
    </div>
</div>
