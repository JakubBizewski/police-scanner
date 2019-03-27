import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CitationAddDialogComponent } from './citation-add-dialog.component';

describe('CitationAddDialogComponent', () => {
  let component: CitationAddDialogComponent;
  let fixture: ComponentFixture<CitationAddDialogComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CitationAddDialogComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CitationAddDialogComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
