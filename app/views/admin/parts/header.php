<?php
      use shop\View;
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <?=$this->getMeta();?>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <!-- <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" /> -->
        <link href="/sbadmin/css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="/sbadmin/assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
        <script src="/sbadmin/ckfinder/ckfinder.js"></script>
        <script src="/sbadmin/ckeditor/build/ckeditor.js"></script>

       
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <!-- Sidenav Toggle Button-->
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
            <!-- Navbar Brand-->
            <!-- * * Tip * * You can use text or an image for your navbar brand.-->
            <!-- * * * * * * When using an image, we recommend the SVG format.-->
            <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
            <a class="navbar-brand pe-3 ps-4 ps-lg-2 d-flex align-items-center" href="/" target="_blank"> <span>ПОТОК &nbsp;&nbsp;</span> <span class="badge bg-primary fw-600 rounded-pill"> Admin</span></a>
           
            <!-- Navbar Items-->
            <ul class="navbar-nav align-items-center ms-auto">
                <!-- Documentation Dropdown-->
                <!-- Alerts Dropdown-->
                <!-- User Dropdown-->
                <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?= PATH ?>/sbadmin/assets/img/illustrations/profiles/profile-2.png" /></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="/sbadmin/assets/img/illustrations/profiles/profile-2.png" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?=h($_SESSION['user']['name']);?></div>
                                <div class="dropdown-user-details-email"><?=h($_SESSION['user']['email']);?></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <!--<a class="dropdown-item" href="<?=ADMIN?>/user/edit?id=<?=$_SESSION['user']['id']?>">-->
                        <!--    <div class="dropdown-item-icon"><i data-feather="settings"></i></div>-->
                        <!--    Аккаунт-->
                        <!--</a>-->
                        <a class="dropdown-item" href="<?=ADMIN?>/user/logout">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Выйти
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                                                  
                            <div class="sidenav-menu-heading">Основные</div>
                            <!-- Sidenav Link (Charts)-->
                            <a class="nav-link" href="<?=ADMIN?>">
                                <div class="nav-link-icon"><i data-feather="grid"></i></div>
                                Главная
                            </a>
                            <a class="nav-link" href="<?=ADMIN?>/category">
                                <div class="nav-link-icon"><i data-feather="list"></i></div>
                                Категории
                            </a>
                            <a class="nav-link" href="<?=ADMIN?>/brand">
                                <div class="nav-link-icon"><i data-feather="globe"></i></div>
                                Бренды
                            </a>
                            <a class="nav-link" href="<?=ADMIN?>/product">
                                <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                                Товары
                            </a>
                            <a class="nav-link" href="<?=ADMIN?>/order">
                                <div class="nav-link-icon"><i data-feather="shopping-bag"></i></div>
                                Заказы
                            </a>
                            <!-- <a class="nav-link" href="<?=ADMIN?>/cache">
                                <div class="nav-link-icon"><i data-feather="database"></i></div>
                                Управление кэшем
                            </a> -->
                            <!-- Sidenav Link (Tables)-->
                            <div class="sidenav-menu-heading">Страницы</div>
                            <a class="nav-link" href="<?=ADMIN?>/page">
                                <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                                Управление страницами
                            </a>
                            <a class="nav-link" href="<?=ADMIN?>/reviews">
                                <div class="nav-link-icon"><i data-feather="message-square"></i></div>
                                Отзывы
                            </a>
                            
                        </div>
                    </div>
                    <!-- Sidenav Footer-->
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle">Вы вошли как:</div>
                            <div class="sidenav-footer-title"><?=h($_SESSION['user']['name']);?></div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
               <?php if (!empty($_SESSION['success'])):?>
                    <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-aside">
                    <i class="fa fa-check"></i>
                    </div>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Успех!</h6>
                        <?php echo $_SESSION['success']; unset($_SESSION['success']);?>
                    </div>
                    
                    </div>
                <?php endif; ?>
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