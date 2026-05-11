<div class="page-header">
    <h1>Редактировать вопрос</h1>
    <a href="<?= ADMIN ?>/faq" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Назад к списку
    </a>
</div>

<form method="post" class="needs-validation" novalidate>
    <div class="row">
        <!-- Левая колонка -->
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Основная информация</h5>
                </div>
                <div class="card-body">
                    <!-- Вопрос -->
                    <div class="mb-3">
                        <label for="question" class="form-label required">Вопрос *</label>
                        <textarea name="question" id="question" class="form-control" rows="3" required><?= htmlspecialchars($faq['question'] ?? '') ?></textarea>
                        <div class="invalid-feedback">Введите вопрос</div>
                    </div>

                    <!-- Ответ -->
                    <div class="mb-3">
                        <label for="answer" class="form-label required">Ответ *</label>
                        <textarea name="answer" id="answer" class="form-control ckeditor" rows="6" required><?= htmlspecialchars($faq['answer'] ?? '') ?></textarea>
                        <div class="invalid-feedback">Введите ответ</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Правая колонка -->
        <div class="col-md-4">
            <!-- Привязка к странице -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0">На какую страницу добавить?</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="page_type" class="form-label required">Тип страницы *</label>
                        <select name="page_type" id="page_type" class="form-select" required onchange="updatePageSelect()">
                            <option value="">Выберите тип страницы</option>
                            <option value="main" <?= ($faq['entity_type'] ?? '') == 'main' ? 'selected' : '' ?>>Главная страница</option>
                            <option value="subcatalog" <?= ($faq['entity_type'] ?? '') == 'subcatalog' ? 'selected' : '' ?>>Категория (родительская)</option>
                            <option value="category" <?= ($faq['entity_type'] ?? '') == 'category' ? 'selected' : '' ?>>Подкатегория</option>
                            <option value="product" <?= ($faq['entity_type'] ?? '') == 'product' ? 'selected' : '' ?>>Товар</option>
                            <option value="brand" <?= ($faq['entity_type'] ?? '') == 'brand' ? 'selected' : '' ?>>Бренд</option>
                        </select>
                        <small class="text-muted mt-1 d-block">
                            <strong>Категория</strong> = /subcatalog/... <br>
                            <strong>Подкатегория</strong> = /category/...
                        </small>
                    </div>

                    <!-- Выбор конкретной страницы -->
                    <div class="mb-3" id="page_select_container" style="display: none;">
                        <label for="page_select" class="form-label">Выберите страницу *</label>
                        <select name="page_select" id="page_select" class="form-select" onchange="updatePreview()">
                            <option value="">Загрузка...</option>
                        </select>
                    </div>

                    <!-- Превью ссылки -->
                    <div id="preview_container" style="display: none;">
                        <label class="form-label">Страница:</label>
                        <div class="alert alert-success mb-0" style="padding: 10px 15px;">
                            <i class="fa fa-link me-2"></i>
                            <code id="preview_url" style="background: none; color: inherit;"></code>
                        </div>
                    </div>

                    <!-- Скрытые поля для отправки -->
                    <input type="hidden" name="entity_type" id="entity_type" value="<?= $faq['entity_type'] ?? '' ?>">
                    <input type="hidden" name="entity_id" id="entity_id" value="<?= $faq['entity_id'] ?? 0 ?>">
                    <input type="hidden" name="id" value="<?= $faq['id'] ?>">
                </div>
            </div>

            <!-- Настройки -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Настройки</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Порядок сортировки</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" value="<?= $faq['sort_order'] ?? 0 ?>" min="0">
                        <small class="text-muted">Меньшее число = выше в списке</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" <?= ($faq['status'] ?? 1) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="status">Активен</label>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fa fa-save"></i> Сохранить
            </button>
        </div>
    </div>
</form>

