import {Component} from '@angular/core';

import { Product } from '../product.model';
    
@Component({
    selector: 'app-product',
    templateUrl: './product.component.html'

})
export class ProductComponent {
    product: Product = {
        id: '1',
        image: 'assets/images/1.png',
        title: 'Imagen 1',
        price: 80000,
        descripcion: 'bla bla bla'
      };
}