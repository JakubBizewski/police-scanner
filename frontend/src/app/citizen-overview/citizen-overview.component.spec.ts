import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CitizenOverviewComponent } from './citizen-overview.component';

describe('CitizenOverviewComponent', () => {
  let component: CitizenOverviewComponent;
  let fixture: ComponentFixture<CitizenOverviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CitizenOverviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CitizenOverviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
