import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { Visa } from './entity/visa';

@Injectable({
  providedIn: 'root'
})
export class VisaService {
  constructor(private http: HttpClient) { }

  public getVisaForCitizenId(id): Observable<Visa> {
    return this.http.get<Visa>(`http://localhost:8080/citizen/${id}/visa`);
  }
}
