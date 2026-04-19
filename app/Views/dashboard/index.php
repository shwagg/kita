<?= $this->extend('layouts/main') ?>

<?= $this->section('head') ?>
<style>
    :root {
        --primary: #29a302;
        --accent: #238d02;
        --bg: #eef8e9;
        --card: #ffffff;
        --line: #d7ebce;
        --text: #1c3323;
        --muted: #5d7464;
    }

    body {
        background: radial-gradient(circle at top right, #e2f4d8 0%, #eff8eb 45%, #f7fcf4 100%);
    }

    .topbar {
        background: linear-gradient(90deg, #2ea30b 0%, #238d02 100%);
        box-shadow: 0 10px 25px rgba(35, 141, 2, 0.2);
    }

    .topbar a {
        border-radius: 999px;
        padding: 8px 14px;
        background: rgba(255, 255, 255, 0.14);
        transition: background-color 0.2s ease;
    }

    .topbar a:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .container {
        max-width: 1220px;
        margin-top: 20px;
    }

    .dashboard-shell {
        display: grid;
        gap: 16px;
    }

    .hero {
        background: linear-gradient(120deg, #2ca107 0%, #249002 60%, #1f7901 100%);
        color: #fff;
        border-radius: 18px;
        padding: clamp(1.1rem, 2.6vw, 1.8rem);
        box-shadow: 0 12px 32px rgba(35, 141, 2, 0.22);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .hero h1 {
        margin: 0;
        font-size: clamp(1.3rem, 2.4vw, 1.9rem);
    }

    .hero p {
        margin: 6px 0 0;
        color: rgba(255, 255, 255, 0.92);
    }

    .hero-meta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.25);
        padding: 8px 14px;
        font-size: 13px;
        white-space: nowrap;
    }

    .summary-grid {
        display: grid;
        gap: 14px;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    }

    .summary-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 6px 18px rgba(39, 118, 20, 0.08);
    }

    .summary-card .label {
        color: var(--muted);
        font-size: 13px;
        margin-bottom: 6px;
    }

    .summary-card .value {
        font-size: 30px;
        line-height: 1;
        font-weight: 700;
        color: var(--text);
    }

    .summary-card.unclaimed .value { color: #8c6800; }
    .summary-card.claimed .value { color: #1e7e34; }

    .panel {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: clamp(1rem, 2vw, 1.25rem);
        box-shadow: 0 8px 24px rgba(40, 116, 22, 0.08);
    }

    .panel h2 {
        margin: 0 0 6px;
        font-size: 1.2rem;
        color: #1f4512;
    }

    .panel-subtitle {
        margin: 0 0 14px;
        color: var(--muted);
        font-size: 14px;
    }

    .field-grid {
        display: grid;
        gap: 12px;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
    }

    label {
        color: #315138;
        font-weight: 600;
        margin-bottom: 5px;
    }

    input, textarea, select {
        border-color: #c8ddbe;
        border-radius: 10px;
        background: #fcfffb;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    input:focus, textarea:focus, select:focus {
        outline: none;
        border-color: #29a302;
        box-shadow: 0 0 0 3px rgba(41, 163, 2, 0.14);
    }

    .field-error {
        margin-top: 4px;
        color: #a01f2d;
        font-size: 12px;
        display: inline-block;
    }

    .btn-main {
        margin-top: 12px;
        border-radius: 10px;
        padding: 11px 16px;
        background: #29a302;
        border: 1px solid #29a302;
    }

    .btn-main:hover {
        background: #238d02;
        border-color: #238d02;
    }

    .table-wrap {
        overflow: auto;
        border: 1px solid var(--line);
        border-radius: 12px;
    }

    table {
        min-width: 860px;
        background: #fff;
    }

    th {
        background: #f0f9eb;
        color: #36523e;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    td {
        color: #2c4232;
    }

    .item-desc {
        margin-top: 4px;
        color: #5e7465;
        font-size: 12px;
    }

    .status-unclaimed {
        background: #fff5d8;
        color: #916500;
    }

    .status-claimed {
        background: #e6f7de;
        color: #216f1f;
    }

    .btn-claim {
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 12px;
        background: #29a302;
        border: 1px solid #29a302;
    }

    .btn-claim:hover {
        background: #238d02;
        border-color: #238d02;
    }

    .muted-note {
        color: #5f7767;
        font-size: 12px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $errors = session('errors') ?? []; ?>

<div class="dashboard-shell">
    <section class="hero">
        <div>
            <h1>Lost and Found Dashboard</h1>
            <p>Track reports, verify details, and close claims efficiently.</p>
        </div>
        <div class="hero-meta">
            Signed in as <?= esc((string) (session('full_name') ?? 'Staff')) ?>
        </div>
    </section>

    <div class="summary-grid">
        <div class="summary-card">
            <div class="label">Total Records</div>
            <div class="value"><?= esc((string) $summary['total']) ?></div>
        </div>
        <div class="summary-card unclaimed">
            <div class="label">Unclaimed</div>
            <div class="value"><?= esc((string) $summary['unclaimed']) ?></div>
        </div>
        <div class="summary-card claimed">
            <div class="label">Claimed</div>
            <div class="value"><?= esc((string) $summary['claimed']) ?></div>
        </div>
    </div>
    <section class="panel">
        <h2>Add Found Item</h2>
        <p class="panel-subtitle">Capture key details so staff can verify and return items faster.</p>

        <form method="post" action="<?= site_url('items') ?>">
            <?= csrf_field() ?>
            <div class="field-grid">
                <div>
                    <label for="item_name">Item Name</label>
                    <input type="text" id="item_name" name="item_name" value="<?= esc(old('item_name')) ?>" required>
                    <?php if (isset($errors['item_name'])): ?>
                        <small class="field-error"><?= esc($errors['item_name']) ?></small>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" value="<?= esc(old('category')) ?>" placeholder="e.g. ID, Wallet, Gadget">
                    <?php if (isset($errors['category'])): ?>
                        <small class="field-error"><?= esc($errors['category']) ?></small>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="found_location">Found Location</label>
                    <input type="text" id="found_location" name="found_location" value="<?= esc(old('found_location')) ?>" required>
                    <?php if (isset($errors['found_location'])): ?>
                        <small class="field-error"><?= esc($errors['found_location']) ?></small>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="found_date">Found Date</label>
                    <input type="date" id="found_date" name="found_date" value="<?= esc(old('found_date') ?: date('Y-m-d')) ?>" required>
                    <?php if (isset($errors['found_date'])): ?>
                        <small class="field-error"><?= esc($errors['found_date']) ?></small>
                    <?php endif; ?>
                </div>
            </div>

            <div style="margin-top:12px;">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3" placeholder="Any identifiable details"><?= esc(old('description')) ?></textarea>
                <?php if (isset($errors['description'])): ?>
                    <small class="field-error"><?= esc($errors['description']) ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-main">Save Item</button>
        </form>
    </section>

    <section class="panel">
        <h2>Registry Records</h2>
        <p class="panel-subtitle">Latest reported items and claim progress.</p>

        <?php if (empty($items)): ?>
            <p>No items recorded yet.</p>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Found Date</th>
                            <th>Status</th>
                            <th>Reported By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($item['item_name']) ?></strong>
                                    <?php if (! empty($item['description'])): ?>
                                        <div class="item-desc"><?= esc($item['description']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc((string) $item['category']) ?></td>
                                <td><?= esc($item['found_location']) ?></td>
                                <td><?= esc($item['found_date']) ?></td>
                                <td>
                                    <span class="status-badge status-<?= esc($item['status']) ?>">
                                        <?= esc(ucfirst($item['status'])) ?>
                                    </span>
                                </td>
                                <td><?= esc((string) ($item['reporter_name'] ?? 'Unknown')) ?></td>
                                <td>
                                    <?php if ($item['status'] === 'unclaimed'): ?>
                                        <form method="post" action="<?= site_url('items/' . $item['id'] . '/claim') ?>">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-claim" type="submit">Mark Claimed</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="muted-note">Claimed by <?= esc((string) ($item['claimer_name'] ?? 'Staff')) ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    <?php endif; ?>
    </section>
</div>
<?= $this->endSection() ?>
