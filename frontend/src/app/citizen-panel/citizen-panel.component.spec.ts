import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CitizenPanelComponent } from './citizen-panel.component';

describe('CitizenPanelComponent', () => {
  let component: CitizenPanelComponent;
  let fixture: ComponentFixture<CitizenPanelComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CitizenPanelComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CitizenPanelComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
