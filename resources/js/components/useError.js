import React ,{useState} from 'react';
const useError = (initial)=>{
	const [errors,setErrors] = useState(initial)
	const hasErrorFor =(field)=>{
		if(errors) return !!errors[field]
		error?.[field]
	}
	const renderErrorFor = (field)=>{
		if(hasErrorFor(field)){
			return (<span className="alert-danger">{errors[field][0]}</span>)
		}

		// hasErrorFor(field) ? <span className="alert-danger">{errors[field][0]}</span> : null
	}
	return [setErrors,renderErrorFor]
}
export default useError