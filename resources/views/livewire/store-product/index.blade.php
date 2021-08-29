<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    منتجات المخزن
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length">
                        <label for="perPage">
                            <select id="perPage" wire:model="perPage" name="kt_table_1_length"
                                    class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select></label></div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div id="kt_table_1_filter" class="dataTables_filter float-right">
                        <label>
                            <input type="search" wire:model.debounce.500ms="search" class="form-control form-control-sm"
                                   placeholder="بحث"
                            ></label>
                    </div>
                </div>
            </div>
            <!--begin: Datatable -->
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>الرقم المرجعي</th>
                            <th>الاسم</th>
                            <th>الحاويات المتوفرة</th>
                            <th>الرزم المتوفرة</th>
                            <th>القطع المتوفرة</th>
                            <th>عدد الرزم في الحاوية</th>
                            <th>عدد القطع في الرزمة</th>
                            <th>المكان</th>
                            <th>الحاويات</th>
                            <th>الرزم</th>
                            <th>القطع</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->product->reference_number}}</td>
                                <td>{{$product->product->name}}</td>
                                <td>{{$product->actual_container}}</td>
                                <td>{{$product->packages_count}}</td>
                                <td>{{$product->units_count}}</td>
                                <td>{{$product->expected_package}}</td>
                                <td>{{$product->expected_unit}}</td>
                                <td style="padding: 0px" colspan="4">
                                    @foreach($product->places as $place)
                                        <table style="width: 100%">
                                            <tr>
                                                <td>{{$place->sector->name}}
                                                    - {{str_pad($place->subSector->name, 3, 0, STR_PAD_LEFT)}}
                                                    - {{str_pad($place->shelf->name, 3, 0, STR_PAD_LEFT)}}</td>
                                                <td>{{$place->containers}}</td>
                                                <td>{{$place->packages}}</td>
                                                <td>{{$place->units}}</td>
                                            </tr>
                                        </table>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" role="status" aria-live="polite">
                        إظهار {{$products->firstItem()}} إلى {{$products->lastItem()}}
                        من أصل {{$products->total()}}
                    </div>
                </div>

                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers float-right">
                        {{$products->onEachSide(3)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
