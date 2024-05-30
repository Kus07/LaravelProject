<x-dashboardNavbar />


<section class="bar">
    <div class="bar-frame">
        <ul class="breadcrumbs">
            <li><a href="javascript:history.back()">Back</a></li>
            <li>
                Details
            </li>
        </ul>
    </div>
</section>
<br>
@if(session('success'))
        <div style="color:green" class="alert alert-success" role="alert">
            <br>{{ session('success') }} <br>
        </div>
    @endif

    @if(session('error'))
        <div style="color:red" class="alert alert-danger" role="alert">
            <br>{{ session('error') }} <br>
        </div>
    @endif

    @if (!$errors->isEmpty())
        <div style="color:red" class="alert alert-danger" style="border-radius: 0;" role="alert">
            <br>{{ $errors->first() }} <br>
        </div>
    @endif
<section id="main">
    <div class="details-info">
        <div class="image">
            <img src="{{ $product->productImage }}" alt="{{ $product->productName }}" />
        </div>
        <div class="description">
            <div class="head">
                <h1 class="title">
                    {{ $product->productName }}
                    @if ($product->user_id == session('user_id'))
                        - ({{ $product->status }})
                    @endif
                </h1>
                <p>{{ $product->productDescription }}</p><br>
                <p>Available left: {{ $product->quantity }}</p><br>
                <h2>${{ $product->price }}</h2>
            </div>
            <div class="section">
                <form class="form-sort" action="{{ route('cartAdd', $product->id) }}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="row">
                            <label for="quantity">Quantity:</label>
                            <input style="height: 30px; padding-left: 20px" type="number" id="quantity" name="quantity" min="1" max="{{ $product->quantity }}" value="1">
                        </div>
                        <button type="submit" class="btn black normal">Add to cart</button>
                    </fieldset>
                </form>
            </div>
            <div class="entry">
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
</section>


</div>
<x-dashboardFooter />
