// sidebar_controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [
        'sidebar',
        'sidebarButton'
    ];

    static values = [
        'sidebar-state'
    ];

    connect() {
        // Load sidebar state from local storage when the controller connects
        this.loadSidebarState();
    }

    loadSidebarState() {
        // Load sidebar state from local storage
        const savedState = localStorage.getItem('sidebarState');

        if (savedState) {
            this.sidebarStateValue = savedState;
            this.updateSidebarState();
            console.log(savedState);
            console.log(this.sidebarStateValue);
        }
    }

    toggleSidebar(event) {
        event.preventDefault();
        // Toggle the sidebar state value between 'open' and 'closed'
        this.sidebarStateValue = this.sidebarStateValue === 'open' ? 'closed' : 'open';
    
        // Save the sidebar state to local storage
        localStorage.setItem('sidebarState', this.sidebarStateValue);
        
        // Update the data-sidebar-state attribute
        this.updateSidebarState();
    }

    updateSidebarState() {
        console.log(this.sidebarStateValue);
        // Update the data-sidebar-state attribute
        this.sidebarTarget.setAttribute('data-sidebar-state', this.sidebarStateValue);

        // Get all elements with data-sidebar-state attribute
        const elementsWithSidebarState = document.querySelectorAll('[data-sidebar-state]');
    
        // Loop through each element and check its state
        elementsWithSidebarState.forEach(element => {
            const sidebarState = element.getAttribute('data-sidebar-state');
            // You can perform actions based on the sidebar state of each element
            if (sidebarState === 'closed') {
                element.setAttribute('data-sidebar-state', this.sidebarStateValue);
            } else {
                element.setAttribute('data-sidebar-state', this.sidebarStateValue);
            }
        });
    }
}