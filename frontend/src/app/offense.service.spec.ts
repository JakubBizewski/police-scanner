import { TestBed } from '@angular/core/testing';

import { OffenseService } from './offense.service';

describe('OffenseService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: OffenseService = TestBed.get(OffenseService);
    expect(service).toBeTruthy();
  });
});
