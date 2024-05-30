@include('templates.header')
<x-dashboardNavbar />

<?php
use Illuminate\Support\Facades\Session;
?>

<section class="bar">
    <div class="bar-frame">
        <ul class="breadcrumbs">
            <li><a href="/myProducts">Back</a></li>
            <li>
                Edit Products
            </li>
        </ul>
    </div>
</section>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (!$errors->isEmpty())
        <div class="alert alert-danger" style="border-radius: 0;" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <br>

    <h2 class="text-center">Edit Products</h2>
<form action="{{ route('updateProducts', $product->id) }}" method="post" class="form-group" style="width: 70%; margin: 0 auto;" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->productName) }}">
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description">{{ old('description', $product->productDescription) }}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}">
        </div>
        <div class="form-group col-md-6">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0.01">
        </div>
    </div>

    <div class="form-group row" style="padding-top: 10px">
        <div class="col-md-3">
            <label for="category_id">Category:</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">Select a category</option>
                <option value="1" {{ old('category_id', $product->category_id) == 1 ? 'selected' : '' }}>Coats</option>
                <option value="2" {{ old('category_id', $product->category_id) == 2 ? 'selected' : '' }}>Suits</option>
                <option value="3" {{ old('category_id', $product->category_id) == 3 ? 'selected' : '' }}>Jackets</option>
                <option value="4" {{ old('category_id', $product->category_id) == 4 ? 'selected' : '' }}>Shirts</option>
                <option value="5" {{ old('category_id', $product->category_id) == 5 ? 'selected' : '' }}>Shoes</option>
            </select>
        </div>
    </div>

    <div class="form-group row" style="padding-top: 10px">
        <div class="col-md-12">
            <label for="productImage">Uploaded Image:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="productImage" name="productImage" onchange="updateFileLabel(this)">
                <label class="custom-file-label" for="image">{{ basename($product->productImage ?? 'Choose file') }}</label>
            </div>
        </div>
    </div>

    <script>
        function updateFileLabel(input) {
            var fileName = input.files[0] ? input.files[0].name : 'Choose file';
            $(input).next('.custom-file-label').addClass("selected").html(fileName);
        }
        </script>

    <br>

    <div class="text-center d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
<br>

</div>
</div>
<x-dashboardFooter />
