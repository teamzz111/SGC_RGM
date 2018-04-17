import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InsertuserComponent } from './insertuser.component';

describe('InsertuserComponent', () => {
  let component: InsertuserComponent;
  let fixture: ComponentFixture<InsertuserComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InsertuserComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InsertuserComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
