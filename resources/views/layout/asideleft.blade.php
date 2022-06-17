<link rel="stylesheet" href="{{ asset('css/inbox.css') }}">
    <div class="bg-light" style="min-height:100vh;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xlg-2 col-lg-3 col-md-4">
                    <div class="px-3 pt-3 pb-1 bg-white rounded inbox-panel" style="box-shadow:0 0 17px -8px #0000002e;min-height:80vh;">
                        <a href="{{url("new/email")}}" class="p-10 btn btn-danger m-b-20 btn-block waves-effect waves-light">Redactar Correo</a>
                        <ul class="mb-3 list-group list-group-full">
                            <li class="list-group-item {{request()->path("home") == "home" ? "active" : ""}}">
                                <a href="{{url("home")}}">
                                    <i class="mdi mdi-gmail"></i> Recibidos
                                </a>
                            </li>
                            <li class="list-group-item {{request()->path("emails/favorites") == "emails/favorites" ? "active" : ""}}">
                                <a href="{{route("emails_favorites")}}"> <i class="mdi mdi-star"></i> Favoritos </a>
                            </li>
                            <li class="list-group-item {{request()->path("emails/sends") == "emails/sends" ? "active" : ""}}">
                                <a href="{{route("emails_sends")}}"> <i class="mdi mdi-send"></i> Enviados </a><span
                                    class="ml-auto badge badge-danger">3</span>
                            </li>
                            <li class="list-group-item {{request()->path("emails/archiveds") == "emails/archiveds" ? "active" : ""}}">
                                <a href="{{route("emails_tofiles")}}"> <i class="mdi mdi-inbox-arrow-down"></i> Archivados </a>
                            </li>
                            <li class="list-group-item {{request()->path("emails/spams") == "emails/spams" ? "active" : ""}}">
                                <a href="{{route("emails_spams")}}"> <i class="mdi mdi-close"></i> Spam </a>
                            </li>
                            <li class="list-group-item {{request()->path("emails/trash") == "emails/trash" ? "active" : ""}}">
                                <a href="{{route("emails_trash")}}"> <i class="mdi mdi-delete"></i> Papelera </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{url("logout")}}"> <i class="mdi mdi-close"></i> Salir </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xlg-10 col-lg-9 col-md-8">
                    <div class="position-relative">
                        @yield("contain")
                    </div>
                </div>
            </div>
        </div>
    </div>
