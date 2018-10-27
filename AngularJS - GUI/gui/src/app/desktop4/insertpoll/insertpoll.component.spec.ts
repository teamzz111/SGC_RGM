import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InsertpollComponent } from './insertpoll.component';

describe('InsertpollComponent', () => {
  let component: InsertpollComponent;
  let fixture: ComponentFixture<InsertpollComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InsertpollComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InsertpollComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
