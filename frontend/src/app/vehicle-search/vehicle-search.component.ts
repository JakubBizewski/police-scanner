import { Component, OnInit } from '@angular/core';
import { VehicleService } from '../vehicle.service';
import { Vehicle } from '../entity/vehicle';

@Component({
  selector: 'app-vehicle-search',
  templateUrl: './vehicle-search.component.html',
  styleUrls: ['./vehicle-search.component.scss']
})
export class VehicleSearchComponent implements OnInit {
  constructor(private vehicleService: VehicleService) { }

  number = '';
  vin = false;
  searching: boolean;
  error: string;
  vehicle: Vehicle;

  search() {
    this.searching = true;
    this.vehicle = null;

    this.vehicleService.getVehicleByVin(this.number)
      .subscribe(
        vehicle => {
          this.vehicle = vehicle;
          this.searching = false;
        },
        error => {
          this.searching = false;
        });
  }

  ngOnInit() {
  }
}
