<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-bottom: 25px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #2563eb;
            color: white;
        }

        th,
        td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-size: 15px;
        }

        td {
            color: #444;
        }

        tbody tr:hover {
            background: #f1f5ff;
        }

        .email {
            color: #2563eb;
            text-decoration: none;
        }

        .email:hover {
            text-decoration: underline;
        }

        .username {
            font-weight: 600;
            color: #111827;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>User List</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>1</td>
                <td>Juan</td>
                <td>Dela Cruz</td>
                <td>
                    <a class="email" href="mailto:juan@example.com">
                        juan@example.com
                    </a>
                </td>
                <td class="username">juandelacruz</td>
            </tr>

            <tr>
                <td>2</td>
                <td>Maria</td>
                <td>Santos</td>
                <td>
                    <a class="email" href="mailto:maria@example.com">
                        maria@example.com
                    </a>
                </td>
                <td class="username">mariasantos</td>
            </tr>

            <tr>
                <td>3</td>
                <td>Pedro</td>
                <td>Garcia</td>
                <td>
                    <a class="email" href="mailto:pedro@example.com">
                        pedro@example.com
                    </a>
                </td>
                <td class="username">pedrogarcia</td>
            </tr>

            <tr>
                <td>4</td>
                <td>Ana</td>
                <td>Reyes</td>
                <td>
                    <a class="email" href="mailto:ana@example.com">
                        ana@example.com
                    </a>
                </td>
                <td class="username">anareyes</td>
            </tr>

            <tr>
                <td>5</td>
                <td>Jose</td>
                <td>Mendoza</td>
                <td>
                    <a class="email" href="mailto:jose@example.com">
                        jose@example.com
                    </a>
                </td>
                <td class="username">josemendoza</td>
            </tr>

        </tbody>
    </table>

</div>

</body>
</html>