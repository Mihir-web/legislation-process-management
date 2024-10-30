@extends('layouts.app')


@section('content')

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-lg-5 p-4">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Bills</h1>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger" id="alert_msg">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <form class="user" id="billUpdate" method="POST" enctype="multipart/form-data" action="{{ route('billUpdate') }}">
                        @csrf
                            
                                <input type="hidden" name="bid" value="{{base64_encode($bill->id)}}"/>
                                
                                <div class="form-group row">
                                <div class="col-sm-12 mb-3 ">
                                    <label for="name" class="text-dark">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control form_input" id="title" value="{{$bill->title}}" placeholder="Title">
                                </div>

                                <div class="col-sm-12 mb-3">
                                    <label for="name" class="text-dark">Description <span class="text-danger">*</span></label>
                                    <textarea class="w-100 text-area form_input" id="html-content" cols="42" rows="8" oninput="updateViewer()" name="description" style="border-radius:8px; border:1px solid #d1d3e2 !important;" placeholder="Description" value="{{$bill->description}}">{{$bill->description}}</textarea>
                                </div>
                                
                                <div class="float-right mb-4">
                                    <a href="{{ route('bills') }}" class="btn btn-user btn-outline btn-outline-secondary">
                                        <i class="fa-solid fa-xmark"></i> Cancel
                                    </a>
                                    <button name="add_bill" type="submit" value="1" class="btn btn-success btn-user">
                                        <i class="fa-solid fa-up-right-from-square"></i> Submit
                                    </button>
                                </div>

                                <input type="hidden" name="author_id" value="{{Auth::user()->id}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')

<script src="{{asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\UpdateBillRequest','#billUpdate') !!}


@endsection