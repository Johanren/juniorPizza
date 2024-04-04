<div class="container mt-5">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bienvendio</h1>
                                </div>
                                <form class="user" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                            name="user" aria-describedby="emailHelp"
                                            placeholder="Ingresa tu usuario...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" name="clave" placeholder="Contraseña...">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Acuérdame de
                                                mí</label>
                                        </div>
                                    </div>
                                    <button name="login" class="btn btn-primary">Acceder</button>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?php
$ingresar = new ControladorUsuario();
$ingresar->loginControlador();
if (isset($_GET['action'])) {
    if ($_GET['action'] == "loginFallido") {
        print '<script>
                swal("Ops!", "El usuario y/o contraseña invalidos", "error");
            </script>';
    }if ($_GET['action'] == "loginInactivo") {
        print '<script>
                swal("Ops!", "El usuario ha sido desabilitado", "error");
            </script>';
    }
}
?>