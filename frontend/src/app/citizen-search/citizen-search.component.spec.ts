import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CitizenSearchComponent } from './citizen-search.component';

describe('CitizenSearchComponent', () => {
  let component: CitizenSearchComponent;
  let fixture: ComponentFixture<CitizenSearchComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CitizenSearchComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CitizenSearchComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
