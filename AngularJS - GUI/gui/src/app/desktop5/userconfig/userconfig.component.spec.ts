import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UserconfigComponent } from './userconfig.component';

describe('UserconfigComponent', () => {
  let component: UserconfigComponent;
  let fixture: ComponentFixture<UserconfigComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UserconfigComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UserconfigComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
