<?php

namespace app\widgets;

use app\models\admin\Faq;

class FaqWidget
{
    /**
     * Отобразить блок вопросов-ответов для сущности
     * @param string $type Тип сущности: product, category, brand, main
     * @param int $id ID сущности (0 для главной)
     */
    public static function render($type, $id = 0)
    {
        $model = new Faq();
        $faqs = $model->getFaqByEntity($type, $id);
        
        if (empty($faqs)) {
            return '';
        }
        
        ob_start();
        $faq_id = 'faq_' . $type . '_' . $id . '_' . time();
        ?>
        <div class="faq-section mt-5">
            <div class="container">
                <h2 class="faq-title">Ответьте на вопросы</h2>
                <form id="<?= $faq_id ?>" class="faq-form">
                    <div class="faq-accordion">
                        <?php foreach ($faqs as $index => $faq): ?>
                            <div class="faq-item" data-faq-id="<?= $faq['id'] ?>">
                                <label class="faq-question-label">
                                    <input type="checkbox" class="faq-checkbox" value="<?= $faq['id'] ?>">
                                    <span class="faq-question-text"><?= htmlspecialchars($faq['question']) ?></span>
                                    <span class="faq-icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                </label>
                                <div class="faq-answer">
                                    <div class="faq-answer-content">
                                        <?= $faq['answer'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="faq-submit-section">
                        <button type="submit" class="faq-submit-btn">Завершить тест</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Модальное окно для вывода ошибок -->
        <div id="faq-modal-<?= $faq_id ?>" class="faq-modal" style="display: none;">
            <div class="faq-modal-overlay"></div>
            <div class="faq-modal-content">
                <div class="faq-modal-header">
                    <h3>Внимание</h3>
                    <button type="button" class="faq-modal-close" onclick="closeFaqModal('faq-modal-<?= $faq_id ?>')">×</button>
                </div>
                <div class="faq-modal-body">
                    <p>Вы ответили не на все вопросы. Пожалуйста, отметьте все вопросы перед завершением теста:</p>
                    <ul id="faq-errors-<?= $faq_id ?>" class="faq-errors-list"></ul>
                </div>
                <div class="faq-modal-footer">
                    <button type="button" class="faq-modal-btn" onclick="closeFaqModal('faq-modal-<?= $faq_id ?>')">Понял, исправлю</button>
                </div>
            </div>
        </div>

        <style>
            .faq-section {
                padding: 40px 0;
                background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
            }
            
            .faq-title {
                font-size: 28px;
                font-weight: 700;
                color: #065f46;
                margin-bottom: 30px;
                text-align: center;
            }
            
            .faq-accordion {
                max-width: 900px;
                margin: 0 auto;
            }
            
            .faq-item {
                background: #ffffff;
                border-radius: 10px;
                margin-bottom: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                overflow: hidden;
                transition: all 0.3s ease;
                border-left: 4px solid #e5e7eb;
            }
            
            .faq-item.answered {
                border-left-color: #16a34a;
                background-color: #f0fdf4;
            }
            
            .faq-item.unanswered {
                border-left-color: #dc2626;
                background-color: #fef2f2;
            }
            
            .faq-item:hover {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            }
            
            .faq-question-label {
                width: 100%;
                display: flex;
                justify-content: flex-start;
                align-items: center;
                gap: 16px;
                padding: 20px 24px;
                background: none;
                border: none;
                cursor: pointer;
                text-align: left;
                font-size: 16px;
                font-weight: 600;
                color: #065f46;
                font-family: 'Ubuntu', sans-serif;
                transition: all 0.3s ease;
            }
            
            .faq-question-label:hover {
                background-color: #f0fdf4;
            }
            
            .faq-checkbox {
                width: 24px;
                height: 24px;
                min-width: 24px;
                cursor: pointer;
                accent-color: #16a34a;
                border: 2px solid #d1d5db;
                border-radius: 6px;
            }
            
            .faq-checkbox:checked {
                background-color: #16a34a;
                border-color: #16a34a;
            }
            
            .faq-question-text {
                flex: 1;
                padding-right: 20px;
            }
            
            .faq-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background-color: #dcfce7;
                color: #16a34a;
                transition: all 0.3s ease;
                flex-shrink: 0;
            }
            
            .faq-item.active .faq-icon {
                background-color: #16a34a;
                color: #ffffff;
                transform: rotate(45deg);
            }
            
            .faq-answer {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }
            
            .faq-item.active .faq-answer {
                max-height: 1000px;
            }
            
            .faq-answer-content {
                padding: 0 24px 24px 24px;
                padding-left: 56px;
                color: #374151;
                line-height: 1.6;
                font-size: 15px;
            }
            
            .faq-answer-content p {
                margin-bottom: 12px;
            }
            
            .faq-answer-content p:last-child {
                margin-bottom: 0;
            }
            
            .faq-answer-content ul,
            .faq-answer-content ol {
                margin: 12px 0;
                padding-left: 24px;
            }
            
            .faq-answer-content li {
                margin-bottom: 8px;
            }
            
            .faq-answer-content a {
                color: #16a34a;
                text-decoration: underline;
            }
            
            .faq-answer-content a:hover {
                color: #15803d;
            }
            
            .faq-submit-section {
                max-width: 900px;
                margin: 30px auto 0;
                text-align: center;
            }
            
            .faq-submit-btn {
                background-color: #16a34a;
                color: white;
                border: none;
                padding: 14px 48px;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 2px 8px rgba(22, 163, 74, 0.3);
            }
            
            .faq-submit-btn:hover {
                background-color: #15803d;
                box-shadow: 0 4px 12px rgba(22, 163, 74, 0.4);
            }
            
            /* Модальное окно */
            .faq-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 10000;
            }
            
