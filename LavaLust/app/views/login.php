<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f5ef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #174d36;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
            padding: 25px;
        }

        .login-card {
            background: #ffffff;
            border: 1px solid #e2e1da;
            border-radius: 16px;
            padding: 45px 40px 38px;
            box-shadow: 0 8px 30px rgba(7, 92, 54, 0.08);
        }

        .form-title {
            text-align: center;
            margin-bottom: 28px;
        }

        .form-title h2 {
            margin: 0;
            font-size: 27px;
            color: #075c36;
            font-weight: 700;
        }

        .form-title p {
            margin: 9px 0 0;
            font-size: 14px;
            color: #777;
        }

        .error {
            background: #fff0f0;
            border: 1px solid #e6a6a6;
            color: #a62626;
            padding: 11px 13px;
            border-radius: 7px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: bold;
            color: #174d36;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #075c36;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            height: 48px;
            border: 1px solid #d9ddd8;
            border-radius: 8px;
            background: #fff;
            padding: 0 15px 0 43px;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: 0.2s ease;
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-control:focus {
            border-color: #075c36;
            box-shadow: 0 0 0 3px rgba(7, 92, 54, 0.08);
        }

        .login-btn {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 8px;
            background: #075c36;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 5px;
            transition: 0.2s ease;
        }

        .login-btn:hover {
            background: #064a2d;
        }

        .login-btn span {
            margin-left: 5px;
            font-size: 17px;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #d9ddd8;
        }

        .divider-text {
            color: #37604e;
            font-size: 12px;
            white-space: nowrap;
        }

        .footer {
            text-align: center;
            margin-top: 23px;
            font-size: 12px;
            color: #999;
        }

        @media (max-width: 480px) {

            .login-container {
                padding: 15px;
            }

            .login-card {
                padding: 35px 25px 30px;
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

                <label for="username">
                    Username
                </label>

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

                <label for="password">
                    Password
                </label>

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