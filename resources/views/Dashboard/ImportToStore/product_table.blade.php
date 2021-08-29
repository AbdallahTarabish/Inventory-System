
    <tr>
        <td>{{$product->reference_number}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->category->name}}</td>
        <td>{{$product->unit}}</td>
        <td>{{$product->quantity->max_package}}</td>
        <td>{{$product->quantity->max_unit}}</td>
        <td><input type="text" class="form-control" name="{{$product->id}}[ordered_container]" ></td>
        <input type="hidden"  name="store_id" value=" @if(auth()->user()->sub_store) {{ auth()->user()->sub_store->id }} @elseif(auth()->user()->main_store) {{auth()->user()->main_store->id}} @else {{null}} @endif">
        <input type="hidden"  name="{{$product->id}}[product_id]" value="{{$product->id}}">

    </tr>



