import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EnviarmensajeComponent } from './enviarmensaje.component';

describe('EnviarmensajeComponent', () => {
  let component: EnviarmensajeComponent;
  let fixture: ComponentFixture<EnviarmensajeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EnviarmensajeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EnviarmensajeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
