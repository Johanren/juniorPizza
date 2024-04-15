<?php
$listar = new ControladorSistema();
$res = $listar->listarConfiguracionSistema();
?>
<div class="container">
    <div class="tabs-to-dropdown">
        <div class="nav-wrapper d-flex align-items-center justify-content-between">
            <ul class="nav nav-pills d-none d-md-flex" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-config-tab" data-toggle="pill" href="#pills-config" role="tab"
                        aria-controls="pills-config" aria-selected="true">Configuracion</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-product-tab" data-toggle="pill" href="#pills-product" role="tab"
                        aria-controls="pills-product" aria-selected="false">Product</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab"
                        aria-controls="pills-news" aria-selected="false">News</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Contact</a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-config" role="tabpanel" aria-labelledby="pills-config-tab">
                <div class="container-fluid">
                    <form action="" method="post">
                        <h5 class="mb-0 mt-5">Configuración del Sistema</h5>
                        <hr class="my-4" />
                        <strong class="mb-0">Sistema</strong>
                        <p>Habilite la Configuración que desee</p>
                        <div class="list-group mb-5 shadow">
                            <div class="list-group-item">
                                <?php
                                foreach ($res as $key => $value) {
                                    ?>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <strong class="mb-0"><?php echo $value['nombre_confi'] ?></strong>
                                            <p class="text-muted mb-0"><?php echo $value['descripcion'] ?></p>
                                            <strong><?php echo $value['Nota'] ?></strong>
                                        </div>
                                        <div class="col-auto">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="<?php echo $value['nombre_campo'] ?>" <?php if($value['estado']==true){echo "checked";}else{} ?> id="<?php echo $value['nombre_campo'] ?>" 
                                                    type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div id="mensaje"></div>
                        </div>
                        <hr class="my-4" />
                        <strong class="mb-0">Security</strong>
                        <p>Control security alert you will be notified.</p>
                        <div class="list-group mb-5 shadow">
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <strong class="mb-0">Unusual activity notifications</strong>
                                        <p class="text-muted mb-0">Donec in quam sed urna bibendum tincidunt quis mollis
                                            mauris.</p>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <strong class="mb-0">Unauthorized financial activity</strong>
                                        <p class="text-muted mb-0">Fusce lacinia elementum eros, sed vulputate urna
                                            eleifend
                                            nec.
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-product" role="tabpanel" aria-labelledby="pills-product-tab">
                <div class="container-fluid">
                    <h2 class="mb-3 font-weight-bold">Product</h2>
                    <p>Sed auctor urna sit amet eros mattis interdum. Integer imperdiet ante in quam lacinia, a
                        laoreet
                        risus imperdiet. Ut a blandit elit, vitae volutpat nunc. Nam posuere urna sagittis lectus
                        eleifend
                        viverra. Quisque mauris nunc, viverra vitae sodales non, auctor in diam. Sed dignissim
                        pulvinar
                        sapien sed fermentum. Praesent interdum turpis ut neque tristique ornare. Nam dictum est sed
                        sem
                        elementum rutrum. Nam a mollis turpis.</p>
                    <p>Proin odio nisi, aliquet ac ipsum quis, auctor semper leo. Curabitur vitae justo vel augue
                        varius
                        cursus non quis est. Nunc vulputate nunc nibh, sed tempus erat tincidunt eget. Duis a lacus
                        at nulla
                        porttitor tincidunt. Vestibulum euismod elementum mi ut tincidunt. Suspendisse tempus, mi et
                        imperdiet maximus, est turpis placerat massa, at venenatis sem elit ut ex. Donec non aliquam
                        odio.
                        Curabitur ut leo vitae magna lobortis accumsan. Phasellus viverra eu leo non rhoncus.</p>
                    <p>Pellentesque rutrum sit amet nunc sit amet faucibus. Ut id arcu tempus, varius erat et,
                        ornare
                        libero. In quis felis nunc. Aliquam euismod lacus a eros ornare, ut aliquam sem mattis. Cras
                        non
                        varius dui, quis commodo ante. Maecenas gravida est non nulla malesuada egestas.</p>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
                <div class="container-fluid">
                    <h2 class="mb-3 font-weight-bold">News</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor leo nec ligula
                        viverra, quis
                        facilisis nunc vehicula. Maecenas purus orci, efficitur in dapibus vel, rutrum in massa. Sed
                        auctor
                        urna sit amet eros mattis interdum. Integer imperdiet ante in quam lacinia, a laoreet risus
                        imperdiet.</p>
                    <p>Proin maximus iaculis rhoncus. Morbi ante nibh, facilisis semper faucibus consequat,
                        facilisis ut
                        ante. Mauris at nisl vitae justo auctor imperdiet. Cras sodales, justo sed tincidunt
                        venenatis, ante
                        erat ultricies eros, at mollis eros lorem ac mi. Fusce sagittis nibh nunc. Vestibulum ante
                        ipsum
                        primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec mollis eros sodales
                        convallis faucibus. Vestibulum sit amet odio lectus. Duis eu dolor vitae est venenatis
                        viverra eu
                        sit amet nisl. Aenean vel sagittis odio. Quisque in lacus orci. Etiam ut odio lobortis odio
                        consectetur ornare.</p>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="container-fluid">
                    <h2 class="mb-3 font-weight-bold">Contact</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor leo nec ligula
                        viverra, quis
                        facilisis nunc vehicula. Maecenas purus orci, efficitur in dapibus vel, rutrum in massa. Sed
                        auctor
                        urna sit amet eros mattis interdum. Integer imperdiet ante in quam lacinia, a laoreet risus
                        imperdiet.</p>
                    <p>Proin maximus iaculis rhoncus. Morbi ante nibh, facilisis semper faucibus consequat,
                        facilisis ut
                        ante. Mauris at nisl vitae justo auctor imperdiet. Cras sodales, justo sed tincidunt
                        venenatis, ante
                        erat ultricies eros, at mollis eros lorem ac mi. Fusce sagittis nibh nunc. Vestibulum ante
                        ipsum
                        primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec mollis eros sodales
                        convallis faucibus. Vestibulum sit amet odio lectus. Duis eu dolor vitae est venenatis
                        viverra eu
                        sit amet nisl. Aenean vel sagittis odio. Quisque in lacus orci. Etiam ut odio lobortis odio
                        consectetur ornare.</p>
                </div>
            </div>
        </div>
    </div>
</div>