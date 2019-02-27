import { Injectable } from '@angular/core';
import { Citizen } from './entity/citizen';
import { Vehicle } from './entity/vehicle';

@Injectable({
  providedIn: 'root'
})
export class SearchCacheService {
  constructor() { }

  set cachedCitizen(citizen: Citizen) {
    if (citizen == null) {
      localStorage.removeItem('cachedCitizen');
    } else {
      localStorage.setItem('cachedCitizen', JSON.stringify(citizen));
    }
  }

  set cachedVehicle(vehicle: Vehicle) {
    if (vehicle == null) {
      localStorage.removeItem('cachedVehicle');
    } else {
      localStorage.setItem('cachedVehicle', JSON.stringify(vehicle));
    }
  }

  get cachedCitizen(): Citizen {
    const cachedJson = localStorage.getItem('cachedCitizen');

    return cachedJson ? JSON.parse(cachedJson) : null;
  }

  get cachedVehicle(): Vehicle {
    const cachedJson = localStorage.getItem('cachedVehicle');

    return cachedJson ? JSON.parse(cachedJson) : null;
  }
}
