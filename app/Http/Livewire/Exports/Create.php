<?php

namespace App\Http\Livewire\Exports;

use App\Models\Export;
use App\Models\ExportTransaction;
use App\Models\StoreProduct;
use ErrorException;
use Livewire\Component;

class Create extends Component
{
    public $storeProducts;
    public $export_code;
    public $main_store_id;
    public $store_id;
    public $user_id;
    public $customer_name;

    public $productId;
    public $exported_containers = 0;
    public $exported_packages = 0;
    public $exported_units = 0;
    public $transactions;

    protected $listeners = ['refreshExports' => '$refresh'];

    // validation
    protected $rules = [
        'customer_name' => 'nullable|string',
        'exported_containers' => 'required|numeric|min:0',
        'exported_packages' => 'required|numeric|min:0',
        'exported_units' => 'required|numeric|min:0',
    ];

    protected $messages = [
        'exported_containers.required' => 'حقل الحاويات المُصدرة مطلوب',
        'exported_packages.required' => 'حقل الرزم المُصدرة مطلوب',
        'exported_units.required' => 'حقل القطع المُصدرة مطلوب',
        'exported_containers.min' => 'يجب أن تكون الحاويات المصدرة 0 على الأقل',
        'exported_packages.min' => 'يجب أن تكون الرزم المصدرة 0 على الأقل',
        'exported_units.min' => 'يجب أن تكون القطع المصدرة 0 على الأقل',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function exportTransactions()
    {
        $this->validateOnly('customer_name');

        if ($this->transactions->count() < 1) {
            if ($this->exported_containers < 1 && $this->exported_packages < 1 && $this->exported_units < 1) {
                $this->dispatchBrowserEvent('CustomSwalAlert', [
                    'type' => 'error',
                    'message' => 'يجب أن تقوم بتصدير منتج واحد على الأقل'
                ]);

                return;
            }
        }

        $export = Export::query()->create([
            'export_code' => $this->export_code,
            'main_store_id' => $this->main_store_id,
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'customer_name' => $this->customer_name
        ]);

        foreach ($this->transactions as $transaction) {

            $storeProduct = StoreProduct::find($transaction['store_product_id']);

            if ($storeProduct->actual_container && $storeProduct->packages_count && $storeProduct->units_count) {
                $this->dispatchBrowserEvent('CustomSwalAlert', [
                    'type' => 'error',
                    'message' => "لا يوجد كميات متوفرة من هذا المنتج (" . $storeProduct->product->name . ")"
                ]);

                return;
            }

            // check containers
            if ($transaction['containers'] > 0) {

                $storeProduct->actual_container = $storeProduct->actual_container - $transaction['containers'];

            }

            // check packages
            if ($transaction['packages'] > 0) {

                while ($transaction['packages'] > $storeProduct->packages_count) {
                    $storeProduct->actual_container = $storeProduct->actual_container - 1;
                    $storeProduct->packages_count = $storeProduct->packages_count + $storeProduct->expected_package;
                }

                $storeProduct->packages_count = $storeProduct->packages_count - $transaction['packages'];

            }

            // check units
            if ($transaction['units'] > 0) {
                while ($transaction['units'] > $storeProduct->units_count) {
                    if ($storeProduct->packages_count < 1) {
                        $storeProduct->actual_container = $storeProduct->actual_container - 1;
                        $storeProduct->packages_count = $storeProduct->packages_count + $storeProduct->expected_package;
                    }
                    $storeProduct->packages_count = $storeProduct->packages_count - 1;
                    $storeProduct->units_count = $storeProduct->units_count + $storeProduct->expected_unit;
                }
                $storeProduct->units_count = $storeProduct->units_count - $transaction['units'];
            }

            $storeProduct->save();

            ExportTransaction::create([
                'product_id' => $transaction['product_id'],
                'export_id' => $export->id,
                'containers' => $transaction['containers'],
                'packages' => $transaction['packages'],
                'units' => $transaction['units'],
                'packages_in_container' => $transaction['packages_in_container'],
                'units_in_package' => $transaction['units_in_package'],
                'total_units' => $transaction['exported_total']
            ]);
        }

        $this->dispatchBrowserEvent('CustomSwalAlert', [
            'title' => 'نجاح',
            'type' => 'success',
            'message' => 'تمت عملية التصدير بنجاح',
            'refresh' => true
        ]);

    }

    // add and remove transactions
    public function addTransaction()
    {

        $this->validate();

        if ($this->exported_containers < 1 && $this->exported_packages < 1 && $this->exported_units < 1) {
            $this->dispatchBrowserEvent('CustomSwalAlert', [
                'type' => 'error',
                'message' => 'يجب أن تكون الحاويات او الرزم او القطع المصدرة تساوي 1 على الأقل'
            ]);

            return;
        }

        if ($this->actualTotal < $this->exportedTotal) {
            $this->dispatchBrowserEvent('CustomSwalAlert', [
                'type' => 'error',
                'message' => 'الكميات المدخلة أكثر من المتوفرة'
            ]);

            return;
        }

        $this->transactions->push([
            'store_product_id' => $this->product->id,
            'product_id' => $this->product->product->id,
            'product_name' => $this->product->product->name,
            'available_containers' => $this->product->actual_container,
            'available_packages' => $this->product->packages_count,
            'available_units' => $this->product->units_count,
            'containers' => $this->exported_containers,
            'packages' => $this->exported_packages,
            'units' => $this->exported_units,
            'packages_in_container' => $this->product->expected_package,
            'units_in_package' => $this->product->expected_unit,
            'exported_total' => $this->exportedTotal,
            'actual_total' => $this->actualTotal
        ]);

        $this->productId = null;
        $this->exported_containers = 0;
        $this->exported_packages = 0;
        $this->exported_units = 0;

    }

    public function removeTransaction($index)
    {
        $this->transactions->pull($index);
    }


    // computed properties
    public function getActualTotalProperty()
    {
        return $this->product->units_count + ($this->product->packages_count * $this->product->expected_unit) + ($this->product->actual_container * $this->product->expected_package * $this->product->expected_unit);
    }

    public function getExportedTotalProperty()
    {
        try {
            return $this->exported_units + ($this->exported_packages * $this->product->expected_unit) + ($this->exported_containers * $this->product->expected_package * $this->product->expected_unit);
        } catch (ErrorException $e) {
            return 0;
        }
    }

    public function getProductProperty()
    {
        return StoreProduct::find($this->productId);
    }


    // constructor
    public function mount($products, $export_code, $main_store_id, $store_id, $user_id)
    {
        $this->storeProducts = $products;
        $this->export_code = str_pad($export_code, 10, 0, STR_PAD_LEFT);
        $this->main_store_id = $main_store_id ? $main_store_id : 1;
        $this->store_id = $store_id;
        $this->user_id = $user_id;

        $this->transactions = collect([]);
    }

    public function render()
    {
        return view('livewire.exports.create');
    }
}
