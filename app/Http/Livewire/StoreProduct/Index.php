<?php

namespace App\Http\Livewire\StoreProduct;

use App\Models\MainStore;
use App\Models\Sector;
use App\Models\StoreProduct;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public $search;
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $products = collect([]);
        $main_store_id = auth()->user()->main_store_id;
        $sub_store_id = auth()->user()->sub_store_id;

        if (!empty($sub_store_id)) {

            $products = StoreProduct::where('store_id', $sub_store_id);

        } else if (!empty($main_store_id) && empty($sub_store_id)) {

            $products = StoreProduct::where('main_store_id', $main_store_id);

        } else if (empty($main_store_id) && empty($sub_store_id)) {

            $products = StoreProduct::where('main_store_id', MainStore::query()->first()->id);

        }

        return view('livewire.store-product.index', [
            'products' => $products
                ->whereHas('product', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('reference_number', $this->search);
                })
                ->paginate($this->perPage)
        ]);
    }
}
