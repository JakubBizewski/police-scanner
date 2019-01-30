import { TestBed } from '@angular/core/testing';

import { CitizenService } from './citizen.service';

describe('CitizenService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: CitizenService = TestBed.get(CitizenService);
    expect(service).toBeTruthy();
  });
});
