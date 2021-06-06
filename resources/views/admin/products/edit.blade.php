<x-admin.layout>
    <div class="az-content az-content-dashboard">
        <div class="container">
          <div class="az-content-body">
            <h2>Update Product: {{$product->product_name}}</h2>
            @can('update', $product)
              <form action="{{ route('admin.products.update', $product->id ) }}" method="POST">
                @method('PUT')
                @csrf
                Product Name: <input type="text" name="product_name" id="" class="form-control" value="{{ $product->product_name }}"><br><br>
                Product Desc: <textarea name="product_desc" id="" cols="30" rows="10" class="form-control">{{ $product->product_desc }}</textarea> <br><br>
                Price: <input type="text" name="price" id="" value="{{ $product->price }}" class="form-control"><br><br>
                Category: 
                <x-forms.select name="category_id" class="form-control">
                    <option value="0">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? "selected" : '' }} >{{ $category->name }}</option>
                    @endforeach
                </x-forms.select><br><br>
                    {{-- <select name="category_id" id="">
                        <option value="0">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select> --}}
                <input type="submit" name="submit" value="Save" class="form-control">
              </form>
            @else
              You're not authorized to update this product.
            @endcan
          </div>
        </div>
    </div>
</x-admin.layout>