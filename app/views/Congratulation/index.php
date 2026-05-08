<main class="congratulation-page">
    <div class="congratulation-container">
        <div class="congratulation-content">
            <div class="congratulation-icon">
                <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="60" cy="60" r="55" fill="#dcfce7" stroke="#16a34a" stroke-width="3"/>
                    <path d="M45 60L55 70L80 40" stroke="#16a34a" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                </svg>
            </div>
            <h1 class="congratulation-title">Поздравляем!</h1>
            <h2 class="congratulation-subtitle">Тест успешно завершен</h2>
            <p class="congratulation-text">Спасибо за ваше участие!</p>
            <div class="congratulation-message">
                <p>Ваши ответы были записаны. Мы благодарны, что вы нашли время для прохождения этого теста.</p>
            </div>
            <a href="/" class="congratulation-btn">Вернуться на главную</a>
        </div>
    </div>
</main>

<style>
    .congratulation-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        padding: 20px;
    }
    
    .congratulation-container {
        width: 100%;
        max-width: 600px;
    }
    
    .congratulation-content {
        background: white;
        border-radius: 16px;
        padding: 60px 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    
    .congratulation-icon {
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
        animation: bounceIn 0.6s ease-out;
    }
    
    @keyframes bounceIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .congratulation-title {
        font-size: 42px;
        font-weight: 700;
        color: #065f46;
        margin: 0 0 16px 0;
        line-height: 1.2;
    }
    
    .congratulation-subtitle {
        font-size: 24px;
        font-weight: 600;
        color: #16a34a;
        margin: 0 0 24px 0;
        line-height: 1.3;
    }
    
    .congratulation-text {
        font-size: 20px;
        font-weight: 500;
        color: #374151;
        margin: 0 0 32px 0;
        line-height: 1.4;
    }
    
    .congratulation-message {
        background-color: #f0fdf4;
        border-left: 4px solid #16a34a;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 32px;
    }
    
    .congratulation-message p {
        margin: 0;
        color: #374151;
        font-size: 15px;
        line-height: 1.6;
    }
    
    .congratulation-btn {
        display: inline-block;
        background-color: #16a34a;
        color: white;
        padding: 14px 40px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
    }
    
    .congratulation-btn:hover {
        background-color: #15803d;
        box-shadow: 0 6px 16px rgba(22, 163, 74, 0.4);
        transform: translateY(-2px);
    }
    
    /* Адаптивность */
    @media (max-width: 767px) {
        .congratulation-content {
            padding: 40px 24px;
        }
        
        .congratulation-icon svg {
            width: 100px;
            height: 100px;
        }
        
        .congratulation-title {
            font-size: 32px;
            margin-bottom: 12px;
        }
        
        .congratulation-subtitle {
            font-size: 20px;
            margin-bottom: 16px;
        }
        
        .congratulation-text {
            font-size: 17px;
            margin-bottom: 24px;
        }
        
        .congratulation-message {
            padding: 16px;
            margin-bottom: 24px;
        }
        
        .congratulation-message p {
            font-size: 14px;
        }
        
        .congratulation-btn {
            padding: 12px 32px;
            font-size: 15px;
        }
    }
    
    @media (max-width: 480px) {
        .congratulation-page {
            padding: 16px;
        }
        
        .congratulation-content {
            padding: 32px 16px;
            border-radius: 12px;
        }
        
        .congratulation-icon svg {
            width: 80px;
            height: 80px;
        }
        
        .congratulation-title {
            font-size: 26px;
            margin-bottom: 10px;
        }
        
        .congratulation-subtitle {
            font-size: 18px;
            margin-bottom: 14px;
        }
        
        .congratulation-text {
            font-size: 15px;
            margin-bottom: 20px;
        }
        
        .congratulation-message {
            padding: 14px;
            margin-bottom: 20px;
        }
        
        .congratulation-message p {
            font-size: 13px;
        }
    }
</style>
