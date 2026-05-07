               
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content pb-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="shopping-bag"></i></div>
                                            <?=$title ?? 'Панель управления';?>
                                        </h1>
                                        
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
                                            <th>id заказа</th>
                                            <th>Статус</th>
                                            <th>Создан</th>
                                            <th>Изменен</th>
                                            <th><i data-feather="edit"></th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>id заказа</th>
                                            <th>Статус</th>
                                            <th>Создан</th>
                                            <th>Изменен</th>
                                            <th><i data-feather="edit"></i></th>
                                            
                                        </tr>
                                    </tfoot>
                                    <?php if(!empty($orders)): ?>
                                       
                                       <?php foreach($orders as $order) : ?>
                                        <tr>
                                            <td><?=$order['id']?></td>
                                            <td><?php 
                                            if($order['status'] == '1') {
                                                echo '<div class="badge bg-primary text-white rounded-pill">Завершён</div>';
                                             } else {
                                                echo '<div class="badge bg-success text-white rounded-pill">Новый</div>';
                                             }?></td>
                                            <td><?=$order['created_at']?></td>
                                            <td><?=$order['updated_at']?></td>
                                           
                                            <td>
                                                <a class="btn btn-info btn-sm" href="<?=ADMIN?>/order/edit?id=<?=$order['id']?>"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                            <!-- <td>
                                                <a class="btn btn-danger btn-sm delete" href="<?=ADMIN?>/order/delete?id=<?=$order['id']?>"><i class="far fa-trash-alt"></i></a>
                                            </td> -->
                                        </tr> 
                                        <?php endforeach; ?>
                                    </tbody>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>



                        
                       