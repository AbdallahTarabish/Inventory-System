<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet">

        <!--begin::Form-->
        <form class="kt-form" id="form-add">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon kt-hidden">
											<i class="la la-gear"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        تصدير منتجات للزبائن
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">&nbsp;
                            <button class="btn btn-brand btn-elevate btn-icon-sm import_btn" type="button"
                                    wire:click.prevent="exportTransactions">
                                <i class="fa fa-plus-circle"></i>
                                تصدير
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            @csrf
            <div class="kt-portlet__body">
                <div class="kt-form__section kt-form__section--first">
                    <div class="form-group row">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>المخزن</th>
                                <th>كود عملية التصدير</th>
                                <th>اسم الزبون</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td style="width: 25%">
                                    {{$this->store_id ? \App\Models\SubStore::find($this->store_id)->name : \App\Models\MainStore::find($this->main_store_id)->name}}
                                </td>
                                <td>
                                    <input type="text" readonly name="code" class="form-control"
                                           value="{{$this->export_code}}" placeholder="كود عملية التصدير">
                                </td>
                                <td>
                                    <input type="text" wire:model="customer_name" class="form-control"
                                           placeholder="اسم الزبون">
                                </td>

                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                    {{--                    <div class="d-flex justify-content-end mb-2 ">--}}
                    {{--                        <button type="button" class="btn btn-info mb-2 add_row">اضافة</button>--}}

                    {{--                    </div>--}}
                    <table class="table table-bordered product_table">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th> الحاويات المتوفرة</th>
                            <th> الرزم المتوفرة</th>
                            <th> القطع المتوفرة</th>
                            <th> عدد الزرم في الحاوية</th>
                            <th> عدد القطع في الرزمة</th>
                            <th> عدد الحاويات المصدرة</th>
                            <th> عدد الرزم المصدرة</th>
                            <th> عدد القطع المصدرة</th>
                            <th>المجموع (قطعة)</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody class="product_tbody">
                        @foreach($transactions as $key => $transaction)
                            <tr>
                                <td>{{$transaction['product_name']}}</td>
                                <td>{{$transaction['available_containers']}}</td>
                                <td>{{$transaction['available_packages']}}</td>
                                <td>{{$transaction['available_units']}}</td>
                                <td>{{$transaction['packages_in_container']}}</td>
                                <td>{{$transaction['units_in_package']}}</td>
                                <td>{{$transaction['containers']}}</td>
                                <td>{{$transaction['packages']}}</td>
                                <td>{{$transaction['units']}}</td>
                                <td>{{$transaction['exported_total']}}</td>
                                <td>
                                    <button type="button"
                                            class="btn btn-danger"
                                            wire:click.prevent="removeTransaction({{$key}})"
                                    >حذف
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @if(!$productId)
                            <tr>
                                <td colspan="11">
                                    <label for="product_select">أختر المنتج</label>
                                    <select id="product_select" class="form-control" wire:model="productId">
                                        <option value="null" selected disabled></option>
                                        @foreach($storeProducts->whereNotIn('id',$transactions->pluck('store_product_id')) as $storeProduct)
                                            <option
                                                value="{{$storeProduct->id}}">{{$storeProduct->product->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td width="15%">
                                    {{$this->product->product->name}}
                                </td>
                                <td>
                                    {{$this->product->actual_container}}
                                </td>
                                <td>
                                    {{$this->product->packages_count}}
                                </td>
                                <td>
                                    {{$this->product->units_count}}
                                </td>
                                <td>
                                    {{$this->product->expected_package}}
                                </td>
                                <td>
                                    {{$this->product->expected_unit}}
                                </td>
                                <td>
                                    <input type="number"
                                           class="form-control @error('exported_containers') is-invalid @enderror"
                                           wire:model="exported_containers">
                                    @error('exported_containers')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number"
                                           class="form-control @error('exported_packages') is-invalid @enderror"
                                           wire:model="exported_packages">
                                    @error('exported_packages')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number"
                                           class="form-control @error('exported_units') is-invalid @enderror"
                                           wire:model="exported_units">
                                    @error('exported_units')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" class="form-control" disabled value="{{$this->exportedTotal}}">
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="button" wire:click.prevent="addTransaction">
                                        أضف
                                    </button>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </form>

        <!--end::Form-->
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
    </script>
@endpush
