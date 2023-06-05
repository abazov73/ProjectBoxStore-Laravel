export default class Store {
    constructor(data) {
        this.id = data?.id;
        this.store_name = data?.store_name || '';
        this.products = data?.products || null;
    }
}