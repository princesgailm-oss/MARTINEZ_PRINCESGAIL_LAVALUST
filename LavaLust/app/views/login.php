<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin Portal</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f5132 0%, #38bdf8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #174d36;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 35px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.18);
            border: 1px solid #e0f2fe;
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-title h2 {
            margin: 0;
            font-size: 28px;
            color: #0f5132;
            font-weight: 700;
        }

        .form-title p {
            margin: 8px 0 0;
            font-size: 14px;
            color: #0284c7;
        }

        .error {
            background: #f8d7da;
            border: 1px solid #f5c2c7;
            color: #842029;
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            height: 50px;
            border: 1.5px solid #bae6fd;
            border-radius: 10px;
            background: #f0f9ff;
            padding: 0 15px 0 45px;
            font-size: 14px;
            color: #0f172a;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus {
            border-color: #38bdf8;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.25);
        }

        .login-btn {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #0f5132 0%, #0284c7 100%);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        }

        .login-btn:hover {
            opacity: 0.95;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(2, 132, 199, 0.4);
        }

        .login-btn span {
            margin-left: 6px;
            display: inline-block;
            transition: transform 0.2s ease;
        }

        .login-btn:hover span {
            transform: translateX(4px);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 25px 0 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider-text {
            color: #0284c7;
            font-size: 12px;
            white-space: nowrap;
            font-weight: 500;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #94a3b8;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }

            .form-title h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <!-- LOGIN TITLE -->
        <div class="form-title">
            <h2>Welcome Back!</h2>
            <p>Sign in to your account</p>
        </div>

        <!-- ERROR MESSAGE -->
        <?php if (isset($error)): ?>
            <div class="error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <!-- LOGIN FORM -->
        <form method="POST" action="<?= site_url('login'); ?>">

            <!-- USERNAME -->
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <span class="input-icon">👤</span>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control"
                        placeholder="Username"
                        required
                    >
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">🔒</span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        required
                    >
                </div>
            </div>

            <!-- LOGIN BUTTON -->
            <button type="submit" class="login-btn">
                Login <span>→</span>
            </button>

        </form>

        <!-- DIVIDER -->
        <div class="divider">
            <div class="divider-text">
                Manage Your Products, Faster
            </div>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            Secure access
        </div>

    </div>

</div>

</body>
</html>