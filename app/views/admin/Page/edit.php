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
                                        <a class="btn btn-sm btn-light text-primary" href="<?=ADMIN?>/page">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left me-1"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                            Вернутся к страницам
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
                              <label for="exampleFormControlSelect1">Расположение меню</label>
                                 <select name="menu" class="form-control" id="exampleFormControlSelect1">
                                    <option value="top">Верхнее меню</option>
                                    <option value="company">Компания</option>
                                    <option value="buyers">Покупателям</option>
                              </select>
                           </div>
                              <div class="mb-3">
                                 <label for="exampleFormControlInput1">Наименование</label>
                                 <input class="form-control" id="exampleFormControlInput1" name='title' type="text" placeholder="Имя страницы" value="<?=$page['title']?>" required>
                              </div>
                              <div class="mb-3">
                                 <label for="exampleFormControlTextarea1">Контент</label>
                                 <textarea class="form-control editor" name="content" id="exampleFormControlTextarea1" rows="3"><?=$page['content']?></textarea>
                              </div>
                              <div class="card mb-3 base-icon-hide">
                                 <div class="card-header">Мета теги</div>
                                 <div class="card-body ">
                                    <div class="mb-3">
                                       <label for="exampleFormControlInput2">Описание</label>
                                       <input class="form-control" id="exampleFormControlInput2" name='description' type="text" placeholder="Описание категории" value="<?=get_field_value('description')?>">
                                    </div>
                                    <div class="mb-3">
                                       <label for="exampleFormControlInput3">Ключевые слова</label>
                                       <input class="form-control" id="exampleFormControlInput3" name='keywords' type="text" placeholder="Ключевые слова категории" value="<?=get_field_value('keywords')?>">
                                    </div>
                                 </div>
                              </div>
                              <button type="submit" class="btn btn-primary">Сохранить</button>
                           </form>
                           <?php
                              if (isset($_SESSION['form_data'])) {
                                 unset($_SESSION['form_data']);
                              }
                           ?>
                        </div>
                        

                        <script>
                           window.editors = {};
                           document.querySelectorAll( '.editor' ).forEach( ( node, index ) => {
                              ClassicEditor
                                    .create( node, {
                                       ckfinder: {
                                          uploadUrl: '<?= PATH ?>/sbadmin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                                       },
                                       
                                       image: {
                                          toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight' ],
                                          styles: [
                                                'alignLeft',
                                                'alignCenter',
                                                'alignRight'
                                          ]
                                       },
                                       
                                    } )
                                    .then( newEditor => {
                                       window.editors[ index ] = newEditor
                                    } )
                                    .catch( error => {
                                       console.error( error );
                                    } );
                           });
                        </script>



