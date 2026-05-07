<main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content pb-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="edit"></i></div>
                                            <?=$title ?? 'Панель управления';?>
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        <a class="btn btn-sm btn-light text-primary" href="<?=ADMIN?>/product">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left me-1"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                            Вернутся к товарам
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
                                 <label class="required" for="parent_id">Категория</label>
                                 <?php
                                    new \app\widgets\menu\Menu([
                                       'cache' => 0,
                                       'cacheKey' => 'admin_menu_select',
                                       'class' => 'form-control',
                                       'container' => 'select',
                                       'attrs' => [
                                          'name' => 'parent_id',
                                          'id' => 'parent_id',
                                          'required' => 'required',
                                       ],
                                       'tpl' => APP . '/widgets/menu/admin_select_prod_tpl.php',
                                       'prepend' => '<option value="0">Выберите категорию</option>',
                                    ])
                                 ?>
                              </div>
                              <div class="mb-3"> 
                                 <label class="required" for="brand_id">Бренд</label>
                                 <select class="form-control" name="brand_id" id="brand_id">
                                    <option value="0">Выберите бренд</option>
                                    <?php foreach($brands as $brand): ?>
                                    <option value="<?=$brand['id']?>" <?php if($brand['id'] == $product['brand_id']) echo 'selected';?>><?=$brand['title']?></option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label for="exampleFormControlInput1">Наименование</label>
                                 <input class="form-control" id="exampleFormControlInput1" name='title' type="text" placeholder="Наименование товара" value="<?=h($product['title'])?>" >
                              </div>
                              <div class="mb-3">
                                 <label for="exampleFormControlTextarea1">Описание</label>
                                 <textarea class="form-control editor" name="content" id="exampleFormControlTextarea1" rows="3"><?=h($product['content'])?></textarea>
                              </div>
                              <div class="card mb-4">
                                 <div class="card-header">Параметры</div>
                                 <div class="card-body add" id="card-body">
                                    <button class="btn btn-blue add-todo mb-4" type="button" onclick="addInput()">Добавить</button>
                                    <?php if(!empty($product['product_info'])) :?>
                                       <?php $coin = 0; ?>
                                    <?php foreach($product['product_info'] as $val) :?>
                                       
                                    <div class="row gx-3 mb-3" id="input<?=$coin?>">
                                       <div class="col-md-5">
                                          <label class="small mb-1" for="inputFirstName">Параметр</label>
                                          <input class="form-control" name="product_info[<?=$coin?>][key]" id="inputFirstName" type="text" value="<?=h($val['info_key']);?>" placeholder="Укажите параметр" >
                                       </div>      
                                       <div class="col-md-5">
                                          <label class="small mb-1" for="inputLastName">Значение</label>
                                          <input class="form-control" name="product_info[<?=$coin?>][value]" id="inputLastName" value="<?=h($val['info_val']);?>" type="text" placeholder="Укажите значение" >
                                       </div>
                                       <div class="col-md-2" style="text-align: end;">
                                          <button class="btn btn-danger del-todo" style="margin-top: 1.7rem;" type="button" onclick="delInput(<?=$coin?>)">Удалить</button>
                                       </div>
                                    </div>
                                    <?php $coin++; ?>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                 </div>                           
                              </div>
                              
                              <div class="card mb-3">
                                 <div class="card-header">Загрузить картинку</div>
                                 <div class="card-body ">
                                    <!-- Profile picture image-->
                                    <div id="base-img-output" class="upload-images base-image mb-2">
                                    <?php if($product['img']) : ?>
                                          <div class="product-img-upload">
                                             <img style="max-width: 400px;" src="<?=$product['img']?>">
                                             <input type="hidden" name="img" value="<?=$product['img']?>">
                                             <?php if($product['img'] != NO_IMAGE): ?>
                                             <a style="margin-left:20px;" class="del-img btn btn-danger btn-lg">
                                             <i class="far fa-trash-alt"></i></a>
                                             <?php endif; ?>
                                          </div>
                                       <?php endif; ?>
                                    </div>
                                   
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">JPG или PNG</div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" id="add-base-img" onclick="popupBaseImage(); return false;" type="button">Загрузить картнку</button>
                                 </div>
                              </div>
                              <div class="card mb-3">
                                 <div class="card-header">Брошюра</div>
                                 <div class="card-body ">
                                    <!-- Profile picture image-->
                                    <div id="base-brosh-output" class="upload-images base-image mb-2">
                                       <?php if($product['brochure']) : ?>
                                       <div class="product-img-upload">
                                          <i style="height: 50px; margin-right: 10px; margin-bottom: -15px" class="fa-regular fa-file-pdf"></i>
                                          <span><?=preg_replace(' /\/.*\//', '', $product['brochure'])?></span>
                                          <input type="hidden" name="broshura" value="<?=$product['brochure']?>">
                                          <a style="margin-left:20px;" class="del-img btn btn-danger btn-lg">
                                          <i class="far fa-trash-alt"></i></a>
                                       </div>
                                       <?php endif; ?>
                                    </div>
                                   
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">PDF</div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" id="add-base-img" onclick="popupBaseBrosh(); return false;" type="button">Загрузить</button>
                                 </div>
                              </div>
                              <div class="card mb-3">
                                 <div class="card-header">Тех. описание</div>
                                 <div class="card-body ">
                                    <!-- Profile picture image-->
                                    <div id="base-teh-output" class="upload-images base-image mb-2">
                                    <?php if($product['tech_desc']) : ?>
                                       <div class="product-img-upload">
                                          <i style="height: 50px; margin-right: 10px; margin-bottom: -15px" class="fa-regular fa-file-pdf"></i>
                                          <span><?=preg_replace(' /\/.*\//', '', $product['tech_desc'])?></span>
                                          <input type="hidden" name="teh" value="<?=$product['tech_desc']?>">
                                          <a style="margin-left:20px;" class="del-img btn btn-danger btn-lg">
                                          <i class="far fa-trash-alt"></i></a>
                                       </div>
                                       <?php endif; ?>
                                    </div>
                                   
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">PDF</div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" id="add-base-img" onclick="popupBaseTeh(); return false;" type="button">Загрузить</button>
                                 </div>
                              </div>
                              <div class="card mb-4">
                                 <div class="card-header">Мета теги</div>
                                 <div class="card-body">
                                    <div class="mb-3">
                                       <label for="exampleFormControlInput3">Ключевые слова</label>
                                       <input class="form-control" id="exampleFormControlInput3" name='keywords' type="text" placeholder="Ключевые слова товара" value="<?=h($product['keywords'])?>">
                                    </div>
                                    <div class="mb-3">
                                       <label for="exampleFormControlInput3">Мета описание</label>
                                       <input class="form-control" id="exampleFormControlInput3" name='description' type="text" placeholder="мета описание товара" value="<?=h($product['description'])?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-check">
                                 <input class="form-check-input" name="status" id="flexCheckChecked" type="checkbox" <?php if($product['status'] == 1) echo 'checked';?>>
                                 <label class="form-check-label mb-3" for="flexCheckChecked">Показывать на сайте</label>
                              </div>
                              <button type="submit" class="btn btn-primary">Сохранить</button>
                           </form>
                        </div>


                        <script>                           
                           let coin = 0;
                           let cardBody = document.getElementById('card-body');
                           let coinEl = cardBody.childElementCount;
                           if(coinEl > 1) {
                              coin = coinEl - 2;
                           }
                           function addInput() {
                              let body = document.getElementById('input' + coin);
                              coin++;
                              if(body) {
                                 body.insertAdjacentHTML('afterEnd', `<div class="row gx-3 mb-3" id="input` + coin + `">
                                                   <div class="col-md-5">
                                                      <label class="small mb-1" for="inputFirstName">Параметр</label>
                                                      <input class="form-control" name="product_info[` + coin + `][key]" id="inputFirstName" type="text" placeholder="Укажите параметр" >
                                                   </div>      
                                                   <div class="col-md-5">
                                                      <label class="small mb-1" for="inputLastName">Значение</label>
                                                      <input class="form-control" name="product_info[` + coin + `][value]" id="inputLastName" type="text" placeholder="Укажите значение" >
                                                   </div>
                                                   <div class="col-md-2" style="text-align: end;">
                                                      <button class="btn btn-danger del-todo" style="margin-top: 1.7rem;" type="button" onclick="delInput(` + coin + `)">Удалить</button>
                                                   </div>
                                                </div>`);   
                              } else {
                                 coin = 0;
                                 cardBody.innerHTML += `<div class="row gx-3 mb-3" id="input` + coin + `">
                                                   <div class="col-md-5">
                                                      <label class="small mb-1" for="inputFirstName">Параметр</label>
                                                      <input class="form-control" name="product_info[` + coin + `][key]" id="inputFirstName" type="text" placeholder="Укажите параметр" >
                                                   </div>      
                                                   <div class="col-md-5">
                                                      <label class="small mb-1" for="inputLastName">Значение</label>
                                                      <input class="form-control" name="product_info[` + coin + `][value]" id="inputLastName" type="text" placeholder="Укажите значение" >
                                                   </div>
                                                   <div class="col-md-2" style="text-align: end;">
                                                      <button class="btn btn-danger del-todo" style="margin-top: 1.7rem;" type="button" onclick="delInput(` + coin + `)">Удалить</button>
                                                   </div>
                                                </div>`;
                              }
                           }

                           function delInput(id) {
                              let div = document.getElementById('input' + id);
                              div.remove();
                           }
                           

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
                           function popupBaseBrosh() {
                              CKFinder.popup( { 
                                    chooseFiles: true,
                                    onInit: function( finder ) {
                                       finder.on( 'files:choose', function( evt ) {
                                          var file = evt.data.files.first();
                                          const baseImgOutput = document.getElementById( 'base-brosh-output' );
                                          baseImgOutput.innerHTML = '<div class="product-img-upload"><i style="height: 50px; margin-right: 10px; margin-bottom: -15px" class="fa-regular fa-file-pdf"></i><span>' + file.getUrl().replace( /\/.*\//, '' ) + '</span><input type="hidden" name="broshura" value="' + file.getUrl() + '"><a style="margin-left:20px;" class="del-img btn btn-danger btn-lg"><i class="far fa-trash-alt"></i></a></div>';
                                       } );
                                       finder.on( 'file:choose:resizedImage', function( evt ) {
                                          const baseImgOutput = document.getElementById( 'base-brosh-output' );
                                          baseImgOutput.innerHTML = '<div class="product-img-upload"><i style="height: 50px;" class="fa-regular fa-file-pdf"></i><span>' + file.getUrl().replace( /\/.*\//, '' ) + '</span><input type="hidden" name="broshura" value="' + evt.data.resizedUrl + '"><a style="margin-left:20px;" class="del-img btn btn-danger btn-lg"><i class="far fa-trash-alt"></i></a></div>';
                                       } );
                                    }
                              } );
                           }

                           function popupBaseTeh() {
                              CKFinder.popup( {
                                    chooseFiles: true,
                                    onInit: function( finder ) {
                                       finder.on( 'files:choose', function( evt ) {
                                          var file = evt.data.files.first();
                                          const baseImgOutput = document.getElementById( 'base-teh-output' );
                                          baseImgOutput.innerHTML = '<div class="product-img-upload"><i style="height: 50px; margin-right: 10px; margin-bottom: -15px" class="fa-regular fa-file-pdf"></i><span>' + file.getUrl().replace( /\/.*\//, '' ) + '</span><input type="hidden" name="teh" value="' + file.getUrl() + '"><a style="margin-left:20px;" class="del-img btn btn-danger btn-lg"><i class="far fa-trash-alt"></i></a></div>';
                                       } );
                                       finder.on( 'file:choose:resizedImage', function( evt ) {
                                          const baseImgOutput = document.getElementById( 'base-teh-output' );
                                          baseImgOutput.innerHTML = '<div class="product-img-upload"><i style="height: 50px;" class="fa-regular fa-file-pdf"></i><input type="hidden" name="teh" value="' + evt.data.resizedUrl + '"><a style="margin-left:20px;" class="del-img btn btn-danger btn-lg"><i class="far fa-trash-alt"></i></a></div>';
                                       } );
                                    }
                              } );
                           }
                        </script>
                        
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


