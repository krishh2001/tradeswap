<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradeSwap - Smart Cashback & Digital Wallet</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- <link rel="stylesheet" href="style.css"> --}}

    <style>
        :root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --secondary: #0d9488;
    --accent: #7c3aed;
    --dark: #1e293b;
    --light: #f8fafc;
    --gray: #94a3b8;
    --success: #10b981;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}


body {
    font-family: 'Inter', sans-serif;
    color: var(--dark);
    background-color: #ffffff;
    /* overflow-x: hidden; */
}

/* Navbar */
 /* Navbar Styles */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        nav.scrolled {
            padding: 0.8rem 5%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            text-decoration: none;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .download-btn {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        /* Mobile Menu Styles */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark);
            cursor: pointer;
            z-index: 1001;
            padding: 0.5rem;
        }

        /* Mobile View */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            
             .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 80%;
                max-width: 300px;
                height: 100vh;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 2rem;
                transition: right 0.3s ease;
                z-index: 1000;
                padding: 2rem;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            }
            
            .nav-links.active {
                right: 0;
            }
            
            .desktop-download-btn {
                display: none;
            }
            
            .mobile-download-btn {
                display: inline-block;
                margin-top: 1rem;
            }
            
            .nav-links a {
                font-size: 1.2rem;
            }
        }

        /* Prevent scrolling when menu is open */
        body.menu-open {
            overflow: hidden;
        }


/* Hero Section */
.hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 120px 5% 80px;
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    position: relative;
    overflow: hidden;
}



.hero-container {
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
    display: flex;
    align-items: center;
    gap: 60px;
    position: relative;
    z-index: 2;
}

.hero-content {
    flex: 1;
    max-width: 600px;
    animation: slideIn 0.8s forwards 0.3s;
}

@keyframes slideIn {
    from {
        transform: translateX(-50px);
        opacity: 0;
    }

    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.hero p {
    font-size: 1.2rem;
    color: var(--dark);
    margin-bottom: 2.5rem;
    line-height: 1.6;
    opacity: 0.9;
}

.hero-btns {
    display: flex;
    gap: 1rem;
    margin-bottom: 3rem;
}

.btn {
    padding: 1rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color: white;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
}

.pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.05);
    }

    100% {
        transform: scale(1);
    }
}

.hero-image-wrapper {
    flex: 1;
    position: relative;
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-frame {
    position: relative;
    z-index: 2;
    height: 100%;
    max-height: 600px;
    display: flex;
    align-items: center;
}

.hero-image {
    height: 100%;
    width: auto;
    max-height: 600px;
    object-fit: contain;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    transform: perspective(1000px) rotateY(-10deg);
    transition: all 0.5s ease;
}

.hero-image:hover {
    transform: perspective(1000px) rotateY(0deg);
}

.floating-shapes {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1;
    overflow: hidden;
}

.shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
    animation: float 6s ease-in-out infinite;
}

.shape.circle {
    width: 200px;
    height: 200px;
}

