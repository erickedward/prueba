import { Directive, ElementRef } from '@angular/core';

@Directive({
  selector: '[appHighligth]'
})
export class HighligthDirective {

  constructor(
    element: ElementRef
  ) { 
    element.nativeElement.style.backgroundColor = 'red';
  }

}
