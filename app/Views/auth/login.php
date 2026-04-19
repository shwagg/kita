<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card" style="max-width: 460px; margin: 20px auto;">
    <h1 style="margin-top:0;">Staff Login</h1>
    <p style="margin-top:0;">Use your assigned account to access the registry dashboard.</p>

    <?php $errors = session('errors') ?? []; ?>

    <form method="post" action="<?= site_url('login') ?>">
        <?= csrf_field() ?>

        <div style="margin-bottom:12px;">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= esc(old('username')) ?>" required>
            <?php if (isset($errors['username'])): ?>
                <small style="color:#bd2130;"><?= esc($errors['username']) ?></small>
            <?php endif; ?>
        </div>

        <div style="margin-bottom:12px;">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <?php if (isset($errors['password'])): ?>
                <small style="color:#bd2130;"><?= esc($errors['password']) ?></small>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn" style="width:100%;">Login</button>
    </form>

    <p style="margin-top:12px; font-size:13px; color:#5c6b77;">
        Demo admin account after seeding: username <strong>admin</strong>, password <strong>admin123</strong>
    </p>
</div>
<?= $this->endSection() ?>
