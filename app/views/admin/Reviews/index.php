               
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content pb-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="message-square"></i></div>
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
                                            <th>id отзыва</th>
                                            <th>Компания</th>
                                            <th>Имя</th>
                                            <th>Должность</th>
                                            <th>Отзыв</th>
                                            <th>Дата</th>
                                            <th>Ответ</th>
                                            <th><i data-feather="edit"></th>
                                            <th><i data-feather="trash-2"></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>id отзыва</th>
                                            <th>Компания</th>
                                            <th>Имя</th>
                                            <th>Должность</th>
                                            <th>Отзыв</th>
                                            <th>Дата</th>
                                            <th>Ответ</th>
                                            <th><i data-feather="edit"></th>
                                            <th><i data-feather="trash-2"></th>
                                        </tr>
                                    </tfoot>
                                    <?php if(!empty($reviews)): ?>
                                       
                                       <?php foreach($reviews as $review) : ?>
                                        <tr>
                                            <td><?=$review['id']?></td>
                                            <td><?=$review['title']?></td>
                                            <td><?=$review['name']?></td>
                                            <td><?=$review['job']?></td>
                                            <td><?=$review['text']?></td>
                                            <td><?=$review['date']?></td>
                                            <td><?=$review['answer']?></td>
                                           
                                            <td>
                                                <a class="btn btn-info btn-sm" href="<?=ADMIN?>/reviews/edit?id=<?=$review['id']?>"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-sm delete" href="<?=ADMIN?>/reviews/delete?id=<?=$review['id']?>"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr> 
                                        <?php endforeach; ?>
                                    </tbody>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>



                        
                       