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
                                        <a class="btn btn-sm btn-light text-primary" href="<?=ADMIN?>/reviews">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left me-1"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                            Вернутся к отзывам
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
                                 <label for="exampleFormControlTextarea1">Ответить на отзыв</label>
                                 <textarea class="form-control" name="answer" id="exampleFormControlTextarea1" rows="5"><?=$review['answer']?></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary">Сохранить</button>
                           </form>
                           
                        </div>



