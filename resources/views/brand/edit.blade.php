@extends('layouts.app')
@section('content')
  <a href="{{route('home')}}">Go back &#8592;</a>
  <table class="table table-bordered " id='table' style="overflow: auto;">
 	<thead class="w-100">
      <tr>
        <th scope="col">Brands</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($brands as $brand)
    	<tr >
    		<td >
    			<div >{{$brand->name}}</div>
    		</td>
    		<td >
    			<a class="btn btn-secondary " data-toggle='modal' data-data='{{$brand}}' data-target='#brandManageModal'>edit<svg class="w-3 h-3"style='width:20px;height:15px' fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></a>
    		</td>
    		<td >
                <a class="btn btn-danger" href="/brand/delete/{{$brand->id}}"><svg style='width:20px;height:15px;' class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>delete</a>
    		</td>
    	</tr>
    	@endforeach
    </tbody>
 </table>
 @include('modals.manageModals')
@endsection
@section('scripts')
<script  >
	window.$(document).ready(function(){
    if($('#brandManageModal')){
        $('#brandManageModal').on('show.bs.modal',function(event){
            let triggerBtn = $(event.relatedTarget)
            let data = triggerBtn.data('data')
            let modal = $(this)
            modal.find('#brandName').val(data.name)
            // update brand
            modal.find('#brandForm').attr('action','/brand/edit/'+data.id)
            // update category
        })
        // $('#submit').click(function(event){
        //     event.preventDefault()

        //     // modal.find('#form').submit()
        // })
    }

	})
</script>
@endsection