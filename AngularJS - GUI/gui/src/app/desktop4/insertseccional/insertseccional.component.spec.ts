import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InsertseccionalComponent } from './insertseccional.component';

describe('InsertseccionalComponent', () => {
  let component: InsertseccionalComponent;
  let fixture: ComponentFixture<InsertseccionalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InsertseccionalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InsertseccionalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
