import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Vehicle, VehicleBrand, VehicleModel as VehicleFullModel } from './entity/vehicle';

@Injectable({
  providedIn: 'root'
})
export class VehicleService {
  constructor(private http: HttpClient) { }

  public getVehicleByVin(vin: string): Observable<Vehicle> {
    return this.http.get<Vehicle>(`http://localhost:8080/vehicle/${vin}`);
  }

  public getVehicleById(id: number): Observable<Vehicle> {
    return this.http.get<Vehicle>(`http://localhost:8080/vehicle/${id}`);
  }

  public getVehicleModelById(id: number): Observable<VehicleFullModel> {
    return this.http.get<VehicleFullModel>(`http://localhost:8080/model/${id}`);
  }

  public getVehicleBrandById(id: number): Observable<VehicleBrand> {
    return this.http.get<VehicleBrand>(`http://localhost:8080/brand/${id}`);
  }
}
