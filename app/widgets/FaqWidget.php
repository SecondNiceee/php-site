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
        
        $prefix = $type . '-' . $id;
        ob_start();
        ?>
        <section class="faq-section">
            <div class="faq-section__container">
                <div class="faq-section__header">
                    <h4>Вопросы и ответы</h4>
                    <p class="faq-section__subtitle">Ответы на часто задаваемые вопросы</p>
                </div>
                <div class="faq-section__list" id="faqAccordion-<?= $prefix ?>">
                    <?php foreach ($faqs as $index => $faq): ?>
                        <div class="faq-item" id="faq-item-<?= $prefix ?>-<?= $index ?>">
                            <button
                                class="faq-item__question"
                                onclick="toggleFaqItem('<?= $prefix ?>-<?= $index ?>')"
                                aria-expanded="false"
                                aria-controls="faq-answer-<?= $prefix ?>-<?= $index ?>"
                            >
                                <span class="faq-item__num"><?= $index + 1 ?></span>
                                <span class="faq-item__text"><?= htmlspecialchars($faq['question']) ?></span>
                                <span class="faq-item__icon">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M2 5L7 10L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </button>
                            <div class="faq-item__answer" id="faq-answer-<?= $prefix ?>-<?= $index ?>">
                                <div class="faq-item__answer-inner">
                                    <?= $faq['answer'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <style>
            .faq-section {
                padding: 60px 0 50px;
                background: #f7f9fc;
                border-top: 1px solid #e8edf2;
                margin-top: 40px;
            }

            .faq-section__container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 15px;
            }

            .faq-section__header {
                text-align: center;
                margin-bottom: 36px;
            }

            .faq-section__header h4 {
                font-size: 24px;
                font-weight: 700;
                color: #082a43;
                margin-bottom: 8px;
            }

            .faq-section__subtitle {
                font-size: 15px;
                color: #6b7a8d;
                margin: 0;
            }

            .faq-section__list {
                max-width: 840px;
                margin: 0 auto;
            }

            .faq-item {
                background: #ffffff;
                border-radius: 8px;
                margin-bottom: 8px;
                border: 1px solid #e8edf2;
                overflow: hidden;
                transition: border-color 0.25s, box-shadow 0.25s;
            }

            .faq-item:hover {
                border-color: #c5cdd8;
                box-shadow: 0 4px 16px rgba(8, 42, 67, 0.07);
            }

            .faq-item.active {
                border-color: #e8282f;
                box-shadow: 0 4px 20px rgba(232, 40, 47, 0.10);
            }

            .faq-item__question {
                width: 100%;
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 18px 20px;
                background: none;
                border: none;
                cursor: pointer;
                text-align: left;
                font-size: 15px;
                font-weight: 600;
                color: #082a43;
                font-family: Ubuntu, sans-serif;
                transition: background 0.2s;
            }

            .faq-item__question:hover {
                background: #f7f9fc;
            }

            .faq-item.active .faq-item__question {
                background: #fff5f5;
            }

            .faq-item__num {
                display: flex;
                align-items: center;
                justify-content: center;
                min-width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #eef2f8;
                color: #082a43;
                font-size: 13px;
                font-weight: 700;
                flex-shrink: 0;
                transition: background 0.25s, color 0.25s;
            }

            .faq-item.active .faq-item__num {
                background: #e8282f;
                color: #fff;
            }

            .faq-item__text {
                flex: 1;
                line-height: 1.4;
            }

            .faq-item__icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                height: 28px;
                border-radius: 50%;
                background: #eef2f8;
                color: #082a43;
                flex-shrink: 0;
                transition: background 0.25s, color 0.25s, transform 0.3s;
            }

            .faq-item.active .faq-item__icon {
                background: #e8282f;
                color: #fff;
                transform: rotate(180deg);
            }

            .faq-item__answer {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.4s ease;
                display: block;
            }

            .faq-item.active .faq-item__answer {
                max-height: 1500px;
            }

            .faq-item__answer-inner {
                padding: 0 20px 0 64px;
                color: #445060;
                line-height: 1.7;
                font-size: 15px;
                display: block;
            }

            .faq-item.active .faq-item__answer-inner {
                padding-bottom: 20px;
                padding-top: 14px;
                border-top: 1px solid #f0f0f0;
            }

            .faq-item__answer-inner p { margin-bottom: 10px; }
            .faq-item__answer-inner p:last-child { margin-bottom: 0; }
            .faq-item__answer-inner ul,
            .faq-item__answer-inner ol { margin: 10px 0; padding-left: 20px; }
            .faq-item__answer-inner li { margin-bottom: 6px; list-style: disc; }
            .faq-item__answer-inner a { color: #e8282f; text-decoration: underline; }
            .faq-item__answer-inner a:hover { color: #b81e24; }

            @media (max-width: 767px) {
                .faq-section { padding: 40px 0 30px; }
                .faq-item__question { padding: 14px 16px; font-size: 14px; gap: 10px; }
                .faq-item__num { min-width: 26px; height: 26px; font-size: 12px; }
                .faq-item__answer-inner { padding-left: 52px; font-size: 14px; }
            }

            @media (max-width: 479px) {
                .faq-item__answer-inner { padding-left: 16px; }
                .faq-item__num { display: none; }
            }
        </style>

        <script>
            function toggleFaqItem(itemId) {
                var item = document.getElementById('faq-item-' + itemId);
                if (!item) return;
                
                var btn = item.querySelector('.faq-item__question');
                var isActive = item.classList.contains('active');

                document.querySelectorAll('.faq-item').forEach(function(i) {
                    i.classList.remove('active');
                    i.querySelector('.faq-item__question').setAttribute('aria-expanded', 'false');
                });

                if (!isActive) {
                    item.classList.add('active');
                    btn.setAttribute('aria-expanded', 'true');
                }
            }
        </script>
        <?php
        return ob_get_clean();
    }
}
