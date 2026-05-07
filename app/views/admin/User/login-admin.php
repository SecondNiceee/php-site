                  <main>
                     <div class="container-xl px-4">
                        <div class="row justify-content-center">
                        
                            <div class="col-lg-5">
                                <!-- Basic login form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="fw-light my-4">Авторизоваться</h3>
                                    <?php if (!empty($_SESSION['errors'])):?>
                                       <div class="alert alert-danger alert-icon" role="alert">
                                          <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                          <div class="alert-icon-aside">
                                             <i class="far fa-warning"></i>
                                          </div>
                                          <div class="alert-icon-content">
                                             <h6 class="alert-heading">Ошибка!</h6>
                                             <?php echo $_SESSION['errors']; unset($_SESSION['errors']);?>
                                          </div>
                                          
                                       </div>
                                    <?php endif; ?>
                                 </div>
                                    <div class="card-body">
                                        <!-- Login form-->
                                        <form method="post">
                                            <!-- Form Group (Email)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputEmail">E-mail</label>
                                                <input class="form-control" name="email" id="inputEmail" type="email" placeholder="Введите E-mailss " required />
                                            </div>
                                            <!-- Form Group (password)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputPassword">Пароль</label>
                                                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Введите пароль" required />
                                            </div>
                                            <!-- Form Group (remember password checkbox)-->
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="rememberPasswordCheck" type="checkbox" value="" />
                                                    <label class="form-check-label" for="rememberPasswordCheck">Запомнить пароль</label>
                                                </div>
                                            </div>
                                            <!-- Form Group (login box)-->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="auth-password-basic.html">Забыли пароль?</a>
                                                <button type="submit" class="btn btn-primary">Войти</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                  </main>