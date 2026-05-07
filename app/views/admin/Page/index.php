               
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content pb-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                            <?=$title ?? 'Панель управления';?>
                                        </h1>
                                        
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                       <a href="<?=ADMIN?>/page/add" class="btn btn-sm btn-light text-primary">
                                       <div class="page-header-icon"><i data-feather="plus"></i></div>
                                            Добавить страницу
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
                                            <th>id страницы</th>
                                            <th>Наименование</th>
                                            <th><i data-feather="edit"></th>
                                            <th><i data-feather="trash-2"></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>id страницы</th>
                                            <th>Наименование</th>
                                            <th><i data-feather="edit"></i></th>
                                            <th><i data-feather="trash-2"></th>
                                        </tr>
                                    </tfoot>
                                    <?php if(!empty($pages)): ?>
                                       
                                       <?php foreach($pages as $page) : ?>
                                        <tr>
                                            <td><?=$page['id']?></td>
                                            <td><?=$page['title']?></td>
                                           
                                            <td>
                                                <a class="btn btn-info btn-sm" href="<?=ADMIN?>/page/edit?id=<?=$page['id']?>"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-sm delete" href="<?=ADMIN?>/page/delete?id=<?=$page['id']?>"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr> 
                                        <?php endforeach; ?>
                                    </tbody>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>



                        
                       