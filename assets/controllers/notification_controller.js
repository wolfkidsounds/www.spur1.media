// assets/controllers/notification_controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        url: String,
        token: String,
    }

    markAsRead(event) {
        event.preventDefault();
        const url = this.urlValue;
        const csrfToken = this.tokenValue;

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken,
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            window.location.reload();
        })
        .catch(error => console.error('Error:', error));
    }
}
