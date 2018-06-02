import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StatiComponent } from './stati.component';

describe('StatiComponent', () => {
  let component: StatiComponent;
  let fixture: ComponentFixture<StatiComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StatiComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StatiComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
