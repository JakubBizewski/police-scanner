import { Component, OnInit } from '@angular/core';
import { Citizen } from '../entity/citizen';
import { ActivatedRoute, Router } from '@angular/router';
import { SearchCacheService } from '../search-cache.service';
import { CitizenService } from '../citizen.service';
import { BottomPanelService } from '../bottom-panel/bottom-panel.service';
import { HttpErrorResponse } from '@angular/common/http';

@Component({
  selector: 'app-citizen-panel',
  templateUrl: './citizen-panel.component.html',
  styleUrls: ['./citizen-panel.component.scss']
})
export class CitizenPanelComponent implements OnInit {
  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private searchCache: SearchCacheService,
    private citizenService: CitizenService,
    private bottomPanel: BottomPanelService) { }

  citizen: Citizen;

  private fetchCitizen(id: number) {
    const cachedCitizen = this.searchCache.cachedCitizen;

    if (cachedCitizen && cachedCitizen.id === id) {
      this.citizen = cachedCitizen;

      return;
    }

    this.bottomPanel.showLoader();

    this.citizenService.getCitizenById(id).subscribe(citizen => {
      this.citizen = citizen;
      this.bottomPanel.clear();
    }, (error: HttpErrorResponse) => {
      if (error.status === 404) {
        this.bottomPanel.showError('Citizen not found!');
      } else {
        this.bottomPanel.showError('Something went wrong!');
      }

      this.router.navigate(['/search']);
    });
  }

  ngOnInit() {
    const id = parseInt(this.route.snapshot.paramMap.get('id'), 10);

    this.fetchCitizen(id);
  }
}
