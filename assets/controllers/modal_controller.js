import { Controller } from '@hotwired/stimulus';
import { Modal } from 'bootstrap';
import $ from 'jquery';

export default class extends Controller {
    static values = {
        url : String,
        resolve : String,
    }

    async openModal(event) {
        var modalElement = document.getElementById('modal');
        var modalBody = modalElement.querySelector('.modal-body');
        modalBody.innerHTML = '<div class="d-flex align-items-center">Loading...<div class="spinner-border ms-auto" aria-hidden="true"></div></div>';

        const url = this.urlValue;
        const action = this.resolveValue;

        const modal = new Modal(modalElement);
        modal.show();

        modalBody.innerHTML = await $.ajax({
            url: url,
            method: 'POST',
            data: {
                action: action
            },

        });
    }

    submitForm(event) {
        event.preventDefault();
        
        const modalElement = document.getElementById('modal');
        const modalForm = modalElement.querySelector('form');
        const action = modalForm.action;
        const formData = new FormData(modalForm);

        const modal = new Modal(modalElement);

        modalForm.classList.add('opacity-25 pe-none');

        $.ajax({
            url: action,
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,

            success: function(response) {
                modalForm.classList.remove('opacity-25 pe-none');
                modal.hide();
                window.location.href = response.url;
            },

            error: function(xhr, status, error) {
                modalForm.classList.remove('opacity-25 pe-none');
            }
        });
    }
}
