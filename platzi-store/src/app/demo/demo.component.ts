import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-demo',
  templateUrl: './demo.component.html',
  styleUrls: ['./demo.component.scss']
})
export class DemoComponent implements OnInit {
  title = 'Segundo Curso de Angular en platzi-store';
  power = 10;
  items = ['Nailet', 'Ronald', 'Naiyerith'];
  objeto = {};
  constructor() { }

  ngOnInit() {
  }

  addItem() {
    this.items.push('Nuevo Item');
  }

  deleteItem(index: number) {
    this.items.splice(index, 1);
  }
}
