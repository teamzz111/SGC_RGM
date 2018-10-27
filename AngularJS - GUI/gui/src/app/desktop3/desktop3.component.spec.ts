import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { Desktop3Component } from './desktop3.component';

describe('Desktop3Component', () => {
  let component: Desktop3Component;
  let fixture: ComponentFixture<Desktop3Component>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ Desktop3Component ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(Desktop3Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
