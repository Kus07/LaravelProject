<x-dashboardNavbar />


        </header>
        <section class="bar">
            <div class="bar-frame">
                <ul class="breadcrumbs">
                    <li><a href="/dashboard">Home</a></li>
                    <li><a href="javascript:history.back()">Back</a></li>
                    <li>Cart</li>
                </ul>
            </div>
        </section>
        <section id="main">
            <ul class="list-table">
                @if(session('success'))
            <div style="color:green" class="alert alert-success" role="alert">
                <br>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="color:red" class="alert alert-danger" role="alert">
                <br>{{ session('error') }}
            </div>
        @endif

        @if (!$errors->isEmpty())
            <div style="color:red" class="alert alert-danger" style="border-radius: 0;" role="alert">
                <br>{{ $errors->first() }}
            </div>
        @endif
                @foreach ($cartItems as $cartItem)
<li>
    <div class="rows rows-item">

        <img src="{{ asset($cartItem->product->productImage) }}" alt="{{ $cartItem->product->productName }}" height="99" width="99" alt="{{ $cartItem->product->name }}">
        <h3>{{ $cartItem->product->productName }}</h3>
    </div>
    <div class="rows-holder">
        <div class="rows rows-select">
            <div class="row">
                <label for="quantity">Quantity: {{ $cartItem->quantity }}</label>
            </div>
        </div>
        <div class="rows rows-price">
            <span>${{ $cartItem->product->price * $cartItem->quantity }}</span>
        </div>
        <div class="rows rows-delete">
            <form action="{{ route('cartRemove', $cartItem) }}" method="POST">
                @csrf
                <button type="submit" class="btn-delete">delete</button>
            </form>
        </div>
    </div>
</li>
@endforeach
            </ul>

        <form action="/addOrder" class="form-payment" method="POST">
            @csrf
            <fieldset>
                <div class="column">
                    <h2>Delivery address:</h2>
                    <div class="row">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" placeholder="" />
                    </div>
                    <div class="row">
                        <label for="street">Street:</label>
                        <input type="text" id="street" name="street" placeholder="" />
                    </div>
                    <div class="row">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" placeholder="" />
                    </div>
                    <div class="row">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" placeholder="" />
                    </div>
                    <div class="row">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" value="{{ session('user_email') }}" />
                    </div>
                </div>
                <div class="column column-add">
                    <h2>Payment method:</h2>
                    <ul class="pay-list">
                        <li class="paypal">
                            <div class="pay-holder">
                                <p>Paypal</p>
                            </div>
                            <input type="radio" name="pay" value="paypal" />
                        </li>
                        <li class="mastercard">
                            <div class="pay-holder">
                                <p>MasterCard</p>
                            </div>
                            <input type="radio" name="pay" value="mastercard" />
                        </li>
                        <li class="visa">
                            <div class="pay-holder">
                                <p>Visa</p>
                            </div>
                            <input type="radio" name="pay" value="visa" />
                        </li>
                        <li class="express">
                            <div class="pay-holder">
                                <p>American Express</p>
                            </div>
                            <input type="radio" name="pay" value="american express" />
                        </li>
                        <li class="discover">
                            <div class="pay-holder">
                                <p>Discover</p>
                            </div>
                            <input type="radio" name="pay" value="discover" />
                        </li>
                    </ul>
                    <div class="row row-total">
                        <h4 class="total">Total to pay: <strong>{{ number_format(session('cart_total_price', 0), 2) }}</strong></h4>
                        <input type="submit" class="btn black normal" value="Make a payment" />
                    </div>
                </div>
            </fieldset>
        </form>
        </section>

</div>
<x-dashboardFooter />
