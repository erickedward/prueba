import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { Product } from './../../models/product.model';

import { environment } from './../../../../environments/environment';
@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  /*products: Product[] = [
    {
      id: '1',
      image: 'assets/images/camiseta.png',
      title: 'Camiseta',
      price: 80000,
      description: 'bla bla bla bla bla'
    },
    {
      id: '2',
      image: 'assets/images/hoodie.png',
      title: 'Hoodie',
      price: 80000,
      description: 'bla bla bla bla bla'
    },
    {
      id: '3',
      image: 'assets/images/mug.png',
      title: 'Mug',
      price: 80000,
      description: 'bla bla bla bla bla'
    },
    {
      id: '4',
      image: 'assets/images/pin.png',
      title: 'Pin',
      price: 80000,
      description: 'bla bla bla bla bla'
    },
    {
      id: '5',
      image: 'assets/images/stickers1.png',
      title: 'Stickers',
      price: 80000,
      description: 'bla bla bla bla bla'
    },
    {
      id: '6',
      image: 'assets/images/stickers2.png',
      title: 'Stickers',
      price: 80000,
      description: 'bla bla bla bla bla'
    },
  ];*/

  constructor(
    private http: HttpClient
  ) { }

  getAllProducts() {
    // return this.products;
    return this.http.get<Product[]>(`${environment.url_api}/products/` );
  }

  getProduct(id: string) {
    // return this.products.find(item => id === item.id);
    return this.http.get<Product>(`${environment.url_api}/products/${id}`);
  }


  createProduct(product: Product) {
    return this.http.post(`${environment.url_api}/products/`, product);
  }

  updateProduct(id: string, changes: Partial<Product>) {
    // return this.products.find(item => id === item.id);
    return this.http.put(`${environment.url_api}/products/${id}`, changes);
  }

  deleteProduct(id: string) {
    // return this.products.find(item => id === item.id);
    return this.http.delete(`${environment.url_api}/products/${id}`);
  }

}
