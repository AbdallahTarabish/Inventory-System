<?php

namespace App\Http\Livewire\CustomerOrders;

use App\Models\CustomerOrder;
use App\Models\CustomerOrderProducts;
use App\Models\StoreProduct;
use ErrorException;
use Livewire\Component;

class Create extends Component
{

    public $storeProducts;
    public $order_code;
    public $main_store_id;
    public $store_id;
    public $user_id;
    public $customer_name;

    public $productId;
    public $ordered_containers = 0;
    public $ordered_packages = 0;
    public $ordered_units = 0;
    public $transactions;

    protected $listeners = ['refreshExports' => '$refresh'];

    // validation
    protected $rules = [
        'customer_name' => 'required|string',
        'ordered_containers' => 'required|numeric|min:0',
        'ordered_packages' => 'required|numeric|min:0',
        'ordered_units' => 'required|numeric|min:0',
    ];

    protected $messages = [
        'customer_name.required' => 'حقل اسم الزبون مطلوب',
        'ordered_containers.required' => 'حقل الحاويات المطلوبة مطلوب',
        'ordered_packages.required' => 'حقل الرزم المطلوبة مطلوب',
        'ordered_units.required' => 'حقل القطع المطلوبة مطلوب',
        'ordered_containers.min' => 'يجب أن تكون الحاويات المطلوبة 0 على الأقل',
        'ordered_packages.min' => 'يجب أن تكون الرزم المطلوبة 0 على الأقل',
        'ordered_units.min' => 'يجب أن تكون القطع المطلوبة 0 على الأقل',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function orderTransactions()
    {
        $this->validateOnly('customer_name');

        if ($this->transactions->count() < 1) {
            if ($this->ordered_containers < 1 && $this->ordered_packages < 1 && $this->ordered_units < 1) {
                $this->dispatchBrowserEvent('CustomSwalAlert', [
                    'type' => 'error',
                    'message' => 'يجب أن تقوم بطلب منتج واحد على الأقل'
                ]);

                return;
            }
        }

        $order = CustomerOrder::query()->create([
            'order_code' => $this->order_code,
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

            CustomerOrderProducts::create([
                'product_id' => $transaction['product_id'],
                'order_id' => $order->id,
                'containers' => $transaction['containers'],
                'packages' => $transaction['packages'],
                'units' => $transaction['units'],
                'packages_in_container' => $transaction['packages_in_container'],
                'units_in_package' => $transaction['units_in_package'],
                'total_units' => $transaction['ordered_total']
            ]);
        }

        $this->dispatchBrowserEvent('CustomSwalAlert', [
            'title' => 'نجاح',
            'type' => 'success',
            'message' => 'تمت حفظ الطلب بنجاح',
            'refresh' => true
        ]);

    }

    // add and remove transactions
    public function addTransaction()
    {

        $this->validate();

        if ($this->ordered_containers < 1 && $this->ordered_packages < 1 && $this->ordered_units < 1) {
            $this->dispatchBrowserEvent('CustomSwalAlert', [
                'type' => 'error',
                'message' => 'يجب أن تكون الحاويات او الرزم او القطع المطلوبة تساوي 1 على الأقل'
            ]);

            return;
        }

        if ($this->actualTotal < $this->orderedTotal) {
            $this->dispatchBrowserEvent('CustomSwalAlert', [
                'type' => 'error',
                'message' => 'الكميات المدخلة أكثر من المتوفرة'
            ]);

            return;
        }

        if ($this->actualTotal == $this->orderedTotal) {
            $this->dispatchBrowserEvent('CustomSwalAlert', [
                'type' => 'warning',
                'message' => 'الكميات المدخلة تساوي الكميات المتوفرة عليك الحذر'
            ]);
        }

        $this->transactions->push([
            'store_product_id' => $this->product->id,
            'product_id' => $this->product->product->id,
            'product_name' => $this->product->product->name,
            'available_containers' => $this->product->actual_container,
            'available_packages' => $this->product->packages_count,
            'available_units' => $this->product->units_count,
            'containers' => $this->ordered_containers,
            'packages' => $this->ordered_packages,
            'units' => $this->ordered_units,
            'packages_in_container' => $this->product->expected_package,
            'units_in_package' => $this->product->expected_unit,
            'ordered_total' => $this->orderedTotal,
            'actual_total' => $this->actualTotal
        ]);

        $this->productId = null;
        $this->ordered_containers = 0;
        $this->ordered_packages = 0;
        $this->ordered_units = 0;

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

    public function getOrderedTotalProperty()
    {
        try {
            return $this->ordered_units + ($this->ordered_packages * $this->product->expected_unit) + ($this->ordered_containers * $this->product->expected_package * $this->product->expected_unit);
        } catch (ErrorException $e) {
            return 0;
        }
    }

    public function getProductProperty()
    {
        return StoreProduct::find($this->productId);
    }


    // constructor
    public function mount($products, $order_code, $main_store_id, $store_id, $user_id)
    {
        $this->storeProducts = $products;
        $this->order_code = str_pad($order_code, 10, 0, STR_PAD_LEFT);
        $this->main_store_id = $main_store_id ? $main_store_id : 1;
        $this->store_id = $store_id;
        $this->user_id = $user_id;

        $this->transactions = collect([]);
    }

    public function render()
    {
        return view('livewire.customer-orders.create');
    }
}
