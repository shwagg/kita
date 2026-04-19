<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Binan City Hall Lost and Found') ?></title>
    <style>
        :root {
            --bg: #f4f7f9;
            --card: #ffffff;
            --text: #22313f;
            --primary: #0f5d8f;
            --accent: #f6a700;
            --danger: #bd2130;
            --success: #1e7e34;
            --line: #dbe3ea;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background: linear-gradient(180deg, #ecf3f8 0%, var(--bg) 50%, #edf1f5 100%);
        }

        .topbar {
            background: var(--primary);
            color: #fff;
            padding: 14px 20px;
            display: flex;
            gap: 12px;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .topbar a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .container {
            max-width: 1100px;
            margin: 24px auto;
            padding: 0 16px 32px;
        }

        .layout-full {
            width: 100%;
            max-width: none;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            min-height: 100dvh;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 16px;
            box-shadow: 0 8px 20px rgba(15, 93, 143, 0.08);
        }

        .alert {
            padding: 12px;
            margin-bottom: 16px;
            border-radius: 8px;
            border: 1px solid transparent;
        }

        .alert-success {
            background: #e8f7ec;
            border-color: #bde5c9;
            color: var(--success);
        }

        .alert-error {
            background: #fdecef;
            border-color: #f7c2ca;
            color: var(--danger);
        }

        .btn {
            border: 0;
            border-radius: 8px;
            padding: 10px 14px;
            cursor: pointer;
            font-weight: 600;
            background: var(--primary);
            color: #fff;
        }

        .btn-secondary {
            background: var(--accent);
            color: #352400;
        }

        .form-row {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #bcc9d3;
            border-radius: 8px;
            font: inherit;
            background: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid var(--line);
            text-align: left;
            vertical-align: top;
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-unclaimed { background: #fff5e0; color: #8a6100; }
        .status-claimed { background: #e8f7ec; color: #1e7e34; }

        @media (max-width: 768px) {
            .container { margin-top: 16px; }
        }
    </style>
    <?= $this->renderSection('head') ?>
</head>
<body>
    <?php
    $hideTopbar = trim((string) $this->renderSection('hideTopbar')) === '1';
    $fullWidth = trim((string) $this->renderSection('fullWidth')) === '1';
    ?>

    <?php if (!$hideTopbar): ?>
        <div class="topbar">
            <div>
                <strong>Binan City Hall</strong>
                <span>Lost and Found Registry</span>
            </div>
            <div>
                <?php if (session()->get('isLoggedIn')): ?>
                    <span><?= esc((string) session('full_name')) ?></span>
                    <a href="<?= site_url('logout') ?>" style="margin-left:12px;">Logout</a>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>">Login</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <main class="<?= $fullWidth ? 'layout-full' : 'container' ?>">
        <?php if (!$fullWidth && session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= esc((string) session()->getFlashdata('success')) ?></div>
        <?php endif; ?>

        <?php if (!$fullWidth && session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= esc((string) session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
