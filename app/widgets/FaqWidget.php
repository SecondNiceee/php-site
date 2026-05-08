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
        <div class="faq-section">
            <div class="container">
                <div class="faq-header">
                    <span class="faq-badge">FAQ</span>
                    <h2 class="faq-title">Вопросы и ответы</h2>
                    <p class="faq-subtitle">Ответы на часто задаваемые вопросы</p>
                </div>
                <div class="faq-accordion">
                    <?php foreach ($faqs as $index => $faq): ?>
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                                <span class="faq-num"><?= $index + 1 ?></span>
                                <span class="faq-question-text"><?= htmlspecialchars($faq['question']) ?></span>
                                <span class="faq-icon">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 6L8 11L13 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                padding: 60px 0 50px;
                background: #f7f9fc;
                border-top: 1px solid #e8edf2;
                margin-top: 40px;
            }

            .faq-header {
                text-align: center;
                margin-bottom: 40px;
            }

            .faq-badge {
                display: inline-block;
                background: #082a43;
                color: #fff;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 2px;
                text-transform: uppercase;
                padding: 4px 12px;
                border-radius: 20px;
                margin-bottom: 14px;
            }

            .faq-title {
                font-size: 26px;
                font-weight: 700;
                color: #082a43;
                margin: 0 0 8px;
                line-height: 1.3;
            }

            .faq-subtitle {
                font-size: 15px;
                color: #6b7a8d;
                margin: 0;
            }

            .faq-accordion {
                max-width: 820px;
                margin: 0 auto;
            }

            .faq-item {
                background: #ffffff;
                border-radius: 10px;
                margin-bottom: 8px;
                border: 1px solid #e8edf2;
                overflow: hidden;
                transition: border-color 0.25s ease, box-shadow 0.25s ease;
            }

            .faq-item:hover {
                border-color: #c5d4e8;
                box-shadow: 0 4px 16px rgba(8, 42, 67, 0.07);
            }

            .faq-item.active {
                border-color: #2f72cf;
                box-shadow: 0 4px 20px rgba(47, 114, 207, 0.12);
            }

            .faq-question {
                width: 100%;
                display: flex;
                align-items: center;
                gap: 16px;
                padding: 18px 20px;
                background: none;
                border: none;
                cursor: pointer;
                text-align: left;
                font-size: 15px;
                font-weight: 600;
                color: #082a43;
                font-family: inherit;
                transition: background 0.2s ease;
            }

            .faq-question:hover {
                background: #f7f9fc;
            }

            .faq-item.active .faq-question {
                background: #f0f5ff;
            }

            .faq-num {
                display: flex;
                align-items: center;
                justify-content: center;
                min-width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #eef2f8;
                color: #2f72cf;
                font-size: 13px;
                font-weight: 700;
                flex-shrink: 0;
                transition: background 0.25s ease, color 0.25s ease;
            }

            .faq-item.active .faq-num {
                background: #2f72cf;
                color: #fff;
            }

            .faq-question-text {
                flex: 1;
                line-height: 1.4;
            }

            .faq-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                height: 28px;
                border-radius: 50%;
                background: #eef2f8;
                color: #2f72cf;
                flex-shrink: 0;
                transition: background 0.25s ease, transform 0.3s ease;
            }

            .faq-item.active .faq-icon {
                background: #2f72cf;
                color: #fff;
                transform: rotate(180deg);
            }

            .faq-answer {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.35s ease;
            }

            .faq-item.active .faq-answer {
                max-height: 2000px;
            }

            .faq-answer-content {
                padding: 0 20px 22px 66px;
                color: #445060;
                line-height: 1.7;
                font-size: 15px;
                border-top: 1px solid #eef2f8;
                padding-top: 16px;
            }

            .faq-answer-content p { margin-bottom: 12px; }
            .faq-answer-content p:last-child { margin-bottom: 0; }
            .faq-answer-content ul,
            .faq-answer-content ol { margin: 12px 0; padding-left: 20px; }
            .faq-answer-content li { margin-bottom: 6px; }
            .faq-answer-content a { color: #2f72cf; text-decoration: underline; }
            .faq-answer-content a:hover { color: #1e5bb0; }

            @media (max-width: 767.98px) {
                .faq-section { padding: 40px 0 30px; }
                .faq-title { font-size: 22px; }
                .faq-question { padding: 14px 16px; font-size: 14px; gap: 12px; }
                .faq-num { min-width: 26px; height: 26px; font-size: 12px; }
                .faq-answer-content { padding: 14px 16px 18px 54px; font-size: 14px; }
            }

            @media (max-width: 479.98px) {
                .faq-answer-content { padding-left: 16px; }
                .faq-num { display: none; }
            }
        </style>

        <script>
            function toggleFaq(button) {
                const item = button.closest('.faq-item');
                const isActive = item.classList.contains('active');

                document.querySelectorAll('.faq-item').forEach(i => {
                    i.classList.remove('active');
                    i.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                });

                if (!isActive) {
                    item.classList.add('active');
                    button.setAttribute('aria-expanded', 'true');
                }
            }
        </script>
        <?php
        return ob_get_clean();
    }
}
