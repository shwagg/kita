<?php

namespace App\Controllers;

use App\Models\LostItemModel;
use CodeIgniter\HTTP\RedirectResponse;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $items = (new LostItemModel())
            ->select('lost_items.*, reporter.full_name as reporter_name, claimer.full_name as claimer_name')
            ->join('users reporter', 'reporter.id = lost_items.reported_by', 'left')
            ->join('users claimer', 'claimer.id = lost_items.claimed_by', 'left')
            ->orderBy('lost_items.created_at', 'DESC')
            ->findAll();

        $summary = [
            'total'     => (new LostItemModel())->countAll(),
            'unclaimed' => (new LostItemModel())->where('status', 'unclaimed')->countAllResults(),
            'claimed'   => (new LostItemModel())->where('status', 'claimed')->countAllResults(),
        ];

        return view('dashboard/index', [
            'title'   => 'Dashboard',
            'items'   => $items,
            'summary' => $summary,
        ]);
    }

    public function store(): RedirectResponse
    {
        $rules = [
            'item_name'      => 'required|min_length[3]|max_length[150]',
            'description'    => 'permit_empty|max_length[1000]',
            'category'       => 'permit_empty|max_length[80]',
            'found_location' => 'required|max_length[150]',
            'found_date'     => 'required|valid_date[Y-m-d]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('dashboard'))->withInput()->with('errors', $this->validator->getErrors());
        }

        (new LostItemModel())->insert([
            'item_name'      => trim((string) $this->request->getPost('item_name')),
            'description'    => trim((string) $this->request->getPost('description')),
            'category'       => trim((string) $this->request->getPost('category')),
            'found_location' => trim((string) $this->request->getPost('found_location')),
            'found_date'     => (string) $this->request->getPost('found_date'),
            'status'         => 'unclaimed',
            'reported_by'    => (int) session('user_id'),
        ]);

        return redirect()->to(site_url('dashboard'))->with('success', 'Lost item record added.');
    }

    public function claim(int $id): RedirectResponse
    {
        $model = new LostItemModel();
        $item  = $model->find($id);

        if ($item === null) {
            return redirect()->to(site_url('dashboard'))->with('error', 'Item not found.');
        }

        if ($item['status'] === 'claimed') {
            return redirect()->to(site_url('dashboard'))->with('error', 'This item is already marked as claimed.');
        }

        $model->update($id, [
            'status'     => 'claimed',
            'claimed_by' => (int) session('user_id'),
        ]);

        return redirect()->to(site_url('dashboard'))->with('success', 'Item marked as claimed.');
    }
}
