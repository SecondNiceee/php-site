               
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content pb-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="globe"></i></div>
                                            <?=$title ?? 'Панель управления';?>
                                        </h1>
                                        
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                       <a href="<?=ADMIN?>/brand/add" class="btn btn-sm btn-light text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            Добавить бренд
                                       </a>
                                    </div>
                                    
                                </div> 
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4">
                        <!-- Example Colored Cards for Dashboard Demo-->
                        <div class="card mb-4"> 
                            <div class="card-body">
                            <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Картинка</th>
                                            <th>Наименование</th>
                                            <th>Статус</th>
                                            <th><i data-feather="edit"></th>
                                            <th><i data-feather="trash-2"></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Картинка</th>
                                            <th>Наименование</th>
                                            <th>Статус</th>
                                            <th><i data-feather="edit"></i></th>
                                            <th><i data-feather="trash-2"></i></th>
                                        </tr>
                                    </tfoot>
                                    <?php if(!empty($brands)): ?>
                                       
                                       <?php foreach($brands as $brand) : ?>
                                        <tr>
                                            <td><?=$brand['id']?></td>
                                            <td><img width="100" src="<?=$brand['img']?>" alt=""></td>
                                            <td><?=$brand['title']?></td>
                                            <td><?php 
                                            if($brand['status'] == '1') {
                                                echo '<div class="badge bg-primary text-white rounded-pill">Активный</div>';
                                             } else {
                                                echo '<div class="badge bg-warning text-white rounded-pill">Отключен</div>';
                                             }?></td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="<?=ADMIN?>/brand/edit?id=<?=$brand['id']?>"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-sm delete" href="<?=ADMIN?>/brand/delete?id=<?=$brand['id']?>"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr> 
                                        <?php endforeach; ?>
                                    </tbody>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>



                        
                       