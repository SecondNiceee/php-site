<main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content pb-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="plus"></i></div>
                                            <?=$title ?? 'Панель управления';?>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        <a class="btn btn-sm btn-light text-primary" href="<?=ADMIN?>/brand">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left me-1"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                            Вернутся к брендам
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4">
                        <!-- Example Colored Cards for Dashboard Demo-->
                        <div class="row">
                           <form method="post" action="">
                              <div class="mb-3">
                                 <label for="exampleFormControlInput1">Наименование</label>
                                 <input class="form-control" id="exampleFormControlInput1" name='title' type="text" placeholder="Наименование бренда" value="<?=get_field_value('title')?>" >
                              </div>
                              <div class="card mb-3">
                                 <div class="card-header">Загрузить логотип</div>
                                 <div class="card-body ">
                                    <!-- Profile picture image-->
                                    <div id="base-img-output" class="upload-images base-image mb-2"></div>
                                   
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">JPG или PNG</div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" id="add-base-img" onclick="popupBaseImage(); return false;" type="button">Загрузить картнку</button>
                                 </div>
                              </div>
                              <div class="form-check">
                                 <input class="form-check-input" name="status" id="flexCheckChecked" type="checkbox" checked>
                                 <label class="form-check-label mb-3" for="flexCheckChecked">Показывать на сайте</label>
                              </div>
                              <div class="form-check">
                                 <input class="form-check-input" name="popular" id="flexCheckPopular" type="checkbox" <?php if(get_field_value('popular') == 'on') echo 'checked' ?>>
                                 <label class="form-check-label mb-3" for="flexCheckPopular">Популярный бренд</label>
                              </div>
                              <button type="submit" class="btn btn-primary">Добавить</button>
                           </form>
                           <?php
                              if (isset($_SESSION['form_data'])) {
                                 unset($_SESSION['form_data']);
                              }
                           ?>
                        </div>


                        <script>                           
                                              

                           function popupBaseImage() {
                              CKFinder.popup( {
                                    chooseFiles: true,
                                    onInit: function( finder ) {
                                       finder.on( 'files:choose', function( evt ) {
                                          var file = evt.data.files.first();
                                          const baseImgOutput = document.getElementById( 'base-img-output' );
                                          baseImgOutput.innerHTML = '<div class="product-img-upload"><img style="max-width: 400px;" src="' + file.getUrl() + '"><input type="hidden" name="img" value="' + file.getUrl() + '"><a style="margin-left:20px;" class="del-img btn btn-danger btn-lg"><i class="far fa-trash-alt"></i></a></div>';
                                       } );
                                       finder.on( 'file:choose:resizedImage', function( evt ) {
                                          const baseImgOutput = document.getElementById( 'base-img-output' );
                                          baseImgOutput.innerHTML = '<div class="product-img-upload"><img style="max-width: 400px;" src="' + evt.data.resizedUrl + '"><input type="hidden" name="img" value="' + evt.data.resizedUrl + '"><a style="margin-left:20px;" class="del-img btn btn-danger btn-lg"><i class="far fa-trash-alt"></i></a></div>';
                                       } );
                                    }
                              } );
                           }
                           
                        </script>