            .faq-modal-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(2px);
            }
            
            .faq-modal-content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: white;
                border-radius: 12px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                max-width: 500px;
                width: 90%;
                overflow: hidden;
            }
            
            .faq-modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 24px;
                background-color: #fef2f2;
                border-bottom: 2px solid #fecaca;
            }
            
            .faq-modal-header h3 {
                margin: 0;
                color: #dc2626;
                font-size: 20px;
            }
            
            .faq-modal-close {
                background: none;
                border: none;
                font-size: 28px;
                cursor: pointer;
                color: #dc2626;
                padding: 0;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .faq-modal-close:hover {
                background-color: #fee2e2;
                border-radius: 6px;
            }
            
            .faq-modal-body {
                padding: 24px;
                color: #374151;
                line-height: 1.6;
            }
            
            .faq-modal-body p {
                margin: 0 0 16px 0;
                font-size: 15px;
            }
            
            .faq-errors-list {
                margin: 0;
                padding-left: 24px;
                list-style: none;
            }
            
            .faq-errors-list li {
                color: #dc2626;
                margin-bottom: 8px;
                font-size: 14px;
                padding-left: 24px;
                position: relative;
            }
            
            .faq-errors-list li:before {
                content: "●";
                position: absolute;
                left: 0;
                color: #dc2626;
            }
            
            .faq-modal-footer {
                padding: 16px 24px;
                background-color: #f9fafb;
                text-align: right;
                border-top: 1px solid #e5e7eb;
            }
            
            .faq-modal-btn {
                background-color: #065f46;
                color: white;
                border: none;
                padding: 10px 24px;
                border-radius: 6px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            
            .faq-modal-btn:hover {
                background-color: #047857;
            }
            
            /* Адаптивность */
            @media (max-width: 991.98px) {
                .faq-section {
                    padding: 30px 0;
                }
                
                .faq-title {
                    font-size: 24px;
                }
                
                .faq-question-label {
                    padding: 16px 20px;
                    font-size: 15px;
                }
                
                .faq-answer-content {
                    padding: 0 20px 20px 20px;
                    padding-left: 56px;
                    font-size: 14px;
                }
            }
            
            @media (max-width: 767.98px) {
                .faq-section {
                    padding: 24px 0;
                }
                
                .faq-title {
                    font-size: 22px;
                    margin-bottom: 24px;
                }
                
                .faq-item {
                    margin-bottom: 10px;
                }
                
                .faq-question-label {
                    padding: 14px 16px;
                    font-size: 14px;
                    gap: 12px;
                }
                
                .faq-checkbox {
                    width: 20px;
                    height: 20px;
                }
                
                .faq-icon {
                    width: 28px;
                    height: 28px;
                }
                
                .faq-answer-content {
                    padding: 0 16px 16px 16px;
                    padding-left: 48px;
                    font-size: 13px;
                }
            }
            
            @media (max-width: 479.98px) {
                .faq-section {
                    padding: 20px 0;
                }
                
                .faq-title {
                    font-size: 20px;
                }
                
                .faq-question-label {
                    padding: 12px 14px;
                    font-size: 13px;
                }
                
                .faq-question-text {
                    padding-right: 8px;
                }
                
                .faq-answer-content {
                    padding: 0 14px 14px 14px;
                    padding-left: 40px;
                }
                
                .faq-modal-content {
                    width: 95%;
                }
            }
        </style>

        <script>
            (function() {
                const formId = '<?= $faq_id ?>';
                const form = document.getElementById(formId);
                const modalId = 'faq-modal-<?= $faq_id ?>';
                
                if (!form) return;
                
                const checkboxes = form.querySelectorAll('.faq-checkbox');
                
                // Обновление стиля при изменении чекбокса
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const item = this.closest('.faq-item');
                        if (this.checked) {
                            item.classList.add('answered');
                            item.classList.remove('unanswered');
                        } else {
                            item.classList.remove('answered');
                            item.classList.remove('unanswered');
                        }
                    });
                    
                    // Открытие/закрытие аккордеона при клике на вопрос
                    const label = checkbox.closest('.faq-question-label');
                    label.addEventListener('click', function(e) {
                        if (e.target !== checkbox) {
                            e.preventDefault();
                            const item = this.closest('.faq-item');
                            item.classList.toggle('active');
                        }
                    });
                });
                
                // Обработка отправки формы
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const unchecked = [];
                    checkboxes.forEach(checkbox => {
                        const item = checkbox.closest('.faq-item');
                        if (!checkbox.checked) {
                            unchecked.push(checkbox);
                            item.classList.add('unanswered');
                        }
                    });
                    
                    if (unchecked.length > 0) {
                        // Показываем модальное окно с ошибками
                        const errorsList = document.getElementById('faq-errors-<?= $faq_id ?>');
                        errorsList.innerHTML = '';
                        
                        unchecked.forEach(checkbox => {
                            const item = checkbox.closest('.faq-item');
                            const questionText = item.querySelector('.faq-question-text').textContent;
                            const li = document.createElement('li');
                            li.textContent = questionText;
                            errorsList.appendChild(li);
                        });
                        
                        document.getElementById(modalId).style.display = 'block';
                    } else {
                        // Все вопросы отвечены - переходим на страницу поздравления
                        window.location.href = '/congratulation';
                    }
                });
            })();
            
            function closeFaqModal(modalId) {
                document.getElementById(modalId).style.display = 'none';
            }
        </script>
        <?php
        return ob_get_clean();
    }
}
