@if(isset($store_import))

    <div class="col-12 my-4">
    <h3 class="mb-4">المنتجات</h3>
    <div class="table-responsive">
        <table class="table table-bordered products-table">
            <thead>
            <tr>
                <th>رقم المنتج</th>
                <th>اسم المنتج</th>
                <th>التصنيف</th>
                <th>الوحدة</th>
                <th>الرزم المتوقعة في كل حاوية</th>
                <th>القطع المتوقعة في كل رزمة</th>
                <th>الحاويات الموردة</th>
            </tr>
            </thead>
            <tbody class="tbody-product ">
                @foreach($store_import as $imports)
                    @foreach($imports->transaction as $transaction)
                        <tr>
                            <td>{{$transaction->product->reference_number}}</td>
                            <td>{{$transaction->product->name}}</td>
                            <td>{{$transaction->product->category->name}}</td>
                            <td>{{$transaction->product->unit}}</td>
                            <td>{{$transaction->expected_package}}</td>
                            <td>{{$transaction->expected_unit}}</td>
                            <td>{{$transaction->imported_container}}</td>
                        </tr>
                    @endforeach
                @endforeach

            </tbody>
        </table>
    </div>
</div>

    <div class="col-12 my-4">
        <h3 class="mb-4">اجمالي كل منتج عند التاريخ المدخل</h3>
        <div class="table-responsive">
            <table class="table table-bordered products-table">
                <thead>
                <tr>
                    <th>رقم المنتج</th>
                    <th>اسم المنتج</th>
                    <th>التصنيف</th>
                    <th>الوحدة</th>
                    <th>اجمالي الحاويات الموردة</th>
                </tr>
                </thead>
                <tbody class="tbody-product ">
                @foreach($products as $imports)
                        <tr>
                            <td>{{$imports->product->reference_number}}</td>
                            <td>{{$imports->product->name}}</td>
                            <td>{{$imports->product->category->name}}</td>
                            <td>{{$imports->product->unit}}</td>
                            <td>{{$imports->imported_container}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endif


