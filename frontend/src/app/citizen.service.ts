import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Citizen } from './entity/citizen';
import * as moment from 'moment';

@Injectable({
  providedIn: 'root'
})
export class CitizenService {
  constructor(private http: HttpClient) { }

  public getCitizenByFullNameAndBirthDate(fullName: string, birthDate: Date): Observable<Citizen> {
    const date = encodeURIComponent(moment(birthDate).format());

    return this.http.get<Citizen>(`http://localhost:8080/citizen?name=${fullName}&birthday=${date}`);
  }

  public getCitizenById(id): Observable<Citizen> {
    return this.http.get<Citizen>(`http://localhost:8080/citizen/${id}`);
  }
}
