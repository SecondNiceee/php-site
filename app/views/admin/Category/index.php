                  <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content pb-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="list"></i></div>
                                            <?=$title ?? 'Панель управления';?>
                                        </h1>
                                        
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                       <a href="<?=ADMIN?>/category/add" class="btn btn-sm btn-light text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            Добавить категорию
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
                            <div class="table-responsive">
                            <?php
                                 new \app\widgets\menu\Menu([
                                    'cache' => 0,
                                    'cacheKey' => 'admin_menu',
                                    'class' => 'table table-bordered',
                                    'tpl' => APP . '/widgets/menu/admin_table_tpl.php',
                                    'container' => 'table',
                                 ])
                                    ?>
                            </div>
                        </div>