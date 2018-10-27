import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { Desktop5Component } from './desktop5.component';

describe('Desktop5Component', () => {
  let component: Desktop5Component;
  let fixture: ComponentFixture<Desktop5Component>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ Desktop5Component ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(Desktop5Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
