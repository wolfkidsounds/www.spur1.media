import { Controller } from '@hotwired/stimulus';
import '../js/app/blurry-load/blurry-load.css';
import BlurryImageLoad from '../js/app/blurry-load/blurry-load.js';

const blurryImageLoad = new BlurryImageLoad();
export default class extends Controller {
    initialize() {
        blurryImageLoad.load();
    }
}