.shape.circle.blue {
    background: var(--primary);
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape.circle.purple {
    background: var(--accent);
    bottom: 15%;
    right: 10%;
    animation-delay: 1s;
}

.shape.dot-grid {
    width: 150px;
    height: 150px;
    background: radial-gradient(circle, var(--primary) 2px, transparent 2px);
    background-size: 10px 10px;
    top: 50%;
    left: 30%;
    animation-delay: 2s;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-20px);
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-container {
        flex-direction: column;
        text-align: center;
        gap: 40px;
    }

    .hero-content {
        max-width: 100%;
        margin-bottom: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .hero-btns {
        justify-content: center;
    }

    .hero-image {
        max-height: 500px;
    }
}

@media (max-width: 768px) {
    .hero {
        padding-top: 100px;
        padding-bottom: 60px;
    }

    .hero h1 {
        font-size: 3.5rem;
    }

    .hero p {
        font-size: 1.1rem;
    }

    .hero-image {
        max-height: 400px;
    }

    .hero-image-wrapper{
        min-height: 350px;
    }
}

@media (max-width: 480px) {
    .hero h1 {
        font-size: 3rem;
    }

    .hero-btns {
        flex-direction: column;
        width: 100%;
    }

    .btn {
        width: 100%;
        text-align: center;
        justify-content: center;
    }

    .hero-image {
        max-height: 400px;
    }
}

/* Subscription Section */
.subscription-section {
    padding: 80px 20px;
    /* background: #f7f9fc; */
    text-align: center;
}

.about-header h2 {
    text-align: center;
    font-size: 2.5rem;
    color: #222;
    margin-bottom: 60px;
}
.section-header h2 {
    font-size: 2.5rem;
    color: #222;
    margin-bottom: 10px;
}

.section-header p {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 50px;
}

.plans {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.plan-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    width: 300px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-bottom: 20px;
    position: relative;
    opacity: 0;
    transform: translateY(50px);
    animation: fadeUp 0.8s ease-out forwards;
}

.plan-card h3 {
    font-size: 1.6rem;
    /* color: #007bff; */
    color: #4928ff;
    margin-bottom: 10px;
}

.plan-card .price {
    font-size: 2rem;
    font-weight: bold;
    color: #222;
    margin-bottom: 20px;
}

.plan-card .price span {
    font-size: 1rem;
    color: #777;
}

.plan-card ul {
    list-style: none;
    padding: 0;
    margin: 0 0 30px 0;
    color: #444;
}

.plan-card ul li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
    font-size: 0.95rem;
}

.plan-content {
    padding: 30px 20px 0;
    flex-grow: 1;
}

.btn-plan {
    display: block;
    margin: 0 20px;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color: white;
    text-decoration: none;
    padding: 12px;
    border-radius: 8px;
    font-weight: bold;
    text-align: center;
    transition: background 0.3s ease, transform 0.3s;
    box-shadow: 0 4px 12px rgba(59, 89, 152, 0.3);
}

.btn-plan:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(59, 89, 152, 0.4);
}


/* Most Popular Badge */
.plan-card.popular {
    border: 2px solid #007bff;
    position: relative;
}

.plan-card .badge {
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    /* background: #007bff; */
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color: white;
    font-size: 0.8rem;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Fade Up Animation */
@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Delay support */
.plan-card:nth-child(1) {
    animation-delay: 0s;
}

.plan-card:nth-child(2) {
    animation-delay: 0.2s;
}

.plan-card:nth-child(3) {
    animation-delay: 0.4s;
}

/* Responsive */
@media (max-width: 992px) {
    .plans {
        flex-direction: column;
        align-items: center;
    }
}


.contact-section {
    padding: 80px 20px;
    background: #f7f9fc;
    text-align: center;
}

.contact-container {
    display: flex;
    max-width: 700px;
    margin: auto;
    gap: 40px;
    flex-wrap: wrap;
}

.contact-left,
.contact-right {
    flex: 1;
    min-width: 300px;
}

.contact-left h2 {
    font-size: 2.2rem;
    color: #222;
    margin-bottom: 10px;
}

.contact-left .subtitle {
    font-size: 1.05rem;
    color: #555;
    margin-bottom: 30px;
}

.contact-info p {
    font-size: 1rem;
    margin-bottom: 10px;
    color: #444;
}

.contact-info i {
    color: #007bff;
    margin-right: 10px;
}

.social-icons {
    margin-top: 20px;
}

.social-icons a {
    display: inline-block;
    margin-right: 12px;
    font-size: 1.2rem;
    color: #007bff;
    transition: color 0.3s;
}

.social-icons a:hover {
    color: #0056b3;
}

.formm {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    text-align: left;
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    background-color: #fefefe;
    transition: border 0.3s;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #007bff;
    outline: none;
}

.contact-btn {
    background: linear-gradient(to right, #007bff, #00c6ff);
    color: white;
    padding: 12px 25px;
    font-size: 1rem;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: background 0.3s ease;
}

.contact-btn:hover {
    background: linear-gradient(to right, #0056b3, #008ecc);
}

@media (max-width: 768px) {
    .contact-container {
        flex-direction: column;
    }

    .formm {
        padding: 20px;
    }
}



/* Footer */
footer {
    background-color: var(--dark);
    color: white;
    padding: 5rem 5% 2rem;
}

.footer-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 3rem;
    margin-bottom: 3rem;
}

.footer-col h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: white;
}

.footer-col p {
    color: var(--gray);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.footer-col ul {
    list-style: none;
}

.footer-col li {
    margin-bottom: 0.8rem;
}

.footer-col a {
    color: var(--gray);
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-col a:hover {
    color: white;
}

.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.social-links a {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.social-links a:hover {
    background-color: var(--primary);
    transform: translateY(-3px);
}

.subscribe-form {
    display: flex;
    margin-top: 1rem;
}

.subscribe-form input {
    flex: 1;
    padding: 0.8rem;
    border: none;
    border-radius: 50px 0 0 50px;
    background-color: rgba(255, 255, 255, 0.1);
    color: white;
}

.subscribe-form input::placeholder {
    color: var(--gray);
}

.subscribe-form button {
    padding: 0 1.5rem;
    border: none;
    border-radius: 0 50px 50px 0;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.subscribe-form button:hover {
    opacity: 0.9;
}

.copyright {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--gray);
}

/* Animations */
@keyframes float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}

.floating {
    animation: float 3s ease-in-out infinite;
}

.pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.05);
    }

    100% {
        transform: scale(1);
    }
}



