import { Component, OnInit } from '@angular/core';
import { VehicleService } from '../vehicle.service';
import { HttpErrorResponse } from '@angular/common/http';
import { BottomPanelService } from '../bottom-panel/bottom-panel.service';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { CitizenService } from '../citizen.service';
import { SearchCacheService } from '../search-cache.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})
export class SearchComponent implements OnInit {
  constructor(
    private vehicleService: VehicleService,
    private citizenService: CitizenService,
    private bottomPanelService: BottomPanelService,
    private searchCache: SearchCacheService,
    private router: Router) { }

  vehicleForm = new FormGroup({
    number: new FormControl('', Validators.required),
    searchType: new FormControl('', Validators.required)
  });

  citizenForm = new FormGroup({
    firstName: new FormControl('', Validators.required),
    lastName: new FormControl('', Validators.required),
    birthDate: new FormControl('', Validators.required)
  });

  searchVehicle() {
    const number = this.vehicleForm.controls['number'].value;
    const searchType = this.vehicleForm.controls['searchType'].value;

    this.bottomPanelService.showLoader();

    if (searchType === 'vin') {
      this.vehicleService.getVehicleByVin(number)
        .subscribe(
          vehicle => {
            this.searchCache.cachedVehicle = vehicle;
            this.bottomPanelService.clear();

            this.router.navigate(['/vehicle', vehicle.id]);
          },
          (error: HttpErrorResponse) => {
            if (error.status === 404) {
              this.bottomPanelService.showError('Vehicle not found');
            } else {
              this.bottomPanelService.showError('Something went wrong!');
            }
        });
    } else if (searchType === 'registration') {
      this.vehicleService.getRegistrationByNumber(number)
        .subscribe(
          registration => {
            this.searchCache.cachedVehicle = registration.vehicle;
            this.bottomPanelService.clear();

            this.router.navigate(['/vehicle', registration.vehicle.id]);
          },
        (error: HttpErrorResponse) => {
            if (error.status === 404) {
              this.bottomPanelService.showError('Registration not found!');
            } else {
              this.bottomPanelService.showError('Something went wrong!');
            }
          });
    }
  }

  searchCitizen() {
    const firstName = this.citizenForm.controls['firstName'].value;
    const lastName = this.citizenForm.controls['lastName'].value;
    const birthDate = new Date(this.citizenForm.controls['birthDate'].value);

    this.bottomPanelService.showLoader();

    this.citizenService.getCitizenByFullNameAndBirthDate(`${firstName} ${lastName}`, birthDate)
      .subscribe(
        citizen => {
          this.searchCache.cachedCitizen = citizen;
          this.bottomPanelService.clear();

          this.router.navigate(['/citizen', citizen.id]);
        },
        (error: HttpErrorResponse) => {
          if (error.status === 404) {
            this.bottomPanelService.showError('Citizen not found!');
          } else {
            this.bottomPanelService.showError('Something went wrong!');
          }
        });
  }

  ngOnInit() {
  }
}
