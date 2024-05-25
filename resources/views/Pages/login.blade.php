@include('templates.header')

<x-navbar />

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

    <h2 class="text-center">Login</h2>
    <br>
    <form action="{{ route('authenticate') }}" method="post" class="form-group" style="width:70%; margin-left:15%;">
        @csrf
        <label>Email:</label>
        <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{ old('email') }}"><br>

        <label>Password:</label>
        <input type="password" class="form-control" placeholder="Enter Password" name="password" required><br>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@include('templates.footer')
