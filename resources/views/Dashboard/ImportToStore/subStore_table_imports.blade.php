@foreach($products as $product)
    <tr class="product_tr">
        <td>
            <label class="kt-checkbox kt-checkbox--brand item_checkbox">
                <input type="checkbox" value="{{$product->id}}"
                       class="item_checkbox"
                       name="checked_product[]">
                <span></span>
            </label>
        </td>
        <td style="width: 120px">{{ $product->name }}</td>
        <td style="width: 120px">
            {{ $product->category->name }}
        </td>
        <td style="width: 120px"> {{ $product->supplier->name }}</td>
        <td style="width: 120px">
            {{ $product->manufacturer }}

        </td>
        <td>
            {{ $product->unit }}
        </td>
        <td>
            <input type="text" name="{{$product->id}}[imported_container]"
                   value="{{ calc_mean_value($product->quantity->max_container , $product->quantity->min_container)  }}"
                   class="form-control text-center custom-input actual_container aa">
        </td>
        <td>
            <input type="text"
                   name="{{$product->id}}[imported_package]"
                   value="{{ calc_mean_value($product->quantity->max_package , $product->quantity->min_package)  }}"
                   class="form-control text-center custom-input actual_package">
            <input type="hidden" name="{{$product->id}}[product_id]"
                   value="{{$product->id}}"
                   class="form-control text-center  ">
        </td>

        <td>
            <input type="text"
                   name="{{$product->id}}[imported_unit]"
                   value="{{ calc_mean_value($product->quantity->max_unit , $product->quantity->min_unit)  }}"
                   class="form-control text-center custom-input actual_unit">
        </td>

        @endforeach
    </tr>



