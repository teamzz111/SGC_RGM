import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LockuserComponent } from './lockuser.component';

describe('LockuserComponent', () => {
  let component: LockuserComponent;
  let fixture: ComponentFixture<LockuserComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LockuserComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LockuserComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
