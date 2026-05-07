<?php $this->layout('admin'); ?>

<div class="page-header">
    <h1><?= isset($faq) && !empty($faq['id']) ? 'Редактировать вопрос' : 'Добавить вопрос' ?></h1>
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
            <!-- Привязка к сущности -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Привязка к странице</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="entity_type" class="form-label required">Тип сущности *</label>
                        <select name="entity_type" id="entity_type" class="form-select" required onchange="updateEntitySelect()">
                            <option value="">Выберите тип</option>
                            <option value="main" <?= ($faq['entity_type'] ?? '') == 'main' ? 'selected' : '' ?>>Главная страница</option>
                            <option value="product" <?= ($faq['entity_type'] ?? '') == 'product' ? 'selected' : '' ?>>Товар</option>
                            <option value="category" <?= ($faq['entity_type'] ?? '') == 'category' ? 'selected' : '' ?>>Категория</option>
                            <option value="brand" <?= ($faq['entity_type'] ?? '') == 'brand' ? 'selected' : '' ?>>Бренд</option>
                        </select>
                    </div>

                    <div class="mb-3" id="entity_id_container" style="display: none;">
                        <label for="entity_id" class="form-label required">Сущность *</label>
                        <select name="entity_id" id="entity_id" class="form-select">
                            <option value="0">Не выбрано</option>
                        </select>
                    </div>

                    <?php if (isset($faq)): ?>
                        <input type="hidden" name="id" value="<?= $faq['id'] ?>">
                    <?php endif; ?>
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

<!-- Данные для JS -->
<script>
    const entitiesData = {
        product: <?= json_encode(array_map(fn($p) => ['id' => $p['id'], 'title' => $p['title']], $products ?? [])) ?>,
        category: <?= json_encode(array_map(fn($c) => ['id' => $c['id'], 'title' => $c['title']], $categories ?? [])) ?>,
        brand: <?= json_encode(array_map(fn($b) => ['id' => $b['id'], 'title' => $b['title']], $brands ?? [])) ?>
    };
    
    const currentType = "<?= $faq['entity_type'] ?? '' ?>";
    const currentId = "<?= $faq['entity_id'] ?? 0 ?>";
</script>

<script>
function updateEntitySelect() {
    const type = document.getElementById('entity_type').value;
    const container = document.getElementById('entity_id_container');
    const select = document.getElementById('entity_id');
    
    if (type === 'main') {
        container.style.display = 'none';
        select.value = '0';
        return;
    }
    
    if (!type || !entitiesData[type]) {
        container.style.display = 'none';
        return;
    }
    
    container.style.display = 'block';
    select.innerHTML = '<option value="0">Выберите сущность</option>';
    
    entitiesData[type].forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = item.title;
        if (item.id == currentId && type === currentType) {
            option.selected = true;
        }
        select.appendChild(option);
    });
}

// Инициализация при загрузке
document.addEventListener('DOMContentLoaded', function() {
    updateEntitySelect();
    
    // Инициализация CKEditor если есть
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('answer', {
            height: 300,
            toolbarGroups: [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
                { name: 'links' },
                { name: 'insert' },
                { name: 'forms' },
                { name: 'tools' },
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                { name: 'styles' },
                { name: 'colors' },
                { name: 'about' }
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
</style>
