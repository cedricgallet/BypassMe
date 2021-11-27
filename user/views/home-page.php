<!-- ******************Affichage d'un message d'erreur personnalisé******************* -->
<?php 

if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
    if(!array_key_exists($msgCode, $displayMsg)){
        $msgCode = 0;
    }
    echo '<div class="fs-4 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
} 
?>
<!-- ********************************************************************************* -->

   <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <!-- ======================CONTENU HOME PAGE===================== -->

                <section class="page-section bg-primary" id="about">
                    <div class="container px-4 px-lg-5">
                        <div class="row gx-4 gx-lg-5 justify-content-center">
                            <div class="col-lg-8 text-center">
                                <h2 class="text-white mt-0">A VOUS DE FAIRE VOTRE PAGE D'ACCUEIL! ;)</h2>
                                <hr class="divider divider-light" />
                                <p class="text-white-75 mb-4"></p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Services-->
                <section class="page-section" id="services">
                    <div class="container px-4 px-lg-5">
                        <h2 class="text-center mt-0"></h2>
                        <hr class="divider" />
                        <div class="row gx-4 gx-lg-5">
                            <div class="col-lg-3 col-md-6 text-center">
                                <div class="mt-5">
                                    <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                                    <h3 class="h4 mb-2">TITRE</h3>
                                    <p class="text-muted mb-0">PARAGRAPHE
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 text-center">
                                <div class="mt-5">
                                    <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                                    <h3 class="h4 mb-2">TITRE</h3>
                                    <p class="text-muted mb-0">PARAGRAPHE
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 text-center">
                                <div class="mt-5">
                                    <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                                    <h3 class="h4 mb-2">TITRE</h3>
                                    <p class="text-muted mb-0">PARAGRAPHE
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 text-center">
                                <div class="mt-5">
                                    <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                                    <h3 class="h4 mb-2">TITRE</h3>
                                    <p class="text-muted mb-0">PARAGRAPHE</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Portfolio-->

                <div>
                    <h2 class="text-end text-white mt-3 mb-3">PORTFOLIO</h2>
                </div>

                <div id="portfolio" class="row">

                    <div class="col-12 col-lg-4 mb-1 mb-lg-0">
                        <a href="http://saveurantan.manusien-ecolelamanu.fr/"><img
                                src="/../assets/img/portfolio/saveurDantan.png"
                                class="img img-fluid w-100 shadow-1-strong rounded mb-3"
                                alt="site saveur d'antan"></a>

                        <a href="http://maconnerieocordo.localhost/"><img
                                src="/../assets/img/portfolio/maconnerieOcordo.png"
                                class="img img-fluid w-100 shadow-1-strong rounded mb-3"
                                alt="site maconnerieOcordo"></a> </div>

                    <div class="col-12 col-lg-4 mb-1 mb-lg-0">
                        <a href="https://cedricgallet.github.io/Vitrine_Quattro_Stagioni/"><img
                                src="/../assets/img/portfolio/Vitrine_Quattro_Stagioni.png"
                                class="img img-fluid w-100 shadow-1-strong rounded mb-3"
                                alt="site vitrine_Quattro_Stagioni"></a>

                        <a href="http://hanoi.localhost/"><img src="/../assets/img/portfolio/restauranHanoi.png"
                                class="img  img-fluid w-100 shadow-1-strong rounded mb-3" alt="site hanoi"></a>
                    </div>

                    <div class="col-12 col-lg-4 mb-1 mb-lg-0">
                        <a href="http://e-chair.localhost/"><img src="/../assets/img/portfolio/restaurantEchair.png"
                                class="img  img-fluid w-100 shadow-1-strong rounded mb-3" alt="site e-chair"></a>

                        <a href="http://lookthis.localhost/"><img src="/../assets/img/portfolio/siteLookThis.png"
                                class="img img-fluid w-100 shadow-1-strong rounded mb-3" alt="site LookThis"></a>
                    </div>
                </div>
            </div>
            <?php require_once(dirname(__FILE__).'/../../templates/rightMenu.php');?>
        </div>
    </div>