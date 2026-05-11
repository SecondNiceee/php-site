<div class="page-header">
    <h1>Вопросы и ответы</h1>
    <a href="<?= ADMIN ?>/faq/add" class="btn btn-primary">
        <i class="fa fa-plus"></i> Добавить вопрос
    </a>
</div>

<!-- Фильтры -->
<div class="filters mb-3 p-3 bg-light rounded">
    <form method="get" action="" class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Тип страницы</label>
            <select name="type" class="form-select">
                <option value="">Все типы</option>
                <option value="main" <?= $type == 'main' ? 'selected' : '' ?>>Главная страница</option>
                <option value="subcatalog" <?= $type == 'subcatalog' ? 'selected' : '' ?>>Категория (/subcatalog/)</option>
                <option value="category" <?= $type == 'category' ? 'selected' : '' ?>>Подкатегория (/category/)</option>
                <option value="product" <?= $type == 'product' ? 'selected' : '' ?>>Товары</option>
                <option value="brand" <?= $type == 'brand' ? 'selected' : '' ?>>Бренды</option>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-secondary me-2">Фильтр</button>
            <a href="<?= ADMIN ?>/faq" class="btn btn-outline-secondary">Сбросить</a>
        </div>
    </form>
</div>

<!-- Таблица -->
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Вопрос</th>
                <th>Ответ</th>
                <th>Страница</th>
                <th style="width: 80px;">Порядок</th>
                <th style="width: 80px;">Статус</th>
                <th style="width: 150px;">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($faqs)): ?>
                <tr>
                    <td colspan="7" class="text-center py-4">Вопросов пока нет</td>
                </tr>
            <?php else: ?>
                <?php foreach ($faqs as $faq): ?>
                    <?php 
                        // Формируем URL страницы
                        $pageUrl = '/';
                        $pageTypeLabel = 'Главная';
                        
                        switch ($faq['entity_type']) {
                            case 'main':
                                $pageUrl = '/';
                                $pageTypeLabel = 'Главная';
                                break;
                            case 'subcatalog':
                                $pageUrl = '/subcatalog/...';
                                $pageTypeLabel = 'Категория';
                                break;
                            case 'category':
                                $pageUrl = '/category/...';
                                $pageTypeLabel = 'Подкатегория';
                                break;
                            case 'product':
                                $pageUrl = '/product/...';
                                $pageTypeLabel = 'Товар';
                                break;
                            case 'brand':
                                $pageUrl = '/brand/...';
                                $pageTypeLabel = 'Бренд';
                                break;
                        }
                    ?>
                    <tr>
                        <td><?= $faq['id'] ?></td>
                        <td>
                            <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?= strip_tags($faq['question']) ?>
                            </div>
                        </td>
                        <td>
                            <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?= strip_tags($faq['answer']) ?>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info"><?= $pageTypeLabel ?></span>
                            <br>
                            <small class="text-muted"><?= htmlspecialchars($faq['entity_title']) ?></small>
                        </td>
                        <td><?= $faq['sort_order'] ?></td>
                        <td>
                            <?php if ($faq['status']): ?>
                                <span class="badge bg-success">Активен</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Скрыт</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= ADMIN ?>/faq/edit?id=<?= $faq['id'] ?>" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="<?= ADMIN ?>/faq/delete?id=<?= $faq['id'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Удалить этот вопрос?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .page-header h1 {
        margin: 0;
        font-size: 24px;
        color: #082a43;
    }
    .btn-primary {
        background-color: #2f72cf;
        border-color: #2f72cf;
    }
    .btn-primary:hover {
        background-color: #1e5bb0;
        border-color: #1e5bb0;
    }
</style>
