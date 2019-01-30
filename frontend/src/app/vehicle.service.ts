import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import {
  Vehicle,
  VehicleBrand, VehicleInsurance,
  VehicleModel as VehicleFullModel,
  VehicleRegistration,
} from './entity/vehicle';

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

  public getRegistrationByVehicleId(id: number): Observable<VehicleRegistration> {
    return this.http.get<VehicleRegistration>(`http://localhost:8080/vehicle/${id}/registration`);
  }

  public getRegistrationByNumber(number: string): Observable<VehicleRegistration> {
    return this.http.get<VehicleRegistration>(`http://localhost:8080/registration/${number}`);
  }

  public getInsuranceByVehicleId(id: number): Observable<VehicleInsurance> {
    return this.http.get<VehicleInsurance>(`http://localhost:8080/vehicle/${id}/insurance`);
  }
}
