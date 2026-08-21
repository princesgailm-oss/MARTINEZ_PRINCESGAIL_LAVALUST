<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Campus Profile Portal'); ?></title>

    <style>
        /* =========================
           GLOBAL SETTINGS (NO SCROLL)
        ========================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --nav-blue: linear-gradient(135deg, #0284c7, #026aa7);
            --sky-blue: #0284c7;
            --sky-dark: #0369a1;
            --mint-main: #10b981;
            --mint-dark: #047857;
            --text-dark: #0f172a;
            --text-muted: #334155;
            --white: #ffffff;
            
            /* Enhanced Card Background Gradients */
            --glass-bg: linear-gradient(135deg, rgba(224, 242, 254, 0.95), rgba(209, 250, 229, 0.95));
            --card-inner-bg: linear-gradient(135deg, #ffffff, #e6fffa);
            --card-hover-bg: linear-gradient(135deg, #e0f2fe, #d1fae5);
        }

        html, body {
            height: 100vh;
            width: 100vw;
            overflow: hidden; /* Bawal mag-scroll */
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: 
                radial-gradient(circle at 85% 15%, rgba(2, 132, 199, 0.35), transparent 45%),
                radial-gradient(circle at 15% 85%, rgba(16, 185, 129, 0.35), transparent 45%),
                linear-gradient(135deg, #bae6fd, #a7f3d0, #bae6fd);
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* =========================
           TOP NAVIGATION BAR
        ========================== */
        .navbar {
            background: var(--nav-blue);
            padding: 1vh 3vw;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(2, 132, 199, 0.3);
            flex-shrink: 0;
            height: 9vh;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--white);
            font-size: clamp(2rem, 2.3vw, 3.8rem);
            font-weight: 800;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }

        .navbar-brand svg {
            width: clamp(36px, 2.5vw, 54px);
            height: clamp(36px, 2.5vw, 54px);
            fill: var(--white);
            flex-shrink: 0;
        }

        .nav-buttons {
            display: flex;
            gap: 1.2vw;
        }

        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--white);
            text-decoration: none;
            padding: 1vh 1.8vw;
            border-radius: 12px;
            font-size: clamp(1.2rem, 1.3vw, 2.2rem);
            font-weight: 800;
            border: 2px solid rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        /* =========================
           MAIN DASHBOARD CONTAINER
        ========================== */
        .dashboard-container {
            width: 98vw;
            margin: 0 auto;
            height: 87vh;
            display: grid;
            grid-template-columns: clamp(350px, 25vw, 550px) 1fr;
            gap: 1.5vw;
            align-items: stretch;
            padding: 1.5vh 0;
        }

        /* =========================
           LEFT SIDE PANEL
        ========================== */
        .side-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            border: 2px solid rgba(16, 185, 129, 0.3);
            border-radius: 28px;
            padding: 3vh 2vw;
            text-align: center;
            box-shadow: 0 12px 32px rgba(2, 132, 199, 0.15);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .avatar-circle {
            width: clamp(100px, 12vh, 180px);
            height: clamp(100px, 12vh, 180px);
            margin: 0 auto 2vh;
            border-radius: 50%;
            background: linear-gradient(135deg, #0284c7, #10b981);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.35);
            border: 5px solid var(--white);
        }

        .avatar-circle svg {
            width: clamp(50px, 6vh, 90px);
            height: clamp(50px, 6vh, 90px);
            fill: #ffffff;
        }

        .side-panel h2 {
            font-size: clamp(1.8rem, 2vw, 3.2rem);
            font-weight: 800;
            color: #0369a1;
            line-height: 1.2;
            margin-bottom: 1.5vh;
        }

        .badge-tag {
            display: inline-block;
            background: linear-gradient(135deg, #d1fae5, #e0f2fe);
            color: var(--mint-dark);
            font-size: clamp(1.1rem, 1.2vw, 1.8rem);
            font-weight: 800;
            padding: 0.8vh 2vw;
            border-radius: 30px;
            border: 2px solid #6ee7b7;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.15);
            margin-bottom: 3.5vh;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 1.5vh;
            width: 100%;
        }

        .btn-secondary {
            display: block;
            width: 100%;
            padding: 1.5vh 1vw;
            background: var(--white);
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 16px;
            font-size: clamp(1.2rem, 1.3vw, 2rem);
            font-weight: 800;
            border: 2px solid #93c5fd;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.1);
            transition: all 0.25s ease;
        }

        .btn-secondary:hover {
            background: #f0f9ff;
            border-color: #38bdf8;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(2, 132, 199, 0.2);
        }

        .btn-primary-action {
            display: block;
            width: 100%;
            padding: 1.5vh 1vw;
            background: linear-gradient(135deg, #0284c7, #10b981);
            color: var(--white);
            text-decoration: none;
            border-radius: 16px;
            font-size: clamp(1.2rem, 1.3vw, 2rem);
            font-weight: 800;
            border: none;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .btn-primary-action:hover {
            background: linear-gradient(135deg, #0369a1, #047857);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.45);
        }

        /* =========================
           RIGHT MAIN PANEL
        ========================== */
        .main-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            border: 2px solid rgba(2, 132, 199, 0.3);
            border-radius: 28px;
            padding: 2.5vh 2vw;
            box-shadow: 0 12px 32px rgba(2, 132, 199, 0.15);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .info-cards-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2vw;
            height: 90%;
        }

        .info-card {
            background: var(--card-inner-bg);
            border: 2px solid #a7f3d0;
            border-radius: 20px;
            padding: 1.5vh 1.8vw;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.08);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            background: var(--card-hover-bg);
            border-color: #34d399;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.18);
        }

        .info-card.full-width {
            grid-column: span 2;
        }

        .info-card.active-border {
            border: 2.5px solid #38bdf8;
            background: linear-gradient(135deg, #ffffff, #e0f2fe);
        }

        .card-label {
            font-size: clamp(1rem, 1.1vw, 1.6rem);
            font-weight: 800;
            color: var(--sky-dark);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.5vh;
        }

        .card-value {
            font-size: clamp(1.4rem, 1.6vw, 2.6rem);
            font-weight: 800;
            color: #0f172a;
        }

        .protection-footer {
            padding-top: 1.5vh;
            border-top: 2px dashed #38bdf8;
            font-size: clamp(1.1rem, 1.2vw, 1.8rem);
            font-weight: 600;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* =========================
           FOOTER
        ========================== */
        footer {
            text-align: center;
            padding: 0.3vh;
            color: var(--text-muted);
            font-size: clamp(1rem, 1.1vw, 1.5rem);
            font-weight: 700;
            flex-shrink: 0;
            height: 3vh;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-brand">
            <svg viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zm0 13.15L4.82 12 12 8.09l7.18 3.91L12 16.15zM6 14.83v2.84c0 1.93 2.69 3.5 6 3.5s6-1.57 6-3.5v-2.84c-1.39 1.05-3.56 1.67-6 1.67s-4.61-.62-6-1.67z"/></svg>
            Campus Profile Portal
        </div>

        <div class="nav-buttons">
            <a class="nav-btn" href="<?= site_url('student'); ?>">
                🏠 Home
            </a>
            <!-- Nilagyan ng class na 'btn-protected' para ma-trigger ang Access Denied -->
            <a class="nav-btn btn-protected" href="#">
                👤 Student Profile
            </a>
        </div>
    </nav>

    <!-- MAIN TWO-COLUMN DASHBOARD -->
    <main class="dashboard-container">

        <!-- LEFT SIDE PANEL -->
        <aside class="side-panel">
            <div class="avatar-circle">
                <svg viewBox="0 0 24 24">
                    <path d="M6 3c2.5 0 5 1.5 6 4 1-2.5 3.5-4 6-4 0 5.5-3.5 10-6 13V21H10v-4C7.5 13 4 8.5 4 3z"/>
                </svg>
            </div>

            <h2><?= htmlspecialchars($name ?? 'Princes Gail E. Martinez'); ?></h2>
            <span class="badge-tag">✦ Student Portal</span>

            <div class="btn-group">
                <a class="btn-secondary" href="<?= site_url('student'); ?>">
                    ← Back Home
                </a>
                <!-- Nilagyan ng class na 'btn-protected' para ma-trigger ang Access Denied -->
                <a class="btn-primary-action btn-protected" href="#">
                    Student Profile 
                </a>
            </div>
        </aside>

        <!-- RIGHT MAIN PANEL WITH GRID CARDS -->
        <section class="main-panel">
            <div class="info-cards-grid">

                <div class="info-card">
                    <div class="card-label">Student ID</div>
                    <div class="card-value"><?= htmlspecialchars($student_id ?? 'MCC2024-00188'); ?></div>
                </div>

                <div class="info-card">
                    <div class="card-label">Section</div>
                    <div class="card-value"><?= htmlspecialchars($section ?? 'F4'); ?></div>
                </div>

                <div class="info-card full-width">
                    <div class="card-label">Full Name</div>
                    <div class="card-value"><?= htmlspecialchars($name ?? 'Princes Gail E. Martinez'); ?></div>
                </div>

                <div class="info-card full-width active-border">
                    <div class="card-label">Course Program</div>
                    <div class="card-value"><?= htmlspecialchars($course ?? 'BS Information Technology'); ?></div>
                </div>

                <div class="info-card active-border">
                    <div class="card-label">Year Level</div>
                    <div class="card-value"><?= htmlspecialchars($year ?? '3rd Year'); ?></div>
                </div>

                <div class="info-card">
                    <div class="card-label">Email Address</div>
                    <div class="card-value"><?= htmlspecialchars($email ?? 'princesgailm@gmail.com'); ?></div>
                </div>

            </div>

            <div class="protection-footer">
                🔒 Protected by <strong>StudentMiddleware</strong>. Access to protected routes requires session verification.
            </div>
        </section>

    </main>

    <footer>
        &copy; <?= date('Y'); ?> <?= htmlspecialchars($name ?? 'Princes Gail E. Martinez'); ?>. All rights reserved.
    </footer>

    <!-- ==========================================
         ACCESS DENIED SCRIPT (ILINAGAY SA BABA)
    =========================================== -->
    <script>
        document.querySelectorAll('.btn-protected').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Pipigilan nito ang pag-redirect o pag-refresh
                alert('Access Denied: Protected by StudentMiddleware.');
            });
        });
    </script>

</body>
</html>