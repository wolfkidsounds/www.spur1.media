import { Controller } from '@hotwired/stimulus';
import '../js/app/blurry-load/blurry-load.css';
import BlurryImageLoad from '../js/app/blurry-load/blurry-load.js';

const blurryImageLoad = new BlurryImageLoad();

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    initialize() {
        blurryImageLoad.load();
    }
}
