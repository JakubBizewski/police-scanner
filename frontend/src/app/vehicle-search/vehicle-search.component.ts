import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-vehicle-search',
  templateUrl: './vehicle-search.component.html',
  styleUrls: ['./vehicle-search.component.css']
})
export class VehicleSearchComponent implements OnInit {
  constructor() { }

  number: string;
  vin: boolean;

  search() {

  }

  ngOnInit() {
  }
}
