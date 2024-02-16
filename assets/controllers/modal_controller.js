import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets =[
        'modalButton'
    ];

    connect() {
        console.log('Hello Modal Controller');
        const modalBody = document.querySelector('#modal_body');
    }
}
