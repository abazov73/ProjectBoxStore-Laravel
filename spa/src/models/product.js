export default class Product {
    constructor(data) {
        this.id = data?.id;
        this.product_name = data?.product_name || '';
        this.store_name = data?.store_name || '';
    }
}