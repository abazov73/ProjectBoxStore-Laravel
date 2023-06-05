import Store from "../../models/store"
import StoreTable from '../common/storeTable'
import { useState, useEffect} from "react";

export default function StorePage(){
    const url = 'store/';
    const getUrl = 'store/';
    const transformer = (data) => new Store(data);
    const catalogStoreHeaders = [
        { name: 'store_name', label: 'Название магазина' }
    ];

    const [data, setData] = useState(new Store());

    function handleOnAdd() {
        setData(new Store());
    }

    function handleOnEdit(data) {
        setData(new Store(data));
    }

    function handleFormChange(event) {
        setData({ ...data, [event.target.id]: event.target.value })
    }
    return(
        <article className="h-100 mt-0 mb-0 d-flex flex-column justify-content-between">
        <StoreTable headers={catalogStoreHeaders} 
            getAllUrl={url}
            url={url}
            getUrl={getUrl}
            transformer={transformer}
            data={data}
            onAdd={handleOnAdd}
            onEdit={handleOnEdit}>
        <div className="col-md-4">
            <label className="form-label" forhtml="store_name">Название</label>
            <input className="form-control" type="text" id="store_name" value={data.store_name} onChange={handleFormChange} required="required"/>
        </div>
        </StoreTable>
      </article>
    )
}