 
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content pb-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="database"></i></div>
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
                              <div class="card-body p-0">
                                <!-- Billing history table-->
                                 <div class="table-responsive table-billing-history">
                                 <table class="table table-bordered">
                                    <thead>
                                       <tr>
                                          <th>Наименование</th>
                                          <th>Описание</th>
                                          <td width="50"><i class="far fa-trash-alt"></i></td>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       <tr>
                                          <td>
                                             Кэш категорий
                                          </td>
                                          <td>
                                             Меню категорий на сайте. Кэшируется на 1 час.
                                          </td>
                                          <td width="50">
                                             <a class="btn btn-danger btn-sm delete"
                                                href="<?= ADMIN ?>/cache/delete?cache=category">
                                                   <i class="far fa-trash-alt"></i>
                                             </a>
                                          </td>
                                       </tr>
                                       </tbody>
                                 </table>
                                 </div>
                              </div>
                           </div>

