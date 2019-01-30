import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Citizen } from './entity/citizen';

@Injectable({
  providedIn: 'root'
})
export class CitizenService {
  constructor(private http: HttpClient) { }

  public getCitizenByFullName(fullName: string): Observable<Citizen> {
    return this.http.get<Citizen>(`http://localhost:8080/citizen/${fullName}`);
  }
}