.feature-section {
    padding: 70px 20px;
    background: #f9f9f9;
}

.feature-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: auto;
    gap: 70px;
    flex-wrap: wrap;
}

.feature-section.reverse .feature-container {
    flex-direction: row-reverse;
}

.feature-image {
    flex: 1;
    min-width: 300px;
    max-width: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-image img {
    width: 100%;
    height: auto;
    max-height: 420px;
    object-fit: cover;
    border-radius: 20px;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
    transform: rotate(-2deg);
    /* slight rotation */
    transition: transform 0.5s ease;
}

.feature-image:hover img {
    transform: rotate(0deg) scale(1.05);
    /* straight + zoom on hover */
}


.feature-text {
    flex: 1;
    min-width: 300px;
    max-width: 50%;
}

.feature-text h2 {
    font-size: 2.2rem;
    margin-bottom: 16px;
    color: #222;
}

.feature-text p {
    font-size: 1.05rem;
    color: #555;
    margin-bottom: 12px;
    line-height: 1.6;
}


.btn {
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color: #fff;
    padding: 12px 24px;
    border-radius: 10px;
    border: none;
    font-weight: bold;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: background 0.3s, transform 0.3s;
}

.btn:hover {
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .feature-container {
        flex-direction: column;
        text-align: center;
    }

    .feature-section.reverse .feature-container {
        flex-direction: column;
    }

    .feature-image,
    .feature-text {
        max-width: 100%;
    }

    .feature-text h2 {
        font-size: 1.8rem;
    }

    .feature-text p {
        font-size: 0.95rem;
    }
}

/* Optional scroll animation (fade-up) */

.feature-section {
    opacity: 0;
    transform: translateY(40px);
    animation: fadeUp 0.6s ease-in-out forwards;
}

@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* about */
 .about-section {
            padding: 80px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
       
        
        .about-container {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            align-items: center;
        }
        
        .about-text {
            flex: 1;
            min-width: 300px;
        }
        
        .about-text p {
            margin-bottom: 20px;
            font-size: 1.1rem;
            /* color: black; */
            /* color: var(--gray); */
        }
        
        .about-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }
        
        .about-card {
            background: white;
            border-radius: 12px;
            padding: 30px 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            border-top: 3px solid var(--primary);
        }
        
        .about-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .about-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 20px;
            background: rgba(67, 97, 238, 0.1);
            width: 70px;
            height: 70px;
            line-height: 70px;
            border-radius: 50%;
            text-align: center;
            display: inline-block;
        }
        
        .about-card h4 {
            font-size: 1.3rem;
            margin-bottom: 15px;
        }
        
        .about-card p {
            font-size: 0.95rem;
            color: #454d58;
        }
        
        @media (max-width: 768px) {
            .about-header h2 {
                font-size: 2.2rem;
            }
            
            .about-container {
                flex-direction: column;
            }
        }
    </style>

