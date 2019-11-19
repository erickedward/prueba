import { Component, OnInit } from '@angular/core';
import { Product } from '../product.model';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.scss']
})
export class ProductsComponent implements OnInit {

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
  ];

  constructor() { }

  ngOnInit() {
  }

  clickProduct(id: number) {
    console.log(id);
  }
}
