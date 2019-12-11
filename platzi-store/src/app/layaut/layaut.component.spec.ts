import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LayautComponent } from './layaut.component';

describe('LayautComponent', () => {
  let component: LayautComponent;
  let fixture: ComponentFixture<LayautComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LayautComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LayautComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
