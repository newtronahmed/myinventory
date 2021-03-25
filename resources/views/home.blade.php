@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <!-- left sidebar -->
        <div class="col-md-4 shadow ">
            <div class="image d-flex justify-content-center">
                <img src='{{$profile->profileImage()}}' alt = 'profile image' class=" w-100  " style='height: 400px;' >
            </div>
            <!-- Profile -->
            <div>
                <div class="lead p-2">Profile</div>
                <div class="shadow-sm p-2 mb-1">Name: {{$profile->user->name}}</div>
                <div class="shadow-sm p-2 mb-1">Description: {{$profile->description}}</div>
                <div class="shadow-sm p-2 mb-1">Email: {{$profile->user->email}}</div>
                <a href="{{route('profile.edit')}}" class="btn btn-primary btn-sm mb-2">Edit Profile +</a>
                @if (session('status'))
                 <div class="alert alert-success">
                    {{$value =session()->get('status')}}
                </div>
                @endif
            </div>
            
        </div>
            <!-- Right Main bar-->
        <div class="col-md-8 w-100 "  > 
            <div class="rounded"  style="background-color: coral;">
            <div class=" rounded p-3" style="background-color:steelblue;color:white; clip-path: polygon(0 0,63% 0, 80% 100%,0 100%)">  
                <h2 >Welcome Back</h2>
                <div class="lead"> {{$profile->user->name}}</div>
                <div class="mr-auto" >
                <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</div> 
                <a href="{{route('neworders')}}" class="btn btn-lg btn-primary"> New orders</a>
                </div>
            </div>
            </div> 
            <h2 class="text-center py-2 mt-2">Recent Orders</h2>
            
            @foreach ($recentOrders as $order)

                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <div class="card-text">{{$order->hash_id}}</div>
                    <div class="card-text">Ghc{{$order->total}}</div>
                    </div>
                    
                </div>
            @endforeach
        </div>
    </div>
   
    <div class="row py-3">
        <!-- Categories --> 
            <div class="col-md-4 mt-2">
                <div class="card shadow rounded">
                   <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                    <div class="d-flex ">
                        <button class="btn btn-primary btn-sm mx-2 rounded-0 " data-toggle="modal" data-target="#categoryModal">add</button>
                        <a class="btn btn-primary btn-sm mx-2 rounded-0 " href="{{route('categories.manage')}}">Manage</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="card shadow pointer rounded">
                   <div class="card-body">
                    <h5 class="card-title">Brands</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                    <div class="d-flex ">
                        <button class="btn btn-primary btn-sm mx-2 rounded-0 " data-toggle='modal' data-target='#brandModal'>add</button>
                       <a class="btn btn-primary btn-sm mx-2 rounded-0 " href="{{route('brands.manage')}}">Manage</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="card shadow cursor-pointer rounded"> 
                   <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                    <div class="d-flex ">
                        <button class="btn btn-primary btn-sm mx-2 rounded-0  " data-toggle='modal' data-target='#productModal'>add</button>
                        
                        <a class="btn btn-primary btn-sm mx-2 rounded-0 " href="{{route('products.manage')}}">Manage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@include('modals.categoryModal')
@endsection

 
 