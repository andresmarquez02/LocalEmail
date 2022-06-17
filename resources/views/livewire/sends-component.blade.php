<div>
    <div class="p-3 bg-white rounded position-relative">
        <div class="p-3 inbox-center table-responsive">
            <table class="table table-hover no-wrap">
                <tbody>
                    @forelse ($emails as $email)
                        <tr class="unread">
                            <td style="width:40px" class="hidden-xs-down" data-toggle="modal" data-target="#modelId{{$email->id}}">
                                <span data-toggle="tooltip" data-placement="top" title="Eliminar Permanentemente">
                                    <i class="mdi mdi-delete pointer text-danger" ></i>
                                </span>
                            </td>
                            <td class="hidden-xs-down">
                                {{ Str::limit($email->user()->name, 15, '...')}}
                            </td>
                            <td class="max-texts">
                                <a href="">
                                    {{ Str::limit($email->description, 60, '...')}}
                                </a>
                            </td>
                            <td class="hidden-xs-down">
                                <i class="fa fa-paperclip"></i>
                            </td>
                            <td class="text-right"> {{__($email->created_at->diffForHumans())}} </td>
                        </tr>
                        <!-- Modal -->
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
                                        @if ($email->view == 0)
                                            <button type="button" class="btn btn-danger" wire:click="delete_end({{$email->id}})" data-dismiss="modal">Eliminar permanentemente</button>
                                        @endif
                                        <button type="button" class="btn btn-warning" data-dismiss="modal" wire:click="delete({{$email->id}})">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <h3>No Tienes Correos Enviados</h3>
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
