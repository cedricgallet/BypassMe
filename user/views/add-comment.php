        <!-- ***************************************Formulaire d'ajout d'article*************************************** -->

        <div id="addArticleForm"  class="container-fluid h-100 p-0">                
            <div class="row h-100">                
                <div class="d-flex align-items-center justify-content-center col-12 h-100">
                    <div class="card bg-transparent w-50 h-100">
                        <div class="fw-bold mt-5 mb-5">
                            <h2><?=$title1 ?? ''?></h2>

                            <!-- ************************Message personnalisé************************ -->

                            <?php 
                                if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) 
                                {
                                    if(!array_key_exists($msgCode, $displayMsg))
                                    {
                                        $msgCode = 0;
                                    }
                                    echo '<div class="fs-3 alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                                }
                            ?>
                        </div>

                        <div class="card-body h-100">
                            <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                            
                                <!-- ************************************Commentaire*******************************= -->
                                <div class="mb-3">
                                    <label for="comment" class="col-form-label text-warning">Commentaire*</label>
                                    
                                    <textarea
                                        name ="comment" 
                                        class="bg-transparent form-control text-info" 
                                        id="comment" 
                                        rows="9" 
                                        minlength="10" 
                                        maxlength="300"
                                        placeholder="Votre commentaire">
                                    </textarea>
                                </div>
                                <div class="invalid-feedback-2"><?= htmlentities($errorsArray['comment'] ?? '')?></div>


                                <button type="submit" class="text-start form-control btn text-success border rounded-pill">Envoyer le commentaire</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        