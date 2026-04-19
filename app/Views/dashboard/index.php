<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div style="display:grid; gap:16px; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); margin-bottom:16px;">
    <div class="card">
        <div style="font-size:13px; color:#5c6b77;">Total Records</div>
        <div style="font-size:28px; font-weight:700;"><?= esc((string) $summary['total']) ?></div>
    </div>
    <div class="card">
        <div style="font-size:13px; color:#5c6b77;">Unclaimed</div>
        <div style="font-size:28px; font-weight:700; color:#8a6100;"><?= esc((string) $summary['unclaimed']) ?></div>
    </div>
    <div class="card">
        <div style="font-size:13px; color:#5c6b77;">Claimed</div>
        <div style="font-size:28px; font-weight:700; color:#1e7e34;"><?= esc((string) $summary['claimed']) ?></div>
    </div>
</div>

<div class="card" style="margin-bottom:16px;">
    <h2 style="margin-top:0;">Add Found Item</h2>

    <?php $errors = session('errors') ?? []; ?>

    <form method="post" action="<?= site_url('items') ?>">
        <?= csrf_field() ?>
        <div class="form-row">
            <div>
                <label for="item_name">Item Name</label>
                <input type="text" id="item_name" name="item_name" value="<?= esc(old('item_name')) ?>" required>
                <?php if (isset($errors['item_name'])): ?>
                    <small style="color:#bd2130;"><?= esc($errors['item_name']) ?></small>
                <?php endif; ?>
            </div>
            <div>
                <label for="category">Category</label>
                <input type="text" id="category" name="category" value="<?= esc(old('category')) ?>" placeholder="e.g. ID, Wallet, Gadget">
                <?php if (isset($errors['category'])): ?>
                    <small style="color:#bd2130;"><?= esc($errors['category']) ?></small>
                <?php endif; ?>
            </div>
            <div>
                <label for="found_location">Found Location</label>
                <input type="text" id="found_location" name="found_location" value="<?= esc(old('found_location')) ?>" required>
                <?php if (isset($errors['found_location'])): ?>
                    <small style="color:#bd2130;"><?= esc($errors['found_location']) ?></small>
                <?php endif; ?>
            </div>
            <div>
                <label for="found_date">Found Date</label>
                <input type="date" id="found_date" name="found_date" value="<?= esc(old('found_date') ?: date('Y-m-d')) ?>" required>
                <?php if (isset($errors['found_date'])): ?>
                    <small style="color:#bd2130;"><?= esc($errors['found_date']) ?></small>
                <?php endif; ?>
            </div>
        </div>

        <div style="margin-top:12px;">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3" placeholder="Any identifiable details"><?= esc(old('description')) ?></textarea>
            <?php if (isset($errors['description'])): ?>
                <small style="color:#bd2130;"><?= esc($errors['description']) ?></small>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn" style="margin-top:12px;">Save Item</button>
    </form>
</div>

<div class="card">
    <h2 style="margin-top:0;">Registry Records</h2>

    <?php if (empty($items)): ?>
        <p>No items recorded yet.</p>
    <?php else: ?>
        <div style="overflow:auto;">
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
                                    <div style="font-size:12px; color:#5c6b77;"><?= esc($item['description']) ?></div>
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
                                        <button class="btn btn-secondary" type="submit">Mark Claimed</button>
                                    </form>
                                <?php else: ?>
                                    <span style="font-size:12px; color:#5c6b77;">Claimed by <?= esc((string) ($item['claimer_name'] ?? 'Staff')) ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
