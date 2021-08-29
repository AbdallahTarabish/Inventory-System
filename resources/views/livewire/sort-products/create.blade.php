<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">ترتيب المنتجات في المخزن</h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <button
                            type="button"
                            class="btn btn-brand btn-elevate btn-icon-sm"
                            wire:click.prevent="storeProductPlace"
                        >
                            <i class="fa fa-plus-circle"></i> حفظ
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin::Form-->
            <form class="form">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if($errors->any())
                                <div class="alert alert-custom alert-outline-danger fade show mb-5" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">{{$errors->first()}}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-window-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" wire:ignore>
                                <label for="products">المنتج</label>
                                <select id="products" data-livewire="@this"
                                        class="form-control">
                                    <option value=""></option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->product->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group" wire:ignore>
                                <label for="sectors">القاطع الرئيسي</label>
                                <select id="sectors" data-livewire="@this"
                                        class="form-control">
                                    <option value=""></option>
                                    @foreach($sectors as $sector)
                                        <option value="{{$sector->id}}">{{$sector->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_sectors">القاطع الفرعي</label>
                                <select id="sub_sectors" wire:model="sub_sector_id"
                                        {{ $sector_id && $this->sub_sectors->count() > 0 ? "" : "disabled" }} class="form-control">
                                    <option value=""></option>
                                    @foreach($this->sub_sectors as $sub_sector)
                                        <option
                                            value="{{$sub_sector->id}}">{{str_pad($sub_sector->name, 3, 0, STR_PAD_LEFT)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shelves">الرف</label>
                                <select id="shelves" wire:model="shelf_id"
                                        {{ $sub_sector_id && $this->shelves->count() > 0 ? "" : "disabled" }}
                                        class="form-control">
                                    <option value=""></option>
                                    @foreach($this->shelves as $shelf)
                                        <option
                                            value="{{$shelf->id}}">{{str_pad($shelf->name, 3, 0, STR_PAD_LEFT)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shelves">عدد الحاويات</label>
                                <input type="number" class="form-control "
                                       wire:model="containers">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shelves">عدد الرزم</label>
                                <input type="number" class="form-control"
                                       wire:model="packages">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shelves">عدد القطع</label>
                                <input type="number" class="form-control "
                                       wire:model="units">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('CustomSwalAlert', event => {
            Swal.fire(event.detail.title ?? '', event.detail.message, event.detail.type);
            if (event.detail.title) {
                setTimeout(() => {
                    window.location.reload(1);
                }, 2300);
            }
        });

        $('#products').select2({
            placeholder: 'اختر المنتج'
        }).on('change', function (e) {
            let livewire = $(this).data('livewire')
            eval(livewire).set('product_id', $(this).val());
        });

        $('#sectors').select2({
            placeholder: 'اختر القاطع الرئيسي'
        }).on('change', function (e) {
            let livewire = $(this).data('livewire')
            eval(livewire).set('sector_id', $(this).val());
        });

    </script>
@endpush
