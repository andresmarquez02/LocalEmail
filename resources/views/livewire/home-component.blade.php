<div>
    <div class="p-3 bg-white rounded position-relative">
        <div class="p-3 inbox-center table-responsive">
            <table class="table table-hover no-wrap">
                <tbody>
                    @forelse ($emails as $email)
                        <tr class="unread">

                            @if ($action != "trash")
                                @if ($action != "spam")
                                    <td style="width:40px" class="hidden-xs-down" data-toggle="tooltip" data-placement="top" title="Spam"
                                    wire:click="spam({{$email->id}})">
                                        <i class="mdi mdi-close pointer"></i>
                                    </td>
                                @endif
                                @if ($action != "favorite")
                                    <td style="width:40px" class="hidden-xs-down" data-toggle="tooltip" data-placement="top" title="Favorito"
                                    wire:click="favorite({{$email->id}})">
                                        @if($email->favorite == 0)
                                            <i class="mdi mdi-star-outline pointer"></i>
                                        @else
                                            <i class="mdi mdi-star pointer text-warning"></i>
                                        @endif
                                    </td>
                                @endif
                                @if ($action != "archived")
                                    <td style="width:40px" class="hidden-xs-down" data-toggle="tooltip" data-placement="top" title="Archivar"
                                    wire:click="archived({{$email->id}})">
                                        <i class="mdi mdi-inbox-arrow-down pointer"></i>
                                    </td>
                                @else
                                    <td style="width:40px" class="hidden-xs-down" data-toggle="tooltip" data-placement="top" title="Archivar"
                                    wire:click="archived({{$email->id}})">
                                        <i class="mdi mdi-inbox-arrow-up pointer"></i>
                                    </td>
                                @endif
                                <td style="width:40px" class="hidden-xs-down" data-toggle="tooltip" data-placement="top" title="Eliminar"
                                wire:click="delete({{$email->id}})">
                                    <i class="mdi mdi-delete pointer text-danger" ></i>
                                </td>
                            @else
                                <td style="width:40px" class="hidden-xs-down" data-toggle="modal" data-target="#modelId{{$email->id}}">
                                    <span data-toggle="tooltip" data-placement="top" title="Eliminar Permanentemente">
                                        <i class="mdi mdi-delete pointer text-danger" ></i>
                                    </span>
                                </td>
                                <!-- Modal eliminar-->
                                <div class="modal fade" id="modelId{{$email->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminar Correo</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Esta seguro de Eliminar este correo?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="delete_end({{$email->id}})">Eliminar</button>
                                                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <td class="hidden-xs-down">
                                {{ Str::limit($email->user()->name, 15, '...')}}
                            </td>
                            <td class="max-texts">
                                <a href="">
                                    {{ Str::limit($email->description, 50, '...')}}
                                </a>
                            </td>
                            <td class="hidden-xs-down">
                                <i class="fa fa-paperclip"></i>
                            </td>
                            <td class="text-right"> {{__($email->created_at->diffForHumans())}} </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <h3>No Tienes Correos</h3>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div wire:loading>
        <div class="rounded preloader position-absolute" style="width:96%">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">EMAIL - LOCAL</p>
            </div>
        </div>
    </div>
</div>
