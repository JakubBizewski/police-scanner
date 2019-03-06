import { TestBed } from '@angular/core/testing';

import { VisaService } from './visa.service';

describe('VisaService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: VisaService = TestBed.get(VisaService);
    expect(service).toBeTruthy();
  });
});
