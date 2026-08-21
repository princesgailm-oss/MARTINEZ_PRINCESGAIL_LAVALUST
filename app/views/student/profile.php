<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Student Profile'); ?></title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --mint-dark: #0f5132;
            --mint-main: #198754;
            --mint-mid: #20c997;
            --mint-light: #a3cfbb;
            --mint-bg: #eafaf1;
            --mint-card: #f3fcf7;
            --text-dark: #1e3a2b;
            --text-muted: #52796f;
            --border-mint: #c6e7d7;
            --white: #ffffff;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            background: 
                radial-gradient(circle at 85% 15%, rgba(32, 201, 151, 0.15), transparent 35%),
                radial-gradient(circle at 15% 85%, rgba(25, 135, 84, 0.12), transparent 40%),
                linear-gradient(135deg, #f4fbf7, #e6f7ef, #d8f3e5);
        }

        /* =========================
           ASYMMETRICAL TWO-COLUMN LAYOUT
        ========================= */
        .wrapper {
            width: min(1050px, calc(100% - 40px));
            margin: 40px auto;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
        }

        /* =========================
           SIDEBAR PANEL
        ========================= */
        .sidebar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 32px 24px;
            box-shadow: 0 15px 35px rgba(15, 81, 50, 0.06);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            height: fit-content;
        }

        .avatar-box {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0f5132, #20c997);
            color: var(--white);
            display: grid;
            place-items: center;
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 16px;
            box-shadow: 0 8px 20px rgba(25, 135, 84, 0.2);
            border: 3px solid var(--white);
        }

        .sidebar-name {
            margin: 0 0 6px 0;
            font-size: 20px;
            font-weight: 800;
            color: var(--mint-dark);
        }

        .sidebar-tag {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            background: var(--mint-card);
            border: 1px solid var(--border-mint);
            color: var(--mint-main);
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        /* POSITION CHANGED: Navigation Links inside Floating Sidebar */
        .nav-group {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .nav-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.25s ease;
        }

        .nav-btn-home {
            background: var(--white);
            color: var(--text-dark);
            border: 1px solid var(--border-mint);
        }

        .nav-btn-home:hover {
            background: var(--mint-bg);
            border-color: var(--mint-mid);
            transform: translateY(-2px);
        }

        .nav-btn-action {
            background: linear-gradient(135deg, #198754, #20c997);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);
        }

        .nav-btn-action:hover {
            background: linear-gradient(135deg, #0f5132, #198754);
            transform: translateY(-2px);
        }

        /* =========================
           MAIN BENTO CONTENT
        ========================= */
        .main-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 15px 35px rgba(15, 81, 50, 0.06);
        }

        .notice-banner {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 14px;
            background: var(--mint-card);
            border: 1px solid var(--border-mint);
            color: var(--mint-dark);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .notice-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--mint-mid);
            flex-shrink: 0;
        }

        /* BENTO GRID STRUCTURE */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .bento-card {
            background: var(--white);
            border: 1px solid var(--border-mint);
            border-radius: 16px;
            padding: 18px 20px;
            transition: all 0.25s ease;
        }

        .bento-card:hover {
            border-color: var(--mint-mid);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(25, 135, 84, 0.06);
        }

        .card-label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .card-value {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
            word-break: break-word;
        }

        .span-full {
            grid-column: 1 / -1;
        }

        .security-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px dashed var(--border-mint);
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* =========================
           RESPONSIVE DESIGN
        ========================= */
        @media (max-width: 768px) {
            .wrapper {
                grid-template-columns: 1fr;
            }

            .bento-grid {
                grid-template-columns: 1fr;
            }

            .span-full {
                grid-column: auto;
            }
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <!-- FLOATING SIDEBAR NAVIGATION -->
        <aside class="sidebar">
            <div class="avatar-box">🌿</div>
            <h2 class="sidebar-name"><?= htmlspecialchars($name); ?></h2>
            <span class="sidebar-tag">✦ Student Portal</span>

            <div class="nav-group">
                <!-- POSITION CHANGED: Navigation buttons grouped in sidebar -->
                <a href="<?= site_url('student'); ?>" class="nav-btn nav-btn-home">
                    ← Back Home
                </a>

                <a href="<?= site_url('student/open-profile'); ?>" class="nav-btn nav-btn-action">
                    Open Protected Profile ✦
                </a>
            </div>
        </aside>

        <!-- MAIN BENTO CONTENT AREA -->
        <main class="main-panel">

            <!-- NOTICE BANNER -->
            <?php if (!empty($notice)): ?>
                <div class="notice-banner">
                    <span class="notice-dot"></span>
                    <div><?= htmlspecialchars($notice, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
            <?php endif; ?>

            <!-- BENTO GRID DETAILS -->
            <div class="bento-grid">

                <div class="bento-card">
                    <span class="card-label">Student ID</span>
                    <span class="card-value"><?= htmlspecialchars($student_id); ?></span>
                </div>

                <div class="bento-card">
                    <span class="card-label">Section</span>
                    <span class="card-value"><?= htmlspecialchars($section); ?></span>
                </div>

                <div class="bento-card span-full">
                    <span class="card-label">Full Name</span>
                    <span class="card-value"><?= htmlspecialchars($name); ?></span>
                </div>

                <div class="bento-card span-full">
                    <span class="card-label">Course Program</span>
                    <span class="card-value"><?= htmlspecialchars($course); ?></span>
                </div>

                <div class="bento-card">
                    <span class="card-label">Year Level</span>
                    <span class="card-value"><?= htmlspecialchars($year); ?></span>
                </div>

                <div class="bento-card">
                    <span class="card-label">Email Address</span>
                    <span class="card-value"><?= htmlspecialchars($email); ?></span>
                </div>

            </div>

            <!-- SECURITY FOOTER -->
            <div class="security-footer">
                🔒 Protected by <strong>StudentMiddleware</strong>. Access to protected routes requires session verification.
            </div>

        </main>

    </div>

</body>
</html>