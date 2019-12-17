import { Component, OnInit } from '@angular/core';
import { NgModule } from '@angular/core';
import { SharedModule } from './../shared/shared.module';

@Component({
  selector: 'app-demo',
  templateUrl: './demo.component.html',
  styleUrls: ['./demo.component.scss']
})

@NgModule({
  declarations: [],
  imports: [
    SharedModule
  ],
  providers: [],
  bootstrap: []
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
