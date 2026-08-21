<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($title ?? 'My Personal Profile'); ?></title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            color: #333;
            min-height: 100vh;
        }

        .navbar {
            background: #1e3a8a;
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .navbar h2 {
            font-size: 22px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            background: #2563eb;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
        }

        .navbar a:hover {
            background: #1d4ed8;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 40px auto;
        }

        .hero {
            background: white;
            border-radius: 18px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            text-align: center;
            margin-bottom: 25px;
        }

        .profile-icon {
            width: 110px;
            height: 110px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #1e3a8a;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            font-weight: bold;
        }

        .hero h1 {
            color: #1e3a8a;
            margin-bottom: 10px;
            font-size: 32px;
        }

        .hero .course {
            color: #666;
            font-size: 17px;
            margin-bottom: 20px;
        }

        .description {
            max-width: 700px;
            margin: auto;
            line-height: 1.7;
            color: #555;
        }

        .notice {
            background: #dbeafe;
            color: #1e40af;
            border-left: 5px solid #2563eb;
            padding: 15px 18px;
            margin-bottom: 25px;
            border-radius: 8px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
        }

        .card h3 {
            color: #1e3a8a;
            margin-bottom: 18px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
        }

        .info-row {
            margin-bottom: 13px;
            line-height: 1.5;
        }

        .info-row strong {
            color: #444;
        }

        .social-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .social-links a {
            text-decoration: none;
            color: white;
            background: #2563eb;
            padding: 10px 15px;
            border-radius: 7px;
            font-size: 14px;
        }

        .social-links a:hover {
            opacity: 0.85;
        }

        .instagram {
            background: #c13584 !important;
        }

        .profile-button {
            display: inline-block;
            margin-top: 25px;
            background: #1e3a8a;
            color: white;
            text-decoration: none;
            padding: 13px 25px;
            border-radius: 8px;
            font-weight: bold;
        }

        .profile-button:hover {
            background: #172554;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #777;
            font-size: 14px;
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 15px 18px;
            }

            .navbar h2 {
                font-size: 18px;
            }

            .container {
                width: 94%;
                margin: 25px auto;
            }

            .hero {
                padding: 30px 20px;
            }

            .hero h1 {
                font-size: 25px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- NAVIGATION -->
    <nav class="navbar">
        <h2>My Personal Profile</h2>

        <a href="<?= site_url('student/open-profile'); ?>">
            Open Profile
        </a>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="container">

        <?php if (!empty($notice)): ?>
            <div class="notice">
                <?= htmlspecialchars($notice); ?>
            </div>
        <?php endif; ?>

        <!-- HERO -->
        <section class="hero">

            <div class="profile-icon">
                PG
            </div>

            <h1>
                <?= htmlspecialchars($name ?? 'Student Name'); ?>
            </h1>

            <p class="course">
                <?= htmlspecialchars($course ?? 'BS Information Technology'); ?>
                ·
                <?= htmlspecialchars($year ?? '3rd Year'); ?>
            </p>

            <p class="description">
                <?= htmlspecialchars($profile_description ?? 'Welcome to my personal profile.'); ?>
            </p>

            <a
                class="profile-button"
                href="<?= site_url('student/open-profile'); ?>"
            >
                View Full Profile
            </a>

        </section>

        <!-- INFORMATION CARDS -->
        <section class="info-grid">

            <!-- STUDENT INFORMATION -->
            <div class="card">
                <h3>Student Information</h3>

                <div class="info-row">
                    <strong>Student ID:</strong><br>
                    <?= htmlspecialchars($student_id ?? 'N/A'); ?>
                </div>

                <div class="info-row">
                    <strong>Name:</strong><br>
                    <?= htmlspecialchars($name ?? 'N/A'); ?>
                </div>

                <div class="info-row">
                    <strong>Course:</strong><br>
                    <?= htmlspecialchars($course ?? 'N/A'); ?>
                </div>

                <div class="info-row">
                    <strong>Year:</strong><br>
                    <?= htmlspecialchars($year ?? 'N/A'); ?>
                </div>

                <div class="info-row">
                    <strong>Section:</strong><br>
                    <?= htmlspecialchars($section ?? 'N/A'); ?>
                </div>
            </div>

            <!-- CONTACT INFORMATION -->
            <div class="card">
                <h3>Contact Information</h3>

                <div class="info-row">
                    <strong>Email:</strong><br>
                    <?= htmlspecialchars($email ?? 'N/A'); ?>
                </div>

                <div class="info-row">
                    <strong>Contact:</strong><br>
                    <?= htmlspecialchars($contact ?? 'N/A'); ?>
                </div>

                <div class="info-row">
                    <strong>Address:</strong><br>
                    <?= htmlspecialchars($address ?? 'N/A'); ?>
                </div>

                <div class="info-row">
                    <strong>Hobbies:</strong><br>
                    <?= htmlspecialchars($hobbies ?? 'N/A'); ?>
                </div>
            </div>

            <!-- ABOUT -->
            <div class="card">
                <h3>About Me</h3>

                <p style="line-height: 1.7; color: #555;">
                    <?= htmlspecialchars($profile_description ?? 'No description available.'); ?>
                </p>
            </div>

            <!-- SOCIAL MEDIA -->
            <div class="card">
                <h3>Social Media</h3>

                <p style="color: #666; margin-bottom: 10px;">
                    You can connect with me through:
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

    <footer>
        &copy; <?= date('Y'); ?>
        <?= htmlspecialchars($name ?? 'Student'); ?>.
        All rights reserved.
    </footer>

</body>
</html>