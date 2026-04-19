<?= $this->extend('layouts/main') ?>

<?= $this->section('hideTopbar') ?>1<?= $this->endSection() ?>
<?= $this->section('fullWidth') ?>1<?= $this->endSection() ?>

<?= $this->section('head') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    margin: 0;
    min-height: 100vh;
    min-height: 100dvh;
    background: linear-gradient(135deg, #eaf7e4 0%, #f6fcf2 48%, #e2f3da 100%);
}

.login-page {
    min-height: 100vh;
    min-height: 100dvh;
}

.hero-panel {
    background: linear-gradient(155deg, #f1faed 0%, #d9efcd 100%);
    color: #5f6a72;
    display: flex;
    align-items: center;
    padding: clamp(2rem, 6vw, 5rem);
}

.hero-content {
    max-width: 440px;
}

.brand-script {
    font-family: "Brush Script MT", "Segoe Script", "Lucida Handwriting", cursive;
    font-size: clamp(3rem, 8vw, 6rem);
    line-height: 1;
    font-weight: 500;
    letter-spacing: 1px;
    color: #6a6a6a;
    margin-bottom: 1rem;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
}

.hero-content p {
    font-size: clamp(1rem, 1.8vw, 1.25rem);
    line-height: 1.5;
    margin-bottom: 2rem;
    opacity: 1;
    color: #49606d;
}

.read-btn {
    border-radius: 999px;
    padding: 0.65rem 1.6rem;
    font-weight: 600;
    background: #29a302;
    border: 1px solid #29a302;
    color: #fff;
}

.read-btn:hover,
.read-btn:focus {
    background: #238d02;
    border-color: #238d02;
    color: #fff;
}

.auth-panel {
    background: #f8fcf6;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: clamp(1.5rem, 5vw, 4rem);
}

.auth-content {
    width: 100%;
    max-width: 430px;
}

.auth-content h2 {
    font-size: clamp(1.8rem, 3vw, 2.2rem);
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #1e7c01;
}

.form-control {
    border-radius: 999px;
    padding: 0.8rem 1.1rem;
    border-color: #bdd9b2;
}

.form-control:focus {
    border-color: #29a302;
    box-shadow: 0 0 0 0.2rem rgba(41, 163, 2, 0.2);
}

.btn-login {
    border-radius: 999px;
    padding: 0.8rem 1rem;
    font-weight: 700;
    font-size: 1.05rem;
    background: #29a302;
    border-color: #29a302;
}

.btn-login:hover,
.btn-login:focus {
    background: #238d02;
    border-color: #238d02;
}

.form-note {
    font-size: 0.85rem;
}

@media (max-width: 991.98px) {
    .hero-panel {
        display: none;
    }

    .auth-panel {
        min-height: 100vh;
        min-height: 100dvh;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $errors = session('errors') ?? []; ?>

<div class="container-fluid login-page">
    <div class="row g-0 login-page">
        <div class="col-lg-7 hero-panel">
            <div class="hero-content">
                <h1 class="brand-script">Binan City</h1>
                <p>Lost and Found Registry</p>
                <button class="btn read-btn" type="button">Read More</button>
            </div>
        </div>

        <div class="col-12 col-lg-5 auth-panel">
            <div class="auth-content">
                <h2>Hello Again!</h2>
                <p class="text-secondary mb-4">Welcome Back</p>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger py-2 small"><?= esc((string) session()->getFlashdata('error')) ?></div>
                <?php endif; ?>

                <form method="post" action="<?= site_url('login') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <input
                            type="text"
                            name="username"
                            class="form-control<?= isset($errors['username']) ? ' is-invalid' : '' ?>"
                            placeholder="Username"
                            value="<?= esc(old('username')) ?>"
                            required
                        >
                        <?php if (isset($errors['username'])): ?>
                            <div class="invalid-feedback d-block ms-2"><?= esc($errors['username']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <input
                            type="password"
                            name="password"
                            class="form-control<?= isset($errors['password']) ? ' is-invalid' : '' ?>"
                            placeholder="Password"
                            required
                        >
                        <?php if (isset($errors['password'])): ?>
                            <div class="invalid-feedback d-block ms-2"><?= esc($errors['password']) ?></div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-login">Login</button>
                </form>

                <div class="text-center mt-3">
                    <a href="#" class="small text-muted text-decoration-none">Forgot Password?</a>
                </div>

                <p class="text-muted mt-4 mb-0 form-note">
                    Demo admin account: username <strong>admin</strong>, password <strong>admin123</strong>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
