import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { Desktop4Component } from './desktop4.component';

describe('Desktop4Component', () => {
  let component: Desktop4Component;
  let fixture: ComponentFixture<Desktop4Component>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ Desktop4Component ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(Desktop4Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
