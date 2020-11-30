import React,{useState} from 'react';
import ReactDOM from 'react-dom';

function Example() {
    // const [formData,setFormData] = useState({

    // })
   const [formInput,setFormInput] = useState({ 
    orderDate:'',
    customerName:'',
    item:'',
    totalQuantity:'',
    Quantity:0,
    total:0,
    price:4,
    subtotal:0,
    paid:'',
    netTotal:0,
    gst:'',
    discount:'',
    product: [{title:'',price:0,total:0,quantity:0,}],
   })
   // componentDidMount(){
   //     // get list of products from database

   // }

   const handleChange = (e) =>{
        e.preventDefault()
    const {name,value} = e.target
        setFormInput({...formInput,[name]:value})   
   }
    const submitHandler =(e)=>{
        e.preventDefault()
    }
    const add = ()=>{
     let table= document.getElementById('table') 
   
     let row= table.insertRow(-1)
     let one = row.insertCell(0)
     let two = row.insertCell(1)
     let three = row.insertCell(2)
     let four = row.insertCell(3)
     let five = row.insertCell(4)
     one.innerHTML = `<div className="form-row align-items-center"><div className="col-auto my-1">
     <label className="mr-sm-2 sr-only" htmlFor="inlineFormCustomSelect">Preference</label><select className="custom-select mr-sm-2" 
     id="inlineFormCustomSelect"><option >Choose...</option><option value="1">One</option><option value="2">Two</option>
     <option value="3">Three</option></select></div></div>`
     two.innerHTML = '<input type="number" className="form-control form-control-sm" id="inputEmail3" />'
     three.innerHTML='<input type="number" className="form-control form-control-sm" id="inputEmail3" />'
     four.innerHTML='<input type="number" readOnly value="4000" className="form-control form-control-sm" id="inputEmail3" />'
     five.innerHTML='<input type="number" readOnly value="50000" className="form-control form-control-sm" id="inputEmail3" />'
    }
    const remove =(e)=>{
        e.preventDefault()
        let table = document.getElementById('table')
        table.deleteRow(-1)
    }
    
    let details = 
    [
        {
            title:'Subtotal',
            name:'subtotal'
        },
        {
            title:'GST%',
            name:'gst'
        },
        {
            title:'Discount',
            name:'discount'
        },
        {
            title:'NetTotal',
            name:'netTotal'
        },
        {
            title:'Paid',
            name:'paid'
        },
        {
            title:'Due',
            name:'due'
        },
   
    ]
    const {orderDate,discount,customerName,item,totalQuantity,Quantity,price ,paid,netTotal,gst,subtotal} = formInput
    let total = price * Quantity

    // for (i=0,i<table.row.lenght)
    return (
        <form onSubmit={submitHandler}>
<div className="card w-100">
  <div className="card-header">
    Featured
  </div>
<div className='px-3'>
      <div className="form-group row">
        <label htmlFor="inputEmail3" className="col-sm-2 col-form-label">Order</label>
        <div className="col-sm-8">
          <input type="date" name='orderDate' onChange={handleChange} value={orderDate} className="form-control " id="inputEmail3" />
        </div>
      </div>
      <div className="form-group row">
        <label htmlFor="inputEmail3"  className="col-sm-2 col-form-label">Customer Name</label>
        <div className="col-sm-8">
          <input type="text" name='customerName' onChange={handleChange} value={customerName} className="form-control" id="inputEmail3" />
        </div>
      </div>
          <table className="table" id='table' style={{overflow:'auto'}}>
  <thead>
    <tr>
      <th scope="col">#item </th>
      <th scope="col">Total Quantity</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <div className="form-group">
           
            <select className="form-control form-control-sm" value={item} name='item' onChange={handleChange} 
            id="exampleFormControlSelect1">
              <option defaultValue>chooose</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
         </select>
  </div>
      </td>
      <td>
            <input type="number" name='totalQuantity' onChange={handleChange} value={totalQuantity} 
            className="form-control form-control-sm" id="inputEmail3" />
      </td>
      <td>
            <input type="number" name='Quantity'  onChange={handleChange} value={Quantity} 
            className="form-control form-control-sm" id="inputEmail3" />
      </td>
      <td className='bg-secondary'>
         <input type="number" readOnly  name='price'  onChange={handleChange} value={price}
          className="form-control form-control-sm" id="inputEmail3" />
      </td>
      <td>
         <input type="number" readOnly name='total' onChange={handleChange}
          value={total} className="form-control form-control-sm" id="inputEmail3" />
      </td>
    </tr>
    
  </tbody>
</table>

<p className='mx-auto'><button className='w-30 btn btn-success text-center' onClick={add}>Add</button><button onClick={remove} className='w-30 btn btn-success text-center'>Remove</button></p>
    {
        details.map((detail,ind)=>{
            return (
                <div className="form-group row" key={ind}>
                <label htmlFor="inputEmail3" className="col-sm-2 col-form-label">{detail.title}</label>
                <div className="col-sm-8">
                  <input type="text" className="form-control" name={detail.name} onChange={handleChange} id="inputEmail3" />
                </div>
            </div>
                )
        })
    }
    
</div>
</div>
</form> 
        
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
