<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GramaLink - Welcome</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('<?=ROOT?>/assets/images/bg.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            padding: 20px;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            position: relative;
            z-index: 2;
            padding: 40px 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .logo {
            width: 140px;
            height: 140px;
            /* background-color: rgba(255, 255, 255, 0.9); */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .logo img {
            width: 80%;
            height: auto;
        }
        
        .header h1 {
            color: #ffffff;
            font-size: 44px;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 15px;
        }
        
        .header p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        
        .language-options {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 50px;
            flex-wrap: wrap;
        }
        
        .language-card {
            width: 320px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }
        
        .language-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .card-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .card-header h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 5px;
        }
        
        .card-header .flag {
            font-size: 32px;
            margin-bottom: 15px;
        }
        
        .card-body {
            padding: 30px 25px;
            text-align: center;
        }
        
        .card-body p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        
        .btn {
            display: inline-block;
            padding: 14px 34px;
            background: linear-gradient(135deg, #1e90ff 0%, #4169e1 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(65, 105, 225, 0.4);
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(65, 105, 225, 0.6);
        }
        
        .english .btn {
            background: linear-gradient(135deg, #1e90ff 0%, #4169e1 100%);
            box-shadow: 0 5px 15px rgba(65, 105, 225, 0.4);
        }
        
        .english .btn:hover {
            box-shadow: 0 8px 20px rgba(65, 105, 225, 0.6);
        }
        
        .sinhala .btn {
            background: linear-gradient(135deg, #ff7e00 0%, #ff5722 100%);
            box-shadow: 0 5px 15px rgba(255, 87, 34, 0.4);
        }
        
        .sinhala .btn:hover {
            box-shadow: 0 8px 20px rgba(255, 87, 34, 0.6);
        }
        
        .footer {
            margin-top: 80px;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
        }
        
        .footer p {
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }
        
        @media (max-width: 768px) {
            .language-options {
                flex-direction: column;
                align-items: center;
            }
            
            .language-card {
                width: 100%;
                max-width: 320px;
                margin-bottom: 30px;
            }
            
            .header h1 {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="<?=ROOT?>/assets/images/logo_white.png" alt="GramaLink Logo">
            </div>
            <h1>GramaLink</h1>
            <p>Connecting communities and streamlining government services in a single platform</p>
        </div>
        
        <div class="language-options">
            <div class="language-card english">
                <div class="card-header">
                    <div class="flag">🇬🇧</div>
                    <h2>English</h2>
                </div>
                <div class="card-body">
                    <p>Welcome to GramaLink. Access community services and information in your preferred language.</p>
                    <button onclick="setLanguage('en')" class="btn">Continue in English</button>
                </div>
            </div>
            
            <div class="language-card sinhala">
                <div class="card-header">
                    <div class="flag">🇱🇰</div>
                    <h2>සිංහල</h2>
                </div>
                <div class="card-body">
                    <p>ග්‍රාම ලින්ක් වෙත සාදරයෙන් පිළිගනිමු. ඔබේ කැමති භාෂාවෙන් ප්‍රජා සේවා සහ තොරතුරු වෙත පිවිසෙන්න.</p>
                    <button onclick="setLanguage('si')" class="btn">සිංහල භාෂාවෙන් ඉදිරියට යන්න</button>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; 2025 GramaLink | Empowering Communities Through Technology</p>
        </div>
    </div>

    <script>
        function setLanguage(lang) {
            // Set cookies for 1 year
            document.cookie = "language=" + lang + "; path=/; max-age=" + (60 * 60 * 24 * 365);
            window.location.href = 'guestHome_01'; // Redirect to the main page
        }
    </script>
</body>
</html>
