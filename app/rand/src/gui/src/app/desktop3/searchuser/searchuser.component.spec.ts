import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SearchuserComponent } from './searchuser.component';

describe('SearchuserComponent', () => {
  let component: SearchuserComponent;
  let fixture: ComponentFixture<SearchuserComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SearchuserComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SearchuserComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
