import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ExponentialPipe } from './pipes/exponential/exponential.pipe';
import { HighligthDirective } from './directives/highligth/highligth.directive';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';

@NgModule({
  declarations: [
    ExponentialPipe,
    HighligthDirective,
    HeaderComponent,
    FooterComponent
  ],
  imports: [
    CommonModule
  ]
})
export class SharedModule { }
