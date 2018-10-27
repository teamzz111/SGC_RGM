import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InsertjobComponent } from './insertjob.component';

describe('InsertjobComponent', () => {
  let component: InsertjobComponent;
  let fixture: ComponentFixture<InsertjobComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InsertjobComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InsertjobComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
