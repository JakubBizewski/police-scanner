import { TestBed } from '@angular/core/testing';

import { SearchCacheService } from './search-cache.service';

describe('SearchCacheService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: SearchCacheService = TestBed.get(SearchCacheService);
    expect(service).toBeTruthy();
  });
});
