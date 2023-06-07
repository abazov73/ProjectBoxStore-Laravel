import Order from "../../models/order"
import Product from "../../models/product"
import Customer from "../../models/customer";
import OrderTable from '../common/orderTable'
import { useState, useEffect} from "react";

export default function OrderPage(){
    const url = 'order/';
    const getUrl = 'order/';
    const getCustomerUrl = 'customer/';
    const getProductUrl = 'product/getWithStores'
    const transformer = (data) => new Order(data);
    const transformerProduct = (data) => new Product(data);
    const transformerCustomer = (data) => new Customer(data); 
    const catalogOrderHeaders = [
        { name: 'customer_fio', label: 'ФИО покупателя' },
        { name: 'store_name', label: 'Магазина'},
        { name: 'product_name', label: 'Товар'}
    ];

    const [data, setData] = useState(new Order());
    const [customerOptions, setCustomerOptions] = useState([])
    const [productOptions, setProductOptions] = useState([])

    function loadOptions(dataCustomer, dataProduct){
        const results1 = [];
        console.log(dataCustomer);
        //console.log(dataProduct);
        dataCustomer.forEach((value) => {
            results1.push({
                key: value.last_name + " " + value.first_name + " " + value.middle_name,
                value: value.id,
            })
        })
        console.log(results1);
        setCustomerOptions(results1);
        const results2 = [];
        dataProduct.forEach((value) => {
            results2.push({
                key: value.product_name,
                value: value.id,
            })
        })
        setProductOptions(results2);
        //console.log(customerOptions);
        //console.log(productOptions);
    }

    function handleOnAdd() {
        setData(new Order());
    }

    function handleOnEdit(data) {
        setData(new Order(data));
    }

    function handleFormChange(event) {
        setData({ ...data, [event.target.id]: event.target.value })
    }
    return(
        <article className="h-100 mt-0 mb-0 d-flex flex-column justify-content-between">
        <OrderTable headers={catalogOrderHeaders} 
            getAllUrl={url}
            url={url}
            getUrl={getUrl}
            getCustomerUrl={getCustomerUrl}
            getProductUrl={getProductUrl}
            transformer={transformer}
            transformerCustomer={transformerCustomer}
            transformerProduct={transformerProduct}
            data={data}
            onAdd={handleOnAdd}
            loadOptions={loadOptions}
            onEdit={handleOnEdit}>
        <div className="col-md-4">
            <label className="form-label" forhtml="customer_id">Покупатель</label>
            <select className="form-select" id="customer_id" value={data.customer_id} onChange={handleFormChange} required>
                {
                    customerOptions.map((option) => {
                        return(
                            <option key={option.value} value={option.value}>
                                {option.key}
                            </option>
                        )
                    }
                    )
                }
            </select>
            <label className="form-label" forhtml="product_id">Продукт</label>
            <select className="form-select" id="product_id" value={data.product_id} onChange={handleFormChange} required>
                {
                    productOptions.map((option) => {
                        return(
                            <option key={option.value} value={option.value}>
                                {option.key}
                            </option>
                        )
                    }
                    )
                }
            </select>
            <label className="form-label" forhtml="quantity">Количество</label>
            <input className="form-control" type="number" id="quantity" value={data.quantity} onChange={handleFormChange} placeholder="1" step="1" min="1" required="required"/>
        </div>
        </OrderTable>
      </article>
    )
}