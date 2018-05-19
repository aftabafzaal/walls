@extends('front')

@section('content')
<section class="inr-intro-area pt100">
    <div class="container">	
        <div class="row">
            <div class="forget-fom col-md-6 col-md-offset-3">
                <div class="contact-form">
                    <h2 class="title text-center">Reset Password</h2>

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="text-center" role="form" method="POST" action="{{ url('/reset') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Reset My Password
                                </button>
                        </div>
						
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection