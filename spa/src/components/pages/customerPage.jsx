import Customer from "../../models/customer"
import CustomerTable from '../common/customerTable'
import { useState, useEffect} from "react";

export default function CustomerPage(){
    const url = 'customer/';
    const getUrl = 'customer/';
    const transformer = (data) => new Customer(data);
    const catalogCustomerHeaders = [
        { name: 'last_name', label: 'Фамилия' },
        {name: 'first_name', label: 'Имя'},
        {name: 'middle_name', label: 'Отчество'}
    ];

    const [data, setData] = useState(new Customer());

    function handleOnAdd() {
        setData(new Customer());
    }

    function handleOnEdit(data) {
        setData(new Customer(data));
    }

    function handleFormChange(event) {
        setData({ ...data, [event.target.id]: event.target.value })
    }
    return(
        <article className="h-100 mt-0 mb-0 d-flex flex-column justify-content-between">
        <CustomerTable headers={catalogCustomerHeaders} 
            getAllUrl={url}
            url={url}
            getUrl={getUrl}
            transformer={transformer}
            data={data}
            onAdd={handleOnAdd}
            onEdit={handleOnEdit}>
        <div className="col-md-4">
            <label className="form-label" forhtml="last_name">Фамилия</label>
            <input className="form-control" type="text" id="last_name" value={data.last_name} onChange={handleFormChange} required="required"/>
          </div>
          <div className="col-md-4">
            <label className="form-label" forhtml="first_name">Имя</label> 
            <input className="form-control" type="text" id="first_name" value={data.first_name} onChange={handleFormChange} required="required"/>
          </div>
          <div className="col-md-4">
            <label className="form-label" forhtml="middle_name">Отчество</label>
            <input className="form-control" type="text" id="middle_name" value={data.middle_name} onChange={handleFormChange} required="required"/>
          </div>
        </CustomerTable>
      </article>
    )
}