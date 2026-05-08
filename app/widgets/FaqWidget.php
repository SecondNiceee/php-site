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
        ?>
        <div class="faq-section mt-5">
            <div class="container">
                <h2 class="faq-title">Вопросы и ответы</h2>
                <div class="faq-accordion">
                    <?php foreach ($faqs as $index => $faq): ?>
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)">
                                <span class="faq-question-text"><?= htmlspecialchars($faq['question']) ?></span>
                                <span class="faq-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    <?= $faq['answer'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <style>
            .faq-section {
                padding: 40px 0;
                background-color: #f9fafb;
            }
            
            .faq-title {
                font-size: 28px;
                font-weight: 700;
                color: #082a43;
                margin-bottom: 30px;
                text-align: center;
            }
            
            .faq-accordion {
                max-width: 900px;
                margin: 0 auto;
            }
            
            .faq-item {
                background: #ffffff;
                border-radius: 8px;
                margin-bottom: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                overflow: hidden;
                transition: all 0.3s ease;
            }
            
            .faq-item:hover {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            }
            
            .faq-question {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 24px;
                background: none;
                border: none;
                cursor: pointer;
                text-align: left;
                font-size: 16px;
                font-weight: 600;
                color: #082a43;
                font-family: 'Ubuntu', sans-serif;
                transition: all 0.3s ease;
            }
            
            .faq-question:hover {
                background-color: #f0f4f8;
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
                background-color: #e8f0fe;
                color: #2f72cf;
                transition: all 0.3s ease;
                flex-shrink: 0;
            }
            
            .faq-item.active .faq-icon {
                background-color: #2f72cf;
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
                color: #333;
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
                color: #2f72cf;
                text-decoration: underline;
            }
            
            .faq-answer-content a:hover {
                color: #1e5bb0;
            }
            
            /* Адаптивность */
            @media (max-width: 991.98px) {
                .faq-section {
                    padding: 30px 0;
                }
                
                .faq-title {
                    font-size: 24px;
                }
                
                .faq-question {
                    padding: 16px 20px;
                    font-size: 15px;
                }
                
                .faq-answer-content {
                    padding: 0 20px 20px 20px;
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
                
                .faq-question {
                    padding: 14px 16px;
                    font-size: 14px;
                }
                
                .faq-icon {
                    width: 28px;
                    height: 28px;
                }
                
                .faq-answer-content {
                    padding: 0 16px 16px 16px;
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
                
                .faq-question {
                    padding: 12px 14px;
                    font-size: 13px;
                }
                
                .faq-question-text {
                    padding-right: 12px;
                }
                
                .faq-answer-content {
                    padding: 0 14px 14px 14px;
                }
            }
        </style>

        <script>
            function toggleFaq(button) {
                const item = button.closest('.faq-item');
                const isActive = item.classList.contains('active');
                
                // Закрываем все остальные (опционально, можно убрать для множественного открытия)
                document.querySelectorAll('.faq-item').forEach(i => {
                    i.classList.remove('active');
                });
                
                // Если не был активен, открываем текущий
                if (!isActive) {
                    item.classList.add('active');
                }
            }
        </script>
        <?php
        return ob_get_clean();
    }
}
