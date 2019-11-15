import { Component } from '@angular/core';
import { Product } from './product.model';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'Segundo Curso de Angular en platzi-store';
  items = ['Nailet', 'Ronald', 'Naiyerith'];
  products: Product[] = [
    {
      id: '1',
      image: 'assets/images/1.png',
      title: 'Imagen 1',
      price: 80000,
      descripcion: 'bla bla bla'
    },
    {
      id: '2',
      image: 'assets/images/2.png',
      title: 'Imagen 2',
      price: 80000,
      descripcion: 'bla bla bla'
    },
    {
      id: '3',
      image: 'assets/images/3.png',
      title: 'Imagen 3',
      price: 80000,
      descripcion: 'bla bla bla'
    }
  ]

  addItem() {
    this.items.push('Nuevo Item')
  }

  deleteItem(index:number) {
    this.items.splice(index,1);
  }
}
