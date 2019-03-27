import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Offense } from './entity/citation';

@Injectable({
  providedIn: 'root'
})
export class OffenseService {
  constructor(private http: HttpClient) { }

  public getAllOffenses(): Observable<Offense[]> {
    return this.http.get<Offense[]>(`http://localhost:8080/offense`);
  }
}
