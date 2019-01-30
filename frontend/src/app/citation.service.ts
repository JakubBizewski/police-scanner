import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Citation } from './entity/citation';

@Injectable({
  providedIn: 'root'
})
export class CitationService {
  constructor(private http: HttpClient) { }

  public getCitationsForCitizen(citizenId: number): Observable<Citation[]> {
    return this.http.get<Citation[]>(`http://localhost:8080/citizen/${citizenId}/citations`);
  }}
