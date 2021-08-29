@if(isset($product_report))
    <div class="col-12 my-4">
    <h3 class="mb-4">توريدات المنتج</h3>
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
            <tbody class="tbody-product">
            @php $sum=0 @endphp
                @foreach($product_report as $product)
                    @foreach($product->transaction as $transaction)

                        <div style="display: none"> {{$sum+= $transaction->imported_container }}
                        </div>
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
                <tr><td colspan="5"></td><td>الاجمالي</td><td>{{$sum }}</td></tr>

            </tbody>
        </table>
    </div>
</div>



@endif


