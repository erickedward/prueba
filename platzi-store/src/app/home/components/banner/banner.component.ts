import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-banner',
  templateUrl: './banner.component.html',
  styleUrls: ['./banner.component.scss']
})
export class BannerComponent implements OnInit {

  images: string[] = [
    'assets/images/baners1.png',
    'assets/images/baners2.png',
    'assets/images/baners3.png'
  ];

  constructor() { }

  ngOnInit() {
  }

}
