import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Citation } from './entity/citation';
import { CitationModel } from './models/citation';

@Injectable({
  providedIn: 'root'
})
export class CitationService {
  constructor(private http: HttpClient) { }

  public getCitationsForCitizen(citizenId: number): Observable<Citation[]> {
    return this.http.get<Citation[]>(`http://localhost:8080/citizen/${citizenId}/citations`);
  }

  public createCitation(model: CitationModel): Observable<string> {
    return this.http.post<string>(`http://localhost:8080/citation`, model);
  }
}
