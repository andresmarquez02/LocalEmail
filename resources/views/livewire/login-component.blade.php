<div>
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url({{asset("img/login-register.jpg")}});">
        <div class="login-box card">
            <div class="d-flex card-body">
                <form class="my-auto form-horizontal w-100" id="loginform" wire:submit.prevent='login'>
                    <a href="javascript:void(0)" class="text-center db h3 font-weight-bold">Login</a>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="email" required="" wire:model='email' placeholder="Correo">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" wire:model='password' placeholder="Contraseña">
                        </div>
                    </div>
                    <div class="text-center form-group m-t-20">
                        <div class="col-xs-12">
                            @if ($log == 0)
                                <button class="btn btn-info btn-block btn-rounded" type="submit">Iniciar Sesion</button>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="text-center col-sm-12">
                            Aun no tienes una cuenta? <a href="{{url("register")}}" class="text-primary m-l-5"><b>Registrate</b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div wire:loading wire:target="login">
        <div class="preloader" >
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">EMAIL - LOCAL</p>
            </div>
        </div>
    </div>
</div>
