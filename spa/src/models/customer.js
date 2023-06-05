export default class Customer {
    constructor(data) {
        this.id = data?.id;
        this.last_name = data?.last_name || '';
        this.first_name = data?.first_name || '';
        this.middle_name = data?.middle_name || '';
    }
}