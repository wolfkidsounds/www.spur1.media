import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
    static values = {
        formUrl: String,
    }

    static targets = [
        'result',
        'form'
    ]

    async submitForm(event) {
        event.preventDefault();
        
        const $form = $(this.formTarget).find('form');
        this.resultTarget.innerHTML = await $.ajax({
            url: this.formUrlValue,
            method: 'POST',
            data: $form.serialize(),
        });
    }
}
 