import Product from "../../models/product"
import ProductTable from '../common/productTable'
import { useState, useEffect} from "react";

export default function ProductPage(){
    const url = 'product/';
    const getUrl = 'product/';
    const transformer = (data) => new Product(data);
    const catalogProductHeaders = [
        { name: 'product_name', label: 'Название товара' },
        { name: 'store_name', label: 'Название магазина' }
    ];

    const [data, setData] = useState(new Product());

    function handleOnAdd() {
        setData(new Product());
    }

    function handleOnEdit(data) {
        setData(new Product(data));
    }

    function handleFormChange(event) {
        setData({ ...data, [event.target.id]: event.target.value })
    }
    return(
        <article className="h-100 mt-0 mb-0 d-flex flex-column justify-content-between">
        <ProductTable headers={catalogProductHeaders} 
            getAllUrl={url}
            url={url}
            getUrl={getUrl}
            transformer={transformer}
            data={data}
            onAdd={handleOnAdd}
            onEdit={handleOnEdit}>
        <div className="col-md-4">
            <label className="form-label" forhtml="product_name">Название</label>
            <input className="form-control" type="text" id="product_name" value={data.product_name} onChange={handleFormChange} required="required"/>
        </div>
        </ProductTable>
      </article>
    )
}