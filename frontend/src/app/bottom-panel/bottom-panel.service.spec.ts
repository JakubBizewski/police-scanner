import { TestBed } from '@angular/core/testing';

import { BottomPanelService } from './bottom-panel.service';

describe('BottomPanelService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: BottomPanelService = TestBed.get(BottomPanelService);
    expect(service).toBeTruthy();
  });
});
