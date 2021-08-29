<?php

namespace App\Http\Livewire\SortProducts;

use App\Models\ProductPlace;
use App\Models\Shelf;
use App\Models\StoreProduct;
use App\Models\SubSector;
use ErrorException;
use Livewire\Component;

class Create extends Component
{


    public $products;
    public $main_store_id;
    public $store_id;
    public $user_id;
    public $sectors;

    // form properties
    public $product_id;
    public $sector_id;
    public $sub_sector_id;
    public $shelf_id;
    public $containers = 0;
    public $packages = 0;
    public $units = 0;


    protected $rules = [
        'product_id' => 'required',
        'sector_id' => 'required',
        'sub_sector_id' => 'nullable',
        'shelf_id' => 'nullable',
        'containers' => 'required|numeric|min:0',
        'packages' => 'required|numeric|min:0',
        'units' => 'required|numeric|min:0',
    ];


    protected $messages = [
        'product_id.required' => 'حقل المنتح مطلوب',
        'sector_id.required' => 'حقل القطاع الرئيسي مطلوب',
        'containers.required' => 'حقل عدد الحاويات مطلوب',
        'packages.required' => 'حقل عدد الرزم مطلوب',
        'units.required' => 'حقل عدد القطع مطلوب',
        'containers.min' => 'يجب أن تكون الحاويات 0 على الأقل',
        'packages.min' => 'يجب أن تكون الرزم 0 على الأقل',
        'units.min' => 'يجب أن تكون القطع 0 على الأقل',
    ];

    public function storeProductPlace()
    {
        $this->validate();

        if ($this->containers == 0 && $this->packages == 0 && $this->units == 0) {
            $this->dispatchBrowserEvent('CustomSwalAlert', [
                'type' => 'error',
                'message' => 'يجب انت تقوم بإضافة حاوية أو رزمة أو قطعة واحدة على الأقل'
            ]);

            return;
        }

        if ($this->actualTotal < $this->storedTotal){
            $this->dispatchBrowserEvent('CustomSwalAlert', [
                'type' => 'error',
                'message' => 'الكميات المدخلة أكثر من المتوفرة'
            ]);

            return;
        }

        ProductPlace::query()->create([
            'store_product_id' => $this->product_id,
            'sector_id' => $this->sector_id,
            'sub_sector_id' => $this->sub_sector_id,
            'shelf_id' => $this->shelf_id,
            'containers' => $this->containers,
            'packages' => $this->packages,
            'units' => $this->units,
        ]);

        $this->dispatchBrowserEvent('CustomSwalAlert', [
            'title' => 'نجاح',
            'type' => 'success',
            'message' => 'تمت عملية الترتيب بنجاح',
            'refresh' => true
        ]);

    }

    // computed properties
    public function getSubSectorsProperty()
    {
        return SubSector::where('sector_id', $this->sector_id)->get();
    }

    public function getShelvesProperty()
    {
        return Shelf::where('sub_sector_id', $this->sub_sector_id)->get();
    }

    public function getActualTotalProperty()
    {
        return $this->product->units_count + ($this->product->packages_count * $this->product->expected_unit) + ($this->product->actual_container * $this->product->expected_package * $this->product->expected_unit);
    }

    public function getStoredTotalProperty()
    {
        try {
            return $this->units + ($this->packages * $this->product->expected_unit) + ($this->containers * $this->product->expected_package * $this->product->expected_unit);
        } catch (ErrorException $e) {
            return 0;
        }
    }

    public function getProductProperty()
    {
        return StoreProduct::find($this->product_id);
    }

    // constructor
    public function mount($main_store_id, $store_id, $user_id, $sectors, $products)
    {
        $this->main_store_id = $main_store_id ? $main_store_id : 1;
        $this->store_id = $store_id;
        $this->user_id = $user_id;
        $this->sectors = $sectors;
        $this->products = $products;
    }

    public function render()
    {
        return view('livewire.sort-products.create');
    }
}
