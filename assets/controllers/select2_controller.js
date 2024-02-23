import { Controller } from '@hotwired/stimulus';
import 'select2/dist/js/select2.js';
import 'select2/dist/css/select2.css';
import 'select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.css';
import $ from 'jquery';

export default class extends Controller {
    connect()
    {        
        $('select[data-select="true"]').select2({
            theme: "bootstrap-5",
        });
    }
}
 