import React,{useState,useEffect} from 'react';
import ReactDOM from 'react-dom';
import useError from './useError'

function OrderForm() {
    // const [formData,setFormData] = useState({

    // })
   const [formInput,setFormInput] = useState({ 
    customerName:'',
    products: [ {id:1,item:'',price:0,total:0,quantity:0,totalQuantity:0} ],
    subtotal:0,
    paid:0,
    netTotal:0,
    discount:0,
    due:0,
    address:'',
    phone:'',
    payment_method:'',
   })
   const [setErrors,renderErrorFor] = useError([])
   // const [errors,setErrors] = useState([])
   const [loading,setLoading] = useState(false)

  const [productSelection,setProductSelection] = useState([])
   useEffect(()=>{
     getProductsList()
   },[])
   const getProductsList=()=>{
     setLoading(true)
      axios.get('/products')
      .then(response=>{
      setProductSelection([...response.data])
      setLoading(false)
      })
      .catch(err=>{
        setErrors([...errors,err.message])
      })
   }


   useEffect(()=>{
      let subtotal = formInput.products.map(each=>{
          return each.total
         }).reduce((acc,ind)=>{
          return acc+ind
         },0)
         let netTotal = subtotal;
       let paid = formInput.paid
        if(discount){


          let discount = parseInt(formInput.discount)
         let perCentDiscount = discount / 100
          netTotal = subtotal - (subtotal*perCentDiscount)
          netTotal = parseFloat(netTotal)
        
         }

        let due = parseFloat(netTotal-paid)
      setFormInput({...formInput,subtotal,netTotal,discount,due})
         
   },[formInput.products,formInput.discount,formInput.paid])

  //  const handleChange = (e) =>{
        
  //   const {name,value} = e.target
  //       setFormInput({...formInput,[name]:value})   

  //  }
   const handleTableChange =  (e, id=null) =>{

    // e.preventDefault()
    // console.log(e.target.type)
 
    let {name,value} = e.target;
    // console.log(value)
    // parse to numbers before
    if(e.target.type==='number'){
      value = parseInt(value)
    }
    // if id is not null
    if(!id){
      const {name,value} = e.target
     setFormInput({...formInput,[name]:value}) 
    } else {
      // if id is null
      formInput.products.map( async (product,i)=>{
        // console.log(product.id , id)
  
        if(product.id === id){
      
       let products = [...formInput.products]
       let product = {...products[i]}
       product[name]= value
       // setFormInput({...formInput,products: products})
           if(e.target.type==='select-one' && value !=='choose'){
            // console.log(products[i].item)
            // console.log('ama live')
            
            const response = await axios.get('/products/'+value) 
           
            product['price']= response.data.price
            product['totalQuantity']= parseInt(response.data.quantity) 
           }
           product['total'] = (product['price']* product['quantity'])
           products[i] = product
          setFormInput({...formInput,products})
      // setFormInput({...formInput,products: [products[i][name]:value ,...products] })  
        }
   
      })
    }
     

   

    
   }

    const submitHandler = async(e)=>{
        e.preventDefault()
        // console.log(formInput)
        try{
          const res = await axios.post('/neworder',formInput)
            if(res.status===200) {
             let hashId = res.data.message
            //  console.log(res.data)
             window.location.href= `/download-pdf/${hashId}`
           }
          
        }
        catch(err){
          // setErrors([...errors,err])
          setErrors(err.response.data.errors)
        }
       

      
    }
    const add = ()=>{
      // add new empty product to products arrray 
      let newId = formInput.products.length + 1;
     setFormInput({...formInput,products: [...formInput.products,{id:newId,item:'',price:0,total:0,quantity:0,totalQuantity:0}]})
    }
    const remove =(e)=>{
        // e.preventDefault()
       // remove last product object from array
        let products = [...formInput.products]
         products.pop()
        setFormInput({...formInput,products:products})
    }
    
   
    // const {orderDate,discount,customerName,item,totalQuantity,Quantity,price ,paid,netTotal,gst,subtotal} = formInput
    let {orderDate,discount,customerName,paid,netTotal,subtotal,due,address,phone} = formInput
 
     let details = 
    [
        {
            title:'Subtotal',
            name:'subtotal',
            value:subtotal,
        },
        // {
        //     title:'GST%',
        //     name:'gst'
        // },
        {
            title:'Discount',
            name:'discount',
            value:discount,
        },
        {
            title:'NetTotal',
            name:'netTotal',
            value:netTotal
        },
        {
            title:'Paid',
            name:'paid',
            value:paid,
        },
        {
            title:'Due',
            name:'due',
            value:due
        },
   
    ]
    
    // const {item,price,quantity,totalQuantity,id} = formInput.product
    // let total = price * Quantity

    // for (i=0,i<table.row.lenght)
    return (
    <form onSubmit={submitHandler} method='POST' >
      <div className="card w-100">
        <div className="card-header">
          Order Form
        </div>
      <div className='p-3'>
            <div className="form-group row">
              <label htmlFor="inputEmail3"  className="col-sm-2 col-form-label">Customer Name</label>
              <div className="col-sm-8">
                <input type="text" name='customerName' onChange={handleChange} value={customerName} className="form-control" id="inputEmail3" />
              {renderErrorFor('customerName')}
              </div>
            </div>
            <div className="form-group row">
              <label htmlFor="inputEmail3"  className="col-sm-2 col-form-label">Address</label>
              <div className="col-sm-8">
                <input type="text" name='address' onChange={handleChange} value={address} className="form-control" id="inputEmail3" />
                {renderErrorFor('address')}
              </div>
            </div>
            <div className="form-group row">
              <label htmlFor="inputEmail3"  className="col-sm-2 col-form-label">Phone Number</label>
              <div className="col-sm-8">
                <input type="text" name='phone' onChange={handleChange} value={phone} className="form-control" id="inputEmail3" />
                {renderErrorFor('phone')}
              </div>
            </div>

                <table className="table" id='table' style={{overflowX:'scroll'}}>
        <thead>
          <tr>
            <th scope="col">item </th>
            <th scope="col">Total Quantity</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
              {formInput.products.map((product,i)=>{
                const {item,price,quantity,totalQuantity,id,total} = product
               // total = price * quantity

               return (
            <tr key={i} >
            <td>
              <div className="form-group">
                 
                  { loading ? <div className="spinner-border text-info" role="status"><span className="sr-only">Loading...</span></div>: (<select className="form-control form-control-sm" value={item} name='item' onChange={(e)=>handleTableChange(e,id)} 
                  id="exampleFormControlSelect1">

                  <option >choose</option>
                    {  productSelection.map(each=>{
                      return <option key={each.id}   value={each.id}>{each.name}</option>
                    })}
               </select>)}
        </div>
            </td>
            <td>
                  <input type="number" name='totalQuantity' readOnly onChange={(e)=>handleTableChange(e,id)} value={totalQuantity} 
                  className="form-control form-control-sm" id="inputEmail3" />
            </td> 
            <td>
                  <input type="number" name='quantity' max={totalQuantity}  onChange={(e)=>handleTableChange(e,id)} value={quantity} 
                  className="form-control form-control-sm" id="inputEmail3" />
            </td>
            <td className=''>
               <input type="number" readOnly  name='price'  onChange={(e)=>handleTableChange(e,id)} value={price}
                className="form-control form-control-sm" id="inputEmail3" />
            </td>
            <td>
               <input type="number" readOnly name='total' onChange={(e)=>handleTableChange(e,id)}
                value={total} className="form-control form-control-sm" id="inputEmail3" />
            </td>
          </tr>)

                })}

          
        </tbody>
      </table>

      <p className='mx-auto'><button type='button' className='w-30 btn btn-info text-center' onClick={add}>Add</button><button onClick={remove} type='button' className='w-30 btn btn-info text-center'>Remove</button></p>
          {
              details.map((detail,ind)=>{
                  return (
                      <div className="form-group row" key={ind}>
                      <label htmlFor="inputEmail3" className="col-sm-2 col-form-label">{detail.title}</label>
                      <div className="col-sm-8">
                        <input type="text" className="form-control" name={detail.name} onChange={handleChange} id="inputEmail3" value={detail.value} />
                        {renderErrorFor(detail.name)}
                      </div>
                    
                  </div>
                      )
              })
          }
          <div className="form-group row">
              <label htmlFor="inputEmail3"  className="col-sm-2 col-form-label">Payment Method</label>
              <div className="col-sm-8">
                 <label className="radio-inline mx-2"><input type="radio"  name="payment_method" onChange={handleChange}  value='cheque' />Cheque</label>
                <label className="radio-inline mx-2"><input type="radio"  name="payment_method" onChange={handleChange}  value='cash' />Cash</label>
               <label className="radio-inline mx-2"><input type="radio" name="payment_method" onChange={handleChange}  value='credit_card' />Credit Card</label>
              </div>
              {renderErrorFor('payment_method')}
            </div>
      </div>
      <div className='card-footer d-flex justify-content-center'>
        <button type='submit' className='btn btn-success'>submit</button>
      </div>
      </div>
      
</form> 
        
    );
}

export default Example;

if (document.getElementById('order-form')) {
    ReactDOM.render(<OrderForm />, document.getElementById('order-form'));
}
