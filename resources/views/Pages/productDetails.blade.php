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
<section id="main">
    <div class="details-info">
        <div class="image">
            <img src="{{ $product->productImage }}" alt="{{ $product->productName }}" />
        </div>
        <div class="description">
            <div class="head">
                <h1 class="title">{{ $product->productName }}</h1>
                <h2>${{ $product->price }}</h2>
            </div>
            <div class="section">
                <form class="form-sort" action="{{ route('cartAdd', $product->id) }}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="row">
                            <label for="quantity">Quantity:</label>
                            <select id="quantity" name="quantity">
                                @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
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
