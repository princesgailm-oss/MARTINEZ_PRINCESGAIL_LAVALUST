<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($title ?? 'Campus Profile Portal'); ?></title>

    <style>
        /* =========================
           GLOBAL SETTINGS (NO SCROLL / FULL SCREEN FIT)
        ========================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --nav-blue: #026aa7;
            --sky-blue: #0284c7;
            --sky-dark: #0369a1;
            --sky-light: #e0f2fe;

            --mint-main: #10b981;
            --mint-dark: #047857;
            --mint-light: #d1fae5;

            --text-dark: #0f172a;
            --text-muted: #334155;

            --border-sky-mint: #9ed7d0;
            --white: #ffffff;
        }

        html, body {
            height: 100vh;
            width: 100vw;
            overflow: hidden; /* Bawal ang scrolling */
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

            background:
                radial-gradient(
                    circle at 85% 15%,
                    rgba(2, 132, 199, 0.20),
                    transparent 40%
                ),
                radial-gradient(
                    circle at 15% 85%,
                    rgba(16, 185, 129, 0.20),
                    transparent 40%
                ),
                linear-gradient(
                    135deg,
                    #e0f2fe,
                    #d1fae5,
                    #e0f2fe
                );

            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* =========================
           NAVIGATION BAR (SOBRANG PINALAKI)
        ========================== */

        .navbar {
            background: var(--nav-blue);
            padding: 1vh 3vw;

            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            flex-shrink: 0;
            height: 9vh; /* Inangat ang taas ng Navbar */
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;

            color: var(--white);

            font-size: clamp(2rem, 2.3vw, 3.8rem); /* MGA SOBRANG LAKING TEXT SA NAVBAR */
            font-weight: 800;
            letter-spacing: -0.5px;
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

            font-size: clamp(1.2rem, 1.3vw, 2.2rem); /* PINALAKI ANG HOME AT STUDENT PROFILE BUTTONS */
            font-weight: 800;

            border: 2px solid rgba(255, 255, 255, 0.35);

            background: rgba(255, 255, 255, 0.15);

            transition: all 0.25s ease;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.30);
            transform: translateY(-2px);
        }

        /* =========================
           MAIN CONTAINER (PINAPASOK AT MAPUNO SA SCREEN)
        ========================== */

        .container {
            width: 98vw; /* Ginawang halos buong lapad ng screen */
            margin: 0 auto;
            height: 88vh;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1vh 0;
        }

        /* =========================
           NOTICE
        ========================== */

        .notice {
            background:
                linear-gradient(
                    135deg,
                    rgba(224, 242, 254, 0.90),
                    rgba(209, 250, 229, 0.90)
                );

            color: var(--sky-dark);

            border: 1px solid rgba(2, 132, 199, 0.25);
            border-left: 8px solid var(--sky-blue);

            padding: 0.8vh 1.5vw;

            border-radius: 12px;

            font-size: clamp(1.2rem, 1.3vw, 2rem);
            font-weight: 700;
        }

        /* =========================
           HERO PROFILE (PINALAKI ANG TEXTS)
        ========================== */

        .hero {
            background:
                linear-gradient(
                    135deg,
                    rgba(224, 242, 254, 0.92),
                    rgba(209, 250, 229, 0.92)
                );

            backdrop-filter: blur(12px);

            border: 2px solid rgba(2, 132, 199, 0.20);

            border-radius: 20px;

            padding: 1.2vh 2vw;

            box-shadow:
                0 8px 20px
                rgba(2, 132, 199, 0.10);

            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .profile-icon {
            width: clamp(75px, 6.5vh, 120px);
            height: clamp(75px, 6.5vh, 120px);

            margin-bottom: 0.5vh;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    var(--sky-blue),
                    var(--mint-main)
                );

            color: var(--white);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: clamp(2rem, 2.8vh, 3.8rem);
            font-weight: 800;

            box-shadow:
                0 6px 16px
                rgba(16, 185, 129, 0.25);

            border: 4px solid var(--sky-light);
        }

        .hero h1 {
            color: var(--sky-dark);

            margin-bottom: 0.2vh;

            font-size: clamp(2.2rem, 2.6vw, 4rem); /* SOBRANG LAKING PANGALAN */
            font-weight: 800;
        }

        .hero .course {
            color: var(--mint-dark);

            font-size: clamp(1.3rem, 1.5vw, 2.2rem);
            font-weight: 800;

            margin-bottom: 0.5vh;
        }

        .description {
            max-width: 90%;

            margin: 0 auto 0.8vh;

            line-height: 1.3;

            color: var(--text-muted);

            font-size: clamp(1.2rem, 1.35vw, 2.1rem); /* SOBRANG LAKING DESCRIPTION */
            font-weight: 600;
        }

        .profile-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;

            background:
                linear-gradient(
                    135deg,
                    var(--sky-blue),
                    var(--mint-main)
                );

            color: var(--white);

            text-decoration: none;

            padding: 0.8vh 2.5vw;

            border-radius: 12px;

            font-weight: 800;
            font-size: clamp(1.2rem, 1.3vw, 2rem);

            box-shadow:
                0 4px 12px
                rgba(2, 132, 199, 0.25);

            transition: all 0.3s ease;
        }

        .profile-button:hover {
            transform: translateY(-2px);

            background:
                linear-gradient(
                    135deg,
                    var(--sky-dark),
                    var(--mint-dark)
                );
        }

        /* =========================
           INFORMATION GRID
        ========================== */

        .info-grid {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 1.2vw;
            height: 50vh;
        }

        .card {
            background:
                linear-gradient(
                    135deg,
                    rgba(224, 242, 254, 0.90),
                    rgba(209, 250, 229, 0.90)
                );

            backdrop-filter: blur(12px);

            border: 2px solid rgba(16, 185, 129, 0.25);

            padding: 1.5vh 1.8vw;

            border-radius: 20px;

            box-shadow:
                0 6px 16px
                rgba(2, 132, 199, 0.08);

            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            overflow: hidden;
        }

        .card h3 {
            color: var(--sky-dark);

            margin-bottom: 0.8vh;

            border-bottom:
                3px solid
                rgba(2, 132, 199, 0.20);

            padding-bottom: 0.3vh;

            font-size: clamp(1.6rem, 1.8vw, 2.8rem); /* SOBRANG LAKING TITLES SA CARDS */
            font-weight: 800;
        }

        .info-row-container {
            display: flex;
            flex-direction: column;
            gap: 0.4vh;
            justify-content: space-around;
            height: 100%;
        }

        .info-row {
            line-height: 1.2;

            background:
                linear-gradient(
                    135deg,
                    rgba(224, 242, 254, 0.85),
                    rgba(209, 250, 229, 0.85)
                );

            padding: 0.6vh 1.2vw;

            border-radius: 10px;

            border:
                1px solid
                rgba(2, 132, 199, 0.15);

            font-size: clamp(1.3rem, 1.5vw, 2.3rem); /* PINALAKI ANG MGA VALUE (ID, Email, Name) */
            font-weight: 800;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-row strong {
            color: var(--sky-dark);

            font-size: clamp(1rem, 1.1vw, 1.6rem); /* PINALAKI ANG LABELS (STUDENT ID, EMAIL, ETC) */

            text-transform: uppercase;

            letter-spacing: 0.5px;
        }

        /* =========================
           ABOUT ME & SOCIAL MEDIA
        ========================== */

        .about-text {
            line-height: 1.5;

            color: var(--text-muted);

            font-size: clamp(1.3rem, 1.45vw, 2.2rem);
            font-weight: 600;
            margin-top: 0.5vh;
        }

        .social-description {
            color: var(--text-muted);

            margin-bottom: 0.8vh;

            font-size: clamp(1.3rem, 1.45vw, 2.2rem);
            font-weight: 600;
        }

        .social-links {
            display: flex;

            gap: 1.2vw;

            flex-wrap: wrap;
        }

        .social-links a {
            text-decoration: none;

            color: var(--white);

            background: var(--sky-blue);

            padding: 1vh 2.5vw;

            border-radius: 12px;

            font-size: clamp(1.2rem, 1.35vw, 2.1rem);
            font-weight: 800;

            transition: all 0.25s ease;

            box-shadow:
                0 4px 12px
                rgba(2, 132, 199, 0.20);
        }

        .social-links a:hover {
            transform: translateY(-2px);

            opacity: 0.90;
        }

        .instagram {
            background: var(--mint-main) !important;

            box-shadow:
                0 4px 12px
                rgba(16, 185, 129, 0.20)
                !important;
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

    <!-- NAVIGATION BAR -->
    <nav class="navbar">

        <div class="navbar-brand">

            <svg viewBox="0 0 24 24">
                <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zm0 13.15L4.82 12 12 8.09l7.18 3.91L12 16.15zM6 14.83v2.84c0 1.93 2.69 3.5 6 3.5s6-1.57 6-3.5v-2.84c-1.39 1.05-3.56 1.67-6 1.67s-4.61-.62-6-1.67z"/>
            </svg>

            Campus Profile Portal

        </div>

        <div class="nav-buttons">

            <a class="nav-btn" href="<?= site_url('student'); ?>">
                🏠 Home
            </a>

            <a class="nav-btn" href="<?= site_url('student/open-profile'); ?>">
                👤 Student Profile
            </a>

        </div>

    </nav>


    <!-- MAIN CONTENT -->
    <main class="container">

        <?php if (!empty($notice)): ?>

            <div class="notice">
                <?= htmlspecialchars($notice); ?>
            </div>

        <?php endif; ?>


        <!-- PROFILE HERO -->
        <section class="hero">

            <div class="profile-icon">
                PG
            </div>

            <h1>
                <?= htmlspecialchars($name ?? 'Princes Gail E. Martinez'); ?>
            </h1>

            <p class="course">

                <?= htmlspecialchars($course ?? 'BS Information Technology'); ?>

                ·

                <?= htmlspecialchars($year ?? '3rd Year'); ?>

            </p>

            <p class="description">
                Just a simple girl who loves learning, staying positive,
                and enjoying the small moments in life. I like taking on
                new challenges with a bright and happy mindset!
            </p>

            <a
                class="profile-button"
                href="<?= site_url('student/open-profile'); ?>"
            >
                Open Protected Profile ✦
            </a>

        </section>


        <!-- INFORMATION CARDS -->
        <section class="info-grid">


            <!-- STUDENT INFORMATION -->
            <div class="card">

                <h3>Student Information</h3>

                <div class="info-row-container">
                    <div class="info-row">
                        <strong>Student ID</strong>
                        <span><?= htmlspecialchars($student_id ?? 'MCC2024-00188'); ?></span>
                    </div>

                    <div class="info-row">
                        <strong>Name</strong>
                        <span><?= htmlspecialchars($name ?? 'Princes Gail E. Martinez'); ?></span>
                    </div>

                    <div class="info-row">
                        <strong>Course</strong>
                        <span><?= htmlspecialchars($course ?? 'BS Information Technology'); ?></span>
                    </div>

                    <div class="info-row">
                        <strong>Year</strong>
                        <span><?= htmlspecialchars($year ?? '3rd Year'); ?></span>
                    </div>

                    <div class="info-row">
                        <strong>Section</strong>
                        <span><?= htmlspecialchars($section ?? 'F4'); ?></span>
                    </div>
                </div>

            </div>


            <!-- CONTACT INFORMATION -->
            <div class="card">

                <h3>Contact Information</h3>

                <div class="info-row-container">
                    <div class="info-row">
                        <strong>Email</strong>
                        <span><?= htmlspecialchars($email ?? 'princesgailm@gmail.com'); ?></span>
                    </div>

                    <div class="info-row">
                        <strong>Contact</strong>
                        <span><?= htmlspecialchars($contact ?? '09123456789'); ?></span>
                    </div>

                    <div class="info-row">
                        <strong>Address</strong>
                        <span><?= htmlspecialchars($address ?? 'Barangay Tigkan, Naujan, Oriental Mindoro'); ?></span>
                    </div>

                    <div class="info-row">
                        <strong>Hobbies</strong>
                        <span><?= htmlspecialchars($hobbies ?? 'Web Development, Coding, Research'); ?></span>
                    </div>
                </div>

            </div>


            <!-- ABOUT ME -->
            <div class="card">

                <h3>About Me</h3>

                <p class="about-text">
                    I am a motivated and hardworking Information Technology
                    student who is passionate about learning new technologies
                    and developing creative solutions.
                </p>

            </div>


            <!-- SOCIAL MEDIA -->
            <div class="card">

                <h3>Social Media</h3>

                <p class="social-description">
                    Connect with me through:
                </p>

                <div class="social-links">

                    <?php if (!empty($facebook)): ?>

                        <a
                            href="<?= htmlspecialchars($facebook); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Facebook
                        </a>

                    <?php endif; ?>


                    <?php if (!empty($instagram)): ?>

                        <a
                            class="instagram"
                            href="<?= htmlspecialchars($instagram); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Instagram
                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </section>

    </main>


    <!-- FOOTER -->
    <footer>

        &copy; <?= date('Y'); ?>

        <?= htmlspecialchars($name ?? 'Princes Gail E. Martinez'); ?>

        . All rights reserved.

    </footer>

</body>
</html>