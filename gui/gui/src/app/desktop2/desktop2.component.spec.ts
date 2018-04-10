import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { Desktop2Component } from './desktop2.component';

describe('Desktop2Component', () => {
  let component: Desktop2Component;
  let fixture: ComponentFixture<Desktop2Component>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ Desktop2Component ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(Desktop2Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
