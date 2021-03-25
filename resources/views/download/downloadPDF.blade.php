<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Checkpoint</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    .invoice-box table td div {
        padding: 5px;
        background-color:steelblue;
        color :white;
        text-align: left;
        text-transform: capitalize;
        font-style: bold;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align:left;
    }
    .invoice-box table tr td:nth-child(4) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        text-align: right;
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(4) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
	<button class="btn btn-success"><a href="/download/pdf/{{$data->hash_id}}">Download</a> <a href="{{route('home')}}">Go back &#8592;</a></button>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="/storage/profileImages/228153931608777336.jpg" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Invoice #: {{$data->hash_id}}<br>
                                Created: {{$data->created_at}}<br>
                                Due: February 1, 2021
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                            	
                                NewtronAhmed, Inc.<br>
                                12345 Sunny Road<br>
                                hmedZubairu365@gmail.com<br>
                                Sunnyville, CA 12345
                            </td>
                            
                            <td>
                            	<div>billing to</div>
                                {{$data->customer_name}}<br>
                                {{$data->address}}<br>
                                {{$data->phone}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr  class="heading">
                <td>
                    Payment Method
                </td>
                <td></td>
                <td></td>
                <td>
                    Check #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    {{$data->payment_method}}
                </td>
                <td></td>
                <td></td>
                <td>
                    ${{$data->paid}}
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Item
                </td>
                
                <td>
                   Unit Price
                </td>
                <td>
                   Quantity
                </td>
                <td>
                    Amount
                </td>
            </tr>
            @foreach($data->product as $product)
            
            <tr class="item">
                <td>
                    {{$product->name}}
                </td>
                
                <td>
                    {{$product->price}}
                </td>
                <td>
                    {{$product->pivot->quantity}}
                </td>
                <td>
                	{{$product->pivot->productsTotal}}
                </td>
            </tr>
            @endforeach
            
            
            
            
            <tr class="total">
            	<td></td>
            	<td></td>
                <td></td>
            	<td>
                	SubTotal:$ {{$data->subTotal}}
                </td>
                
            </tr>

            <tr class="total">
                <td></td>
                <td></td>
                <td></td>
                <td>
                   Discount:% {{$data->discount}}
                </td>

            </tr >

            <tr class="total">
            	<td></td>
            	<td></td>
                <td></td>
            	<td>
                	Total:$ {{$data->total}}
                </td>
            </tr>
            <tr class="total">
            	<td></td>
            	<td></td>
                <td></td>
            	<td>
            	Amount Paid: $ {{$data->paid}}	
            	</td>
            </tr>
            <tr class="total">
            	<td></td>
            	<td></td>
                <td></td>
            	<td style='color:red;'>Balance Due :$ {{$data->due}}</td>
            </tr>
        </table>
    </div>
    <div style='padding: 30px'>
        Thank you for trusting our services, see you again.
    </div>
</body>
</html>



{{-- <nav>
	<h1>Newtro Corp</h1>
	<p>123 Main Street,Townsviller , Ghana M4l3g5</p>
	<p>Phone: +2332477687399</p>
	<p>hmedZubairu365@gmail.com</p>
	<p>newtro.live</p>
</nav>
<div>
	<h3>Bill To</h3>
	<p>Recipient Name:{{$data->customer_name}}</p>
	<p>Company Name:{{$data->customer_name}}</p>
</div>
<div>
	<table>
		<thead>
			<th>Quantity</th>

		</thead>
	</table>
</div>
<div>{{$data->total}}</div>
<div>{{$data->created_at}}</div> --}}
