export default class Order {
    constructor(data) {
        this.id = data?.id;
        this.store_name = data?.store_name || '';
        this.customer_fio = data?.customer_fio || '';
        this.customer_id = data?.customer_fio || '';
        this.product_name = data?.product_name || '';
        this.product_id = data?.product_id || '';
        this.quantity = data?.quantity || '';
    }
}