               
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
                                    <div class="col-12 col-xl-auto mt-4">
                                       <a href="<?=ADMIN?>/order" class="btn btn-sm btn-light text-primary">
                                          <div class="page-header-icon" style="margin-right:5px;"><i data-feather="arrow-left"></i></div>
                                             Вернутся к заказам
                                       </a>
                                       <!-- <a href="<?=ADMIN?>/product/add" class="btn btn-sm btn-danger text-white">
                                          <div class="page-header-icon" style="margin-right:5px;"><i data-feather="trash"></i></div>
                                             Удалить заказ
                                       </a> -->
                                    </div>
                                    
                                </div> 
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4">
                        <!-- Example Colored Cards for Dashboard Demo-->
                        <div class="card mb-4">
                           <div class="card-header">Список заказа</div>
                              <div class="card-body p-0">
                                <!-- Billing history table-->
                                 <div class="table-responsive table-billing-history">
                                    <table class="table mb-0">
                                       <thead>
                                          <tr>
                                             <th>Наименование</th>
                                             <th>Количество</th>
                                          </tr>
                                       </thead>
                                                                           
                                          <?php foreach($order as $item) : ?>
                                          <tr>
                                             <td><?=$item['title']?></td>
                                             <td><?=$item['qty']?></td>                                          
                                          </tr> 
                                          <?php endforeach; ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="box">
                              <h3 class="box-title">Детали заказа</h3>
                              <div class="box-content">
                                 <div class="table-responsive">
                                    <table class="table text-start table-striped">
                                          <tr>
                                             <td>Номера заказа</td>
                                             <td>№<?= $order[0]['order_id'] ?></td>
                                          </tr>
                                          <tr>
                                             <td>Статус</td>
                                             <td><?php if($order[0]['status'] == '1') {
                                                      echo '<div class="badge bg-primary text-white rounded-pill">Завершён</div>';
                                                   } else {
                                                      echo '<div class="badge bg-success text-white rounded-pill">Новый</div>';
                                                   } ?>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Создан</td>
                                             <td><?= $order[0]['created_at'] ?></td>
                                          </tr>
                                          <tr>
                                             <td>Обновлен</td>
                                             <td><?= $order[0]['updated_at'] ?></td>
                                          </tr>
                                          <tr>
                                             <td>Имя заказчика</td>
                                             <td><?= $order[0]['fio']?></td>
                                          </tr>
                                          <tr>
                                             <td>Телефон</td>
                                             <td><?= $order[0]['phone']?></td>
                                          </tr>
                                          <?php if($order[0]['email']) :?>
                                          <tr>
                                             <td>E-mail</td>
                                             <td><?= $order[0]['email']?></td>
                                          </tr>
                                          <?php endif; ?>
                                          <?php if($order[0]['company']) :?>
                                          <tr>
                                             <td>Организация</td>
                                             <td><?= $order[0]['company']?></td>
                                          </tr>
                                          <?php endif; ?>
                                          <?php if($order[0]['note']) :?>
                                          <tr>
                                             <td>Примечание к заказу</td>
                                             <td><?= $order[0]['note'] ?></td>
                                          </tr>
                                          <?php endif; ?>
                                    </table>
                                 </div>
                              </div>

                        </div>

                        <?php if (!$order[0]['status']): ?>
                              <a href="<?= ADMIN ?>/order/edit?id=<?= $order[0]['order_id'] ?>&status=1" class="btn btn-success btn-flat">Изменить статус на Завершен</a>
                        <?php else: ?>
                              <a href="<?= ADMIN ?>/order/edit?id=<?= $order[0]['order_id'] ?>&status=0" class="btn btn-danger btn-flat">Изменить статус на Новый</a>
                        <?php endif; ?>
                        



                        
                       