@if(Session::has('success'))
    <div class="alert alert-danger">
        {{ Session::get('success') }}
    </div>
@endif

<h1>Thank You!</h1>
<h2>Your order id is: {{ $id }}</h2>