</head>

<body>
    <!-- Navbar -->
    <nav id="navbar">
        <a href="#" class="logo">
            <img src="images/logo.jpg" alt="Logo">
            TradeSwap
        </a>

        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-links" id="navLinks">
            <a href="#hero">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </div>
        <a href="#" class="download-btn desktop-download-btn">Download App</a>
    </nav>



    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Smart Cashback & Digital Wallet Solutions</h1>
                <p>TradeSwap revolutionizes your shopping experience with automatic cashback, digital subscriptions, and
                    seamless wallet management—all in one powerful app.</p>
                <div class="hero-btns">
                    <a href="#" class="btn btn-primary pulse">
                        <i class="fas fa-rocket"></i> Get Started - It's Free
                    </a>
                </div>
            </div>
            <div class="hero-image-wrapper">
                <div class="image-frame">
                    <img src="images/banner.jpg" alt="TradeSwap App Preview" class="hero-image">
                </div>
                <div class="floating-shapes">
                    <div class="shape circle blue"></div>
                    <div class="shape circle purple"></div>
                    <div class="shape dot-grid"></div>
                </div>
            </div>
        </div>
    </section>


    <!-- Subscription Section -->
    <section class="subscription-section" id="subscription">
        <div class="section-header">
            <h2>Choose Your Plan</h2>
            <p>Select the perfect plan for your needs. Upgrade, downgrade, or cancel anytime.</p>
        </div>
        <div class="plans">
            <!-- Basic Plan -->
            <div class="plan-card animate">
                <div class="plan-content">
                    <h3>Basic</h3>
                    <div class="price">$0<span>/month</span></div>
                    <ul>
                        <li>1% cashback on purchases</li>
                        <li>Basic wallet features</li>
                        <li>Access to standard coupons</li>
                        <li>Email support</li>
                    </ul>
                </div>
                <a href="#" class="btn-plan">Get Started</a>
            </div>

            <!-- Premium Plan -->
            <div class="plan-card popular animate" style="animation-delay: 0.2s;">
                <div class="badge">Most Popular</div>
                <div class="plan-content">
                    <h3>Premium</h3>
                    <div class="price">$9.99<span>/month</span></div>
                    <ul>
                        <li>3% cashback on purchases</li>
                        <li>Advanced wallet features</li>
                        <li>Premium coupons & deals</li>
                        <li>Priority support</li>
                        <li>Subscription management</li>
                    </ul>
                </div>
                <a href="#" class="btn-plan">Get Premium</a>
            </div>

            <!-- Family Plan -->
            <div class="plan-card animate" style="animation-delay: 0.4s;">
                <div class="plan-content">
                    <h3>Family</h3>
                    <div class="price">$14.99<span>/month</span></div>
                    <ul>
                        <li>5% cashback on purchases</li>
                        <li>All premium features</li>
                        <li>Up to 5 family members</li>
                        <li>24/7 VIP support</li>
                        <li>Exclusive partner offers</li>
                    </ul>
                </div>
                <a href="#" class="btn-plan">Family Plan</a>
            </div>
        </div>
    </section>




    <!-- Feature Section 1 -->
    <section class="feature-section">
        <div class="feature-container">
            <div class="feature-image">
                <img src="images/online-marketing.jpg" alt="Product Dashboard">
            </div>
            <div class="feature-text">
                <h2>Effortless Product Listings</h2>
                <p>Quickly showcase your products using our seamless interface. Add descriptions, pricing, and images
                    with ease—no technical skills required.</p>
                <p>Customize each listing with advanced tools like filters, tags, and smart categories to improve user
                    discovery and conversions.</p>
                <p>All listings are automatically optimized for speed and visibility, helping your products stand out in
                    a competitive marketplace.</p>
                <a href="#" class="btn"><i class="fas fa-arrow-right"></i> Learn More</a>
            </div>
        </div>
    </section>

    <!-- Feature Section 2 (Reversed Layout) -->
    <section class="feature-section reverse">
        <div class="feature-container">
            <div class="feature-image">
                <img src="images/standard-quality.jpg" alt="Secure Order Processing">
            </div>
            <div class="feature-text">
                <h2>Powerful Order Protection</h2>
                <p>Ensure every order is processed securely using our end-to-end encrypted payment and tracking system.
                    Trust is our top priority.</p>
                <p>Buyers and sellers both benefit from instant notifications, fraud protection, and dispute resolution
                    backed by our smart AI engine.</p>
                <p>Stay updated with real-time tracking, automated receipts, and seamless returns—all built to boost
                    confidence and satisfaction.</p>
                <a href="#" class="btn"><i class="fas fa-arrow-right"></i> Learn More</a>
            </div>
        </div>
    </section>




    <!-- About Us Section -->
    <section class="about-section" id="about">
        <div class="about-header">
            <h2>About TradeSwap</h2>
        </div>
        <div class="about-container">
            <div class="about-text">
                <p>TradeSwap is an innovative trading platform designed to simplify the way individuals and businesses exchange products. Our goal is to provide a seamless, trustworthy, and powerful environment where anyone can trade with confidence.</p>
                <p>We bring technology and transparency together to make sure trading is not just possible—but enjoyable, fast, and secure. With robust tools and modern UX, TradeSwap empowers users to grow and manage their product listings without hassle.</p>

                <div class="about-cards">
                    <div class="about-card">
                        <i class="fas fa-user-shield"></i>
                        <h4>Trusted by Thousands</h4>
                        <p>More than 25,000 active users rely on TradeSwap every day to buy, sell, and manage products securely.</p>
                    </div>
                    <div class="about-card">
                        <i class="fas fa-bolt"></i>
                        <h4>Fast & Reliable</h4>
                        <p>Experience smooth transactions, real-time notifications, and instant support for every order and inquiry.</p>
                    </div>
                    <div class="about-card">
                        <i class="fas fa-globe"></i>
                        <h4>Global Network</h4>
                        <p>Connect with buyers and sellers from around the world through our international marketplace system.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="section-header">
            <h2>Get in Touch</h2>
            <p>Fill out the form and we’ll get back to you shortly.</p>
        </div>
        <div class="contact-container">
            <div class="contact-right">
                <form class="formm">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" rows="5" placeholder="Write your message here..." required></textarea>
                    </div>
                    <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Send Message</button>
                </form>
            </div>
        </div>
    </section>





    <!-- Footer -->
    <footer id="contact">
        <div class="footer-container">
            <div class="footer-col">
                <h3>TradeSwap</h3>
                <p>The smart way to shop, save, and manage your money. Join millions of users who are earning cashback
                    every day.</p>
                <div class="social-links">
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg></a>
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                            </path>
                        </svg></a>
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg></a>
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                            </path>
                            <rect x="2" y="9" width="4" height="12"></rect>
                            <circle cx="4" cy="4" r="2"></circle>
                        </svg></a>
                </div>
            </div>
            <div class="footer-col">
                <h3>Company</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Support</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Newsletter</h3>
                <p>Subscribe to get updates on new features and exclusive offers.</p>
                <form class="subscribe-form">
                    <input type="email" placeholder="Your email">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 TradeSwap. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Navbar elements
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const navLinks = document.getElementById('navLinks');
            const navbar = document.getElementById('navbar');
            const body = document.body;
            const menuIcon = mobileMenuBtn?.querySelector('i');

            // Mobile menu functionality
            if (mobileMenuBtn && navLinks) {
                // Toggle mobile menu
                function toggleMenu() {
                    const isOpen = navLinks.classList.toggle('active');
                    body.classList.toggle('menu-open', isOpen);

                    // Change icon
                    if (isOpen) {
                        menuIcon.classList.replace('fa-bars', 'fa-times');
                    } else {
                        menuIcon.classList.replace('fa-times', 'fa-bars');
                    }
                }

                // Event listeners
                mobileMenuBtn.addEventListener('click', toggleMenu);

                // Close menu when clicking a link (mobile)
                document.querySelectorAll('.nav-links a').forEach(link => {
                    link.addEventListener('click', function () {
                        if (window.innerWidth <= 768) {
                            toggleMenu();
                        }
                    });
                });

                // Close menu when clicking outside (mobile)
                document.addEventListener('click', function (e) {
                    if (window.innerWidth <= 768 &&
                        !e.target.closest('#navLinks') &&
                        !e.target.closest('#mobileMenuBtn') &&
                        navLinks.classList.contains('active')) {
                        toggleMenu();
                    }
                });
            }

            // Navbar scroll effect
            if (navbar) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }

            // Handle window resize
            window.addEventListener('resize', function () {
                if (window.innerWidth > 768 && navLinks) {
                    // Reset mobile menu on larger screens
                    navLinks.classList.remove('active');
                    body.classList.remove('menu-open');
                    if (menuIcon) {
                        menuIcon.classList.replace('fa-times', 'fa-bars');
                    }
                }
            });

            // Smooth scrolling for all anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                        // Update URL without jumping
                        if (history.pushState) {
                            history.pushState(null, null, targetId);
                        } else {
                            location.hash = targetId;
                        }
                    }
                });
            });

            // Animation for elements with 'animate' class
            const animateElements = document.querySelectorAll('.animate, .feature-section');

            if (animateElements.length > 0) {
                const elementObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animated');

                            // For plan cards with delay
                            if (entry.target.classList.contains('plan-card')) {
                                const delay = entry.target.style.animationDelay || '0s';
                                entry.target.style.animation = `fadeUp 0.8s ease-out ${delay} forwards`;
                            } else {
                                entry.target.style.animation = 'fadeUp 0.8s ease-out forwards';
                            }
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px' // Trigger when 50px from bottom of viewport
                });

                animateElements.forEach(element => {
                    elementObserver.observe(element);
                });
            }

            // Form submission handling
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    // Basic form validation
                    const inputs = this.querySelectorAll('input[required], textarea[required]');
                    let isValid = true;

                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            isValid = false;
                            input.classList.add('error');
                        } else {
                            input.classList.remove('error');
                        }
                    });

                    if (isValid) {
                        // Here you would typically send the form data to a server
                        console.log('Form submitted:', this);

                        // Show success message (you can customize this)
                        alert('Thank you for your message! We will get back to you soon.');
                        this.reset();
                    }
                });
            });

            // Counter animation function
            function animateCounter(elementId, target, duration = 2000) {
                const element = document.getElementById(elementId);
                if (!element) return;

                const start = 0;
                const increment = target / (duration / 16);
                let current = start;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        clearInterval(timer);
                        current = target;
                    }
                    element.textContent = Math.floor(current).toLocaleString();
                }, 16);
            }

            // Initialize counters if stats section exists
            const statsSection = document.querySelector('.stats');
            if (statsSection) {
                const statsObserver = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        animateCounter('userCounter', 1250000);
                        animateCounter('cashbackCounter', 8500000);
                        animateCounter('transactionCounter', 43000000);
                        statsObserver.unobserve(statsSection);
                    }
                }, { threshold: 0.5 });

                statsObserver.observe(statsSection);
            }
        });
    </script>
</body>

</html>