<script>
// Данные страниц
const pagesData = {
    // Категории (родительские) - /subcatalog/slug
    subcatalog: <?= json_encode(array_values(array_filter(
        array_map(fn($c) => ['id' => $c['id'], 'title' => $c['title'], 'slug' => $c['slug'], 'parent_id' => $c['parent_id']], $categories ?? []),
        fn($c) => $c['parent_id'] == 0
    ))) ?>,
    // Подкатегории - /category/slug  
    category: <?= json_encode(array_values(array_filter(
        array_map(fn($c) => ['id' => $c['id'], 'title' => $c['title'], 'slug' => $c['slug'], 'parent_id' => $c['parent_id']], $categories ?? []),
        fn($c) => $c['parent_id'] != 0
    ))) ?>,
    product: <?= json_encode(array_map(fn($p) => ['id' => $p['id'], 'title' => $p['title'], 'slug' => $p['slug']], $products ?? [])) ?>,
    brand: <?= json_encode(array_map(fn($b) => ['id' => $b['id'], 'title' => $b['title'], 'slug' => $b['slug']], $brands ?? [])) ?>
};

// Текущие значения (для редактирования)
const currentEntityType = "<?= $faq['entity_type'] ?? '' ?>";
const currentEntityId = <?= (int)($faq['entity_id'] ?? 0) ?>;

// URL паттерны
const urlPatterns = {
    main: '/',
    subcatalog: '/subcatalog/',
    category: '/category/',
    product: '/product/',
    brand: '/brand/'
};

function updatePageSelect() {
    const pageType = document.getElementById('page_type').value;
    const selectContainer = document.getElementById('page_select_container');
    const select = document.getElementById('page_select');
    const previewContainer = document.getElementById('preview_container');
    const entityType = document.getElementById('entity_type');
    const entityId = document.getElementById('entity_id');
    
    entityType.value = pageType;
    
    if (pageType === 'main') {
        selectContainer.style.display = 'none';
        previewContainer.style.display = 'block';
        document.getElementById('preview_url').textContent = '/';
        entityId.value = 0;
        return;
    }
    
    if (!pageType || !pagesData[pageType]) {
        selectContainer.style.display = 'none';
        previewContainer.style.display = 'none';
        entityId.value = 0;
        return;
    }
    
    // Заполняем селект
    select.innerHTML = '<option value="">Выберите страницу</option>';
    
    pagesData[pageType].forEach(item => {
        const option = document.createElement('option');
        option.value = item.id + '|' + item.slug;
        option.textContent = item.title;
        
        // Выбираем текущее значение при редактировании
        if (currentEntityType === pageType && currentEntityId == item.id) {
            option.selected = true;
        }
        
        select.appendChild(option);
    });
    
    selectContainer.style.display = 'block';
    updatePreview();
}

function updatePreview() {
    const pageType = document.getElementById('page_type').value;
    const select = document.getElementById('page_select');
    const previewContainer = document.getElementById('preview_container');
    const previewUrl = document.getElementById('preview_url');
    const entityId = document.getElementById('entity_id');
    
    if (pageType === 'main') {
        previewContainer.style.display = 'block';
        previewUrl.textContent = '/';
        entityId.value = 0;
        return;
    }
    
    if (!select.value) {
        previewContainer.style.display = 'none';
        entityId.value = 0;
        return;
    }
    
    const [id, slug] = select.value.split('|');
    entityId.value = id;
    
    const url = urlPatterns[pageType] + slug;
    previewUrl.textContent = url;
    previewContainer.style.display = 'block';
}

// Инициализация
document.addEventListener('DOMContentLoaded', function() {
    updatePageSelect();
    
    // CKEditor
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('answer', {
            height: 300,
            toolbarGroups: [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
                { name: 'links' },
                { name: 'insert' },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },
                { name: 'styles' },
            ]
        });
    }
});
</script>

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
    .required::after {
        content: " *";
        color: red;
    }
    .btn-primary {
        background-color: #2f72cf;
        border-color: #2f72cf;
    }
    .btn-primary:hover {
        background-color: #1e5bb0;
        border-color: #1e5bb0;
    }
    .card {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
    }
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }
</style>
