import { Component, OnInit } from '@angular/core';
import { VehicleService } from '../vehicle.service';
import {
  Vehicle,
  VehicleInsurance,
  VehicleRegistration,
} from '../entity/vehicle';
import { HttpErrorResponse } from '@angular/common/http';
import { MatSnackBar } from '@angular/material';
import { ErrorMessageService } from '../error-message/error-message.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})
export class SearchComponent implements OnInit {
  constructor(private vehicleService: VehicleService, private snackBar: MatSnackBar, private errors: ErrorMessageService) { }

  number = '';
  vin = false;
  searching: boolean;
  data: VehicleRegistration;
  insurance: VehicleInsurance;
  leftPanel = 'search';

  search() {
    this.searching = true;
    this.data = null;
    this.insurance = null;

    if (this.vin) {
      this.vehicleService.getVehicleByVin(this.number)
        .subscribe(
          vehicle => {
            this.data = this.fillVehicleOnly(vehicle);
            this.searching = false;
          },
          (error: HttpErrorResponse) => {
            if (error.status === 404) {
              this.showErrorSnackBar('Vehicle not found!');
            } else {
              this.showErrorSnackBar('Something went wrong!');
            }

            this.searching = false;
        });
    } else {
      this.vehicleService.getRegistrationByNumber(this.number)
        .subscribe(
          registration => {
            this.data = registration;
            this.searching = false;
          },
        (error: HttpErrorResponse) => {
            if (error.status === 404) {
              this.showErrorSnackBar('Registration not found!');
            } else {
              this.showErrorSnackBar('Something went wrong!');
            }

            this.searching = false;
          });
    }
  }

  showRegistration() {
    if (this.data.id != null) {
      this.leftPanel = 'registration';

      return;
    }

    this.leftPanel = 'loading';

    this.vehicleService.getRegistrationByVehicleId(this.data.vehicle.id)
      .subscribe(
        registration => {
          this.data = registration;
          this.leftPanel = 'registration';
        },
        (error: HttpErrorResponse) => {
          if (error.status === 404) {
            this.showErrorSnackBar('Registration not found!');
          } else {
            this.showErrorSnackBar('Something went wrong!');
          }

          this.leftPanel = 'search';
      });
  }

  showInsurance() {
    if (this.insurance != null) {
      this.leftPanel = 'insurance';

      return;
    }

    this.leftPanel = 'loading';

    this.vehicleService.getInsuranceByVehicleId(this.data.vehicle.id)
      .subscribe(
        insurance => {
          this.insurance = insurance;
          this.leftPanel = 'insurance';
        },
        (error: HttpErrorResponse) => {
          if (error.status === 404) {
            this.showErrorSnackBar('Insurance not found!');
          } else {
            this.showErrorSnackBar('Something went wrong!');
          }

          this.leftPanel = 'search';
        });
  }

  showErrorSnackBar(message: string) {
    this.snackBar.open(message, 'OK', {
      duration: 3000
    });
  }

  private fillVehicleOnly(vehicle: Vehicle): VehicleRegistration {
    return {
      id: null,
      number: null,
      vehicle: vehicle,
      owner: null,
      createTime: null,
      expireTime: null
    };
  }

  ngOnInit() {
  }
}